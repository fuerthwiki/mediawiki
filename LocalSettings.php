<?php
require_once(__DIR__ . DIRECTORY_SEPARATOR . "SECRETS.php");

//error_reporting( E_ALL );
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set( 'display_errors', 1 );
//$wgShowExceptionDetails = true;

# This file was automatically generated by the MediaWiki 
# installer. If you make manual changes, please keep track in case you
# need to recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = "FürthWiki";

## Uncomment the next two lines before updating to lock the database 
## for writing:
//$wgReadOnly = 'Gerade finden Wartungsarbeiten am FürthWiki statt, es ist daher vorläufig schreibgeschützt. Bitte versuchen Sie es in ein paar Stunden wieder!';
$wgIgnoreImageErrors = true;

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = $SECRET_wgScriptPath;
$wgArticlePath = "{$wgScriptPath}/index.php/$1";

## The protocol and server name to use in fully-qualified URLs
#$wgServer = "https://test.fuerthwiki.de";
$wgServer           = $SECRET_wgServer;
$wgCanonicalServer = 'https:'.$SECRET_wgServer;

## Custom upload page (!)
$wgUploadNavigationUrl = "/wiki/index.php/Special:Upload"; //Wizard";

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

## The URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo = $wgResourceBasePath.$SECRET_wgLogo;

## UPO means: this is also a user preference option

$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO
$wgEmailAuthentication = true;
$wgEmailConfirmToEdit = true;

$wgEmergencyContact = "webmaster@fuerthwiki.de";
$wgPasswordSender = "webmaster@fuerthwiki.de";

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO

## Database settings
$wgDBtype           = $SECRET_wgDBtype;
$wgDBserver         = $SECRET_wgDBserver;
$wgDBname           = $SECRET_wgDBname;
$wgDBuser           = $SECRET_wgDBuser;
$wgDBpassword       = $SECRET_wgDBpassword;

# MySQL specific settings
$wgDBprefix = "fw_";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Upload limit
$wgMaxUploadSize = 1024*1024*1024; # Would be 1Gb, shows as 200Mb
$wgUploadSizeWarning = 1024*1024*1024;
$wgMaxArticleSize = 1026*8;        # Would be 8 MB, big enough for any article

$wgMainCacheType    = CACHE_NONE; # Do not cache anything by default  
$wgMemCachedServers = array();
$wgSessionCacheType = CACHE_DB; # Especially store the sessions at db
$wgCacheDirectory = "{$IP}/cache";
#echo "$wgCacheDirectory";

## Shared memory settings
# $wgMainCacheType = CACHE_NONE;
# $wgMemCachedServers = [];
$wgMemoryLimit = "1024M";

## How to handle SVGs
$wgFileExtensions[] = "svg";
$wgFileExtensions = array_merge( $wgFileExtensions, array( 'mp3', 'm4v', 'pdf' ));
$wgAllowTitlesInSVG = true;
$wgSVGConverter = 'ImageMagick';
$wgSVGConverterPath = "/usr/bin";

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

## Fixes https://bitbucket.org/FuerthWiki/wiki/issues/15
## see https://www.mediawiki.org/wiki/Manual:$wgMaxShellMemory/de
$wgMaxShellTime = 0;
$wgMaxShellMemory  = 0;

## Force SSL Login
## fixes https://bitbucket.org/FuerthWiki/wiki/issues/6
$wgSecureLogin = true;

# That makes the login problem a little better
$wgDefaultUserOptions['rememberpassword'] = 1;

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = false;

# Periodically send a pingback to https://www.mediawiki.org/ with basic data
# about this MediaWiki instance. The Wikimedia Foundation shares this data
# with MediaWiki developers to help guide future development efforts.
$wgPingback = true;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "C.UTF-8";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/data/Names.php
$wgLanguageCode = "de";

$wgSecretKey = $SECRET_wgSecretKey;

# Changing this will log out all existing sessions.
#$wgAuthenticationTokenVersion = "1";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = $SECRET_wgUpgradeKey;

#=========================================================================================
#FINE UNTIL HERE!
#=========================================================================================

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "https://creativecommons.org/licenses/by-sa/3.0/";
$wgRightsText = "''Creative Commons'' „Namensnennung – Weitergabe unter gleichen Bedingungen“";
$wgRightsIcon = "$wgResourceBasePath/resources/assets/licenses/cc-by-sa.png";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "vector";

