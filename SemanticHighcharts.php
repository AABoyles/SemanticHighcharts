<?php
/* Semantic HighCharts
 * A Semantic Mediawiki Result Printer wrapping the Highcharts JS library
 *
 * @file
 * @ingroup Semantic Highcharts
 * @author Tony Boyles <AABoyles@gmail.com>
 * @copyright © 2012, Tony Boyles
 * @license GNU General Public License v.3 or later compatible version
 */

if (!defined('MEDIAWIKI')) {
	die("This file is an extension to the <a href='http://www.mediawiki.org/'>MediaWiki Platform</a> and cannot be used standalone.");
}

# Global Variables
# Should we enable the Semantic Result Printer?
$wgHCEnableResultPrinter = TRUE;

# Should we enable the parser hook?
$wgHCEnableParserHook = TRUE;

# Include our utility functions...
include ("Highcharts.body.php");

# If this is a Semantic Mediawiki, include our Semantic Result printers
if (defined('SMW_VERSION')) {
	include ("printers/Highcharts.printer.php");

	include ("printers/scatter.php");
	$smwgResultFormats[ 'highchartsscatter' ]  = 'ScatterHighchartsPrinter';
}

$wgResourceModules['ext.highcharts'] = array(
	'scripts' => 'js/highcharts.js',
	//'styles' => 'css/ext.myExtension.css',
	'dependencies' => 'jquery',
	'localBasePath' => dirname( __FILE__ ),
	'remoteExtPath' => 'SemanticHighcharts'
);

# Register the Internationalization file
$wgExtensionMessagesFiles['Highcharts'] = __DIR__ . "/SemanticHighcharts.i18n.php";

# Register extension credits:
$wgExtensionCredits['semantic'][] = array(
	'path' => __FILE__, 
	'name' => 'Semantic Highcharts', 
	'version' => '0.1.0', 
	'author' => array('[http://aaboyles.com Tony Boyles]'), 
	'url' => 'https://github.com/AABoyles/SemanticHighcharts', 
	'description-message' => 'desc'
);
