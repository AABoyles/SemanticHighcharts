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
	echo("This file is an extension to the <a href='http://www.mediawiki.org/'>MediaWiki Platform</a> and cannot be used standalone.\n");
	die();
}

if (!defined('SMW_VERSION')) {
	echo("This is an extension to <a href='http://www.semantic-mediawiki.org/'>Semantic MediaWiki</a> and cannot be used without it.\n");
	die();
}

# Include our utility functions...
include ("Highcharts.body.php");

# Include and hook our distance table printer
include ("Highcharts.printer.php");
#$smwgResultFormats[ 'highcharts' ]  = 'HighchartsPrinter';

# Register the Internationalization file
$wgExtensionMessagesFiles['Highcharts'] = __DIR__ . "/Highcharts.i18n.php";

# Register extension credits:
$wgExtensionCredits['semantic'][] = array(
	'path' => __FILE__, 
	'name' => 'Semantic Highcharts', 
	'version' => '0.1.0', 
	'author' => array('[http://aaboyles.com Tony Boyles]'), 
	'url' => 'https://github.com/AABoyles/SemanticHighcharts', 
	'description-message' => 'desc'
);