# Enabled skins.
# The following skins were automatically enabled:
wfLoadSkin( 'Timeless' );
wfLoadSkin( 'Vector' );


# Extra Namespaces at FürthWiki
$wgExtraNamespaces =
	array(100 => "Portal",
	      101 => "Portal_Diskussion",
	      200 => "Klasse",
	      201 => "Klasse_Diskussion",
);
$smwgNamespacesWithSemanticLinks[200] = true;
$smwgNamespacesWithSemanticLinks[201] = true;

$wgDefaultUserOptions['thumbsize'] = 2; //180px

## Enables Signiture-Button also for Articles (#37)
## see https://www.mediawiki.org/wiki/Manual:$wgExtraSignatureNamespaces
$wgExtraSignatureNamespaces = array( NS_MAIN, NS_HELP, NS_PROJECT );

# Enabled extensions. Most of the extensions are enabled by adding
# wfLoadExtensions('ExtensionName');
# to LocalSettings.php. Check specific extension documentation for more details.
# The following extensions were automatically enabled:
wfLoadExtension( 'CategoryTree' );
wfLoadExtension( 'Cite' );
wfLoadExtension( 'CiteThisPage' );
wfLoadExtension( 'CodeEditor' );
wfLoadExtension( 'ConfirmEdit' );
wfLoadExtension( 'Gadgets' );
wfLoadExtension( 'ImageMap' );
wfLoadExtension( 'InputBox' );
wfLoadExtension( 'Interwiki' );
wfLoadExtension( 'LocalisationUpdate' );
wfLoadExtension( 'MultimediaViewer' );
wfLoadExtension( 'Nuke' );
wfLoadExtension( 'OATHAuth' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'PdfHandler' );
wfLoadExtension( 'Poem' );
wfLoadExtension( 'Renameuser' );
wfLoadExtension( 'ReplaceText' );
wfLoadExtension( 'SpamBlacklist' );
wfLoadExtension( 'SyntaxHighlight_GeSHi' );
wfLoadExtension( 'TitleBlacklist' );
wfLoadExtension( 'WikiEditor' );
# End of automatically generated settings.
# Add more configuration options below.

enableSemantics( '$SECRET_wgDBserver' );
$smwgParserFeatures = SMW_PARSER_STRICT | SMW_PARSER_INL_ERROR | SMW_PARSER_HID_CATS | SMW_PARSER_LINV;

# Sorting does not remove entries that doesnt hold the search attribute
$smwgQSortFeatures = SMW_QSORT | SMW_QSORT_RANDOM | SMW_QSORT_UNCONDITIONAL; 

wfLoadExtension( 'Scribunto' );
$wgScribuntoDefaultEngine = 'luastandalone';

wfLoadExtension( 'PageForms' );
wfLoadExtension( 'Variables' );
wfLoadExtension( 'Tabs' );
wfLoadExtension( 'Echo' );
wfLoadExtension( 'PageImages' );
wfLoadExtension( 'Popups' );
wfLoadExtension( 'TextExtracts' );
wfLoadExtension( 'AuthorProtect' );
wfLoadExtension( 'AdminLinks' );
wfLoadExtension( 'RottenLinks' );
wfLoadExtension( 'ProofreadPage' );
wfLoadExtension( 'SemanticResultFormats' );
wfLoadExtension( 'CollapsibleVector' );
wfLoadExtension( 'SemanticExtraSpecialProperties' );
wfLoadExtension( 'Widgets' );
wfLoadExtension( 'Loops' );
wfLoadExtension( 'Maps' );
wfLoadExtension( 'TemplateData' );
wfLoadExtension( 'SecureLinkFixer' );
wfLoadExtension( 'TextExtracts' );
wfLoadExtension( 'SemanticCite' );
wfLoadExtension( 'SemanticScribunto' );
wfLoadExtension( 'Mermaid' );
wfLoadExtension( 'SemanticCompoundQueries' );
wfLoadExtension( 'ExternalData' );

# Enable VisualEditor but don't make it default
wfLoadExtension( 'VisualEditor' );
$wgDefaultUserOptions['visualeditor-enable'] = 0;

$wgPFEnableStringFunctions = true;

