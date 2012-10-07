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

	protected $params = array();

	protected function handleParameters(array $incoming, $outputmode) {
		parent::handleParameters($incoming, $outputmode);
		$this->params = $incoming;
	}

	/**
	 * @see SMWResultPrinter::getResultText
	 *
	 * @param SMWQueryResult $res
	 * @param $outputmode
	 */
	protected function getResultText( SMWQueryResult $res, $outputmode ) {
		global $wgOut;
		$wgOut->addModules('ext.highcharts');

		return Html::element(
			'div',
			array(
				'id' => 'container',
				'style' => Sanitizer::checkCss(
					"margin-top: 20px;
					margin-left:20px;
					width:{$this->params['width']}px;
					height:{$this->params['height']}px;"
				)
			)
		);
	}

	protected function getFormatOutput(){
		
		return TRUE;
	}


	/**
	 * Gets User-entered Parameters
	 * 
	 * @return array $params
	 */
	public function getParameters() {
		$tparams = parent::getParameters();

		$tparams['title'] = new Parameter( 'title', Parameter::TYPE_STRING );
		$tparams['title']->setMessage( 'highcharts-plot-title' );
		
		$tparams['subtitle'] = new Parameter( 'subtitle', Parameter::TYPE_STRING );
		$tparams['subtitle']->setMessage( 'highcharts-plot-subtitle' );

		$tparams['height'] = new Parameter( 'height', Parameter::TYPE_INTEGER, 400 );
		$tparams['height']->setMessage( 'highcharts-plot-height' );

		$tparams['width'] = new Parameter( 'width', Parameter::TYPE_INTEGER, 600 );
		$tparams['width']->setMessage( 'highcharts-plot-width' );

		return $tparams;
	}

}
