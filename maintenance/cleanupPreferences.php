<?php
/**
 * Clean up user preferences from the database.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @author TyA <tya.wiki@gmail.com>
 * @author Chad <chad@wikimedia.org>
 * @see https://phabricator.wikimedia.org/T32976
 * @ingroup Maintenance
 */

require_once __DIR__ . '/Maintenance.php';

/**
 * Maintenance script that removes unused preferences from the database.
 *
 * @ingroup Maintenance
 */
class CleanupPreferences extends Maintenance {
	public function __construct() {
		parent::__construct();
		$this->addDescription( 'Clean up hidden preferences or removed preferences' );
		$this->setBatchSize( 50 );
		$this->addOption( 'dry-run', 'Print debug info instead of actually deleting' );
		$this->addOption( 'hidden', 'Drop hidden preferences ($wgHiddenPrefs)' );
		$this->addOption( 'unknown',
			'Drop unknown preferences (not in $wgDefaultUserOptions or prefixed with "userjs-")' );
	}

	/**
	 * We will do this in three passes
	 *   1) The easiest is to drop the hidden preferences from the database. We
	 *      don't actually want them
	 *   2) Drop preference keys that we don't know about. They could've been
	 *      removed from core, provided by a now-disabled extension, or the result
	 *      of a bug. We don't want them.
	 */
	public function execute() {
		$dbw = $this->getDB( DB_PRIMARY );
		$hidden = $this->hasOption( 'hidden' );
		$unknown = $this->hasOption( 'unknown' );

		if ( !$hidden && !$unknown ) {
			$this->output( "Did not select one of --hidden, --unknown, exiting\n" );
			return;
		}

		// Remove hidden prefs. Iterate over them to avoid the IN on a large table
		if ( $hidden ) {
			$hiddenPrefs = $this->getConfig()->get( 'HiddenPrefs' );
			if ( !$hiddenPrefs ) {
				$this->output( "No hidden preferences, skipping\n" );
			}
			foreach ( $hiddenPrefs as $hiddenPref ) {
				$this->deleteByWhere(
					$dbw,
					'Dropping hidden preferences',
					[ 'up_property' => $hiddenPref ]
				);
			}
		}

		// Remove unknown preferences. Special-case 'userjs-' as we can't control those names.
		if ( $unknown ) {
			$defaultUserOptions = $this->getConfig()->get( 'DefaultUserOptions' );
			$where = [
				'up_property NOT' . $dbw->buildLike( 'userjs-', $dbw->anyString() ),
				'up_property NOT IN (' . $dbw->makeList( array_keys( $defaultUserOptions ) ) . ')',
			];
			// Allow extensions to add to the where clause to prevent deletion of their own prefs.
			$this->getHookRunner()->onDeleteUnknownPreferences( $where, $dbw );
			$this->deleteByWhere( $dbw, 'Dropping unknown preferences', $where );
		}
	}

	private function deleteByWhere( $dbw, $startMessage, $where ) {
		$this->output( $startMessage . "...\n" );
		$total = 0;
		while ( true ) {
			$res = $dbw->select(
				'user_properties',
				'*', // The table lacks a primary key, so select the whole row
				$where,
				__METHOD__,
				[ 'LIMIT' => $this->mBatchSize ]
			);

			$numRows = $res->numRows();
			$total += $numRows;
			if ( $res->numRows() <= 0 ) {
				$this->output( "DONE! (handled $total entries)\n" );
				break;
			}

			// Progress or something
			$this->output( "..doing $numRows entries\n" );

			// Delete our batch, then wait
			foreach ( $res as $row ) {
				if ( $this->hasOption( 'dry-run' ) ) {
					$this->output(
						"    DRY RUN, would drop: " .
						"[up_user] => '{$row->up_user}' " .
						"[up_property] => '{$row->up_property}' " .
						"[up_value] => '{$row->up_value}'\n"
					);
					continue;
				}
				$this->beginTransaction( $dbw, __METHOD__ );
				$dbw->delete(
					'user_properties',
					[
						'up_user'     => $row->up_user,
						'up_property' => $row->up_property,
						'up_value'    => $row->up_value,
					],
					__METHOD__
				);
				$this->commitTransaction( $dbw, __METHOD__ );
			}
		}
	}
}

$maintClass = CleanupPreferences::class; // Tells it to run the class
require_once RUN_MAINTENANCE_IF_MAIN;