wfLoadSkin( 'MinervaNeue' );
wfLoadExtension( 'MobileFrontend' );
$wgMFAutodetectMobileView = true;
$wgShowExceptionDetails = true; 

wfLoadExtensions([ 'ConfirmEdit', 'ConfirmEdit/QuestyCaptcha' ]);
$wgCaptchaClass = 'QuestyCaptcha';

foreach ( $SECRET_questions as $key => $value ) {
        $wgCaptchaQuestions[] = array( 'question' => $key, 'answer' => $value );
}

# Allow custom CSS on special- and user- pages
$wgAllowSiteCSSOnRestrictedPages = true;

# PageImages (add Images to "Nearby")
wfLoadExtension( 'PageImages' );

# Shut off WhatsNearbys non working geoip service
$wnbyExternalGeoipService = false;

## custom extension to add special-pages to the mobile menu
## see https://github.com/mojoaxel/MobileSpecialPages
wfLoadExtension( 'MobileSpecialPages' );
wfLoadExtension( 'MobileShareButton' );
wfLoadExtension( 'MobileTabsPlugin' );

$wgMobileSpecialPages['discovery'] = array(
	// Add "In der Nähe" entry using the css-classes from the original nearby entry.
	'nearme' => array(
		'In der Nähe',
		'/wiki/index.php/FürthWiki:In_der_Nähe',
		'mw-ui-icon mw-ui-icon-before mw-ui-icon-nearby nearme'
	),
	// Add link to all maps
	'maps' => array(
		'Karten',
		'/wiki/index.php/FürthWiki:Maps',
		'mw-ui-icon mw-ui-icon-before mw-ui-icon-maps maps'
	),
	// Enable the custom entry "Spezial:Letzte_Änderungen"
	'RECENTCHANGES' => array(),
	// Enable the custom entry "Spezial:Dateien"
	'IMAGELIST' => array()
);
$wgMobileSpecialPages['sitelinks'] = array(
	'verein' => array('Förderverein', '/verein/'),
	'contact' => array('Kontakt', 'mailto:vorstand@fuerthwiki.de')
);

## Web App settings
## see https://bitbucket.org/FuerthWiki/wiki/issues/47
$wgHooks['BeforePageDisplayMobile'][] = 'addAppIcons';
function addAppIcons( OutputPage &$out, Skin &$skin ) {
	$out->addMeta('viewport', 'width=device-width');
	$out->addMeta('mobile-web-app-capable', 'yes');

	$out->addLink(array("rel"=>"icon", "sizes"=>"128x128", "href"=>"/wiki/thumb.php?f=Logo_F%C3%BCrthWiki_withBackground.png&width=128"));
	$out->addLink(array("rel"=>"icon", "sizes"=>"192x192", "href"=>"/wiki/thumb.php?f=Logo_F%C3%BCrthWiki_withBackground.png&width=192"));

	$out->addLink(array("rel"=>"apple-touch-icon", "sizes"=>"128x128", "href"=>"/wiki/thumb.php?f=Logo_F%C3%BCrthWiki_withBackground.png&width=128"));
	$out->addLink(array("rel"=>"apple-touch-icon-precomposed", "sizes"=>"128x128", "href"=>"/wiki/thumb.php?f=Logo_F%C3%BCrthWiki_withBackground.png&width=128"));
};
$wgHooks['BeforePageDisplay'][] = 'addWebAppManifest';
function addWebAppManifest( OutputPage &$out, Skin &$skin ) {
	## change theme color for mobile browsers
	$out->addMeta('theme-color', '#060');

	## Add a link to the Web App manifest to the page-header
	$linkarr['rel'] = 'manifest';
	$linkarr['href'] = '/wiki/manifest.json';
	$out->addLink( $linkarr );
	return true;
};
## Later, this should create the footer link for stats
#$wgHooks['SkinTemplateOutputPageBeforeExec'][] = function( $sk, &$tpl ) {
#	    global $wgArticlePath;
#        $aboutusLink = Html::rawelement( 'a', [ 'href' => 'http://gschmarrie.de/#/statsn'],
#        'Statistik' );
#    $tpl->set( 'aboutus', $aboutusLink );
#    $tpl->data['footerlinks']['places'][] = 'aboutus';
#    return true;
#};
## Maybe there is a better solution...
