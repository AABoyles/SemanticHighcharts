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

if ( !defined( 'MEDIAWIKI' ) ) {
	die("This file is an extension to the <a href='http://www.mediawiki.org/'>MediaWiki Platform</a> and cannot be used standalone.");
}

class ScatterHighchartsPrinter extends HighchartsPrinter {

	protected $params = array();

	protected function handleParameters(array $params, $outputmode) {
		parent::handleParameters($params, $outputmode);
		$this -> params = $params;
	}

	public function getName() {
		return "HighCharts Scatterplot";
	}

	/**
	 * @see SMWResultPrinter::getResultText
	 *
	 * @param SMWQueryResult $res
	 * @param $outputmode
	 */
	protected function getResultText( SMWQueryResult $res, $outputmode ) {
		global $wgOut;

		return TRUE;
	}

	/**
	 * Gets User-entered Parameters
	 * 
	 * @return array $params
	 */
	public function getParameters() {
		$params = array_merge( parent::getParameters(), parent::textDisplayParameters() );



		return $params;
	}

}
