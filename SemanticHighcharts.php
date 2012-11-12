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

if (!defined('SMW_VERSION')) {
	die("Semantic Highcharts is an extension to the <a href='http://www.semantic-mediawiki.com/'>Semantic MediaWiki Platform</a> and cannot be used standalone.");
}


# Global Variables


# Include our Semantic Result printers
$wgAutoloadClasses['ScatterHighchartsPrinter'] = dirname( __FILE__ ) . 'printers/scatter.php';
$smwgResultFormats[ 'highchartsscatter' ]  = 'ScatterHighchartsPrinter';

$wgAutoloadClasses['BarHighchartsPrinter'] = dirname( __FILE__ ) . 'printers/bar.php';
$smwgResultFormats[ 'highchartsbar'     ]  = 'BarHighchartsPrinter';

# Register our Javascript Resources
$wgResourceModules['ext.highcharts'] = array(
	'scripts' => array('js/highcharts.js','js/modules/exporting.js','js/chart.js'),
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
