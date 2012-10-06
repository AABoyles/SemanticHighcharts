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
	echo( "This file is an extension to the <a href='http://www.mediawiki.org/'>MediaWiki Platform</a> and cannot be used standalone.\n" );
	die();
}

class HighchartsPrinter extends SMWResultPrinter {

	/**
	 * @see SMWResultPrinter::getResultText
	 *
	 * @param SMWQueryResult $res
	 * @param $outputmode
	 */
	protected function getResultText( SMWQueryResult $res, $outputmode ) {
		global $wgOut;
		$wgOut->addModules('ext.highcharts');
		$wgOut->addInlineStyle("div#container{\n\theight:".$this->params['height']."px;\n\twidth:".$this->params['width']."px;");

		return "<div id='container'></div>";
	}


	/**
	 * Gets User-entered Parameters
	 * 
	 * @return array $params
	 */
	public function getParameters() {
		$params = array_merge( parent::getParameters(), parent::textDisplayParameters() );

		$params['title'] = new Parameter( 'title', Parameter::TYPE_STRING );
		$params['title']->setMessage( 'highcharts-plot-title' );
		
		$params['subtitle'] = new Parameter( 'subtitle', Parameter::TYPE_STRING );
		$params['subtitle']->setMessage( 'highcharts-plot-subtitle' );

		$params['height'] = new Parameter( 'height', Parameter::TYPE_INTEGER );
		$params['height']->setMessage( 'highcharts-plot-height' );

		$params['width'] = new Parameter( 'width', Parameter::TYPE_INTEGER );
		$params['width']->setMessage( 'highcharts-plot-width' );

		return $params;
	}

}
