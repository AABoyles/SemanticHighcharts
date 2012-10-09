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

class ScatterHighchartsPrinter extends SMWResultPrinter {

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
		$wgOut->addModules('ext.highcharts');

		$chart = array(
            "chart"=> array(
                "renderTo"=> 'container',
                "type"=> 'scatter',
                "zoomType"=> 'xy'
            ),
            "title"=> array(
                "text"=> $this->params['title']
            ),
            "subtitle"=> array(
                "text"=> $this->params['subtitle']
            ),
            "xAxis"=> array(
                "title"=> array(
                    "enabled"=> true,
                    "text"=> 'Height (cm)'
                ),
                "startOnTick"=> true,
                "endOnTick"=> true,
                "showLastLabel"=> true
            ),
            "yAxis"=> array(
                "title"=> array(
                    "text"=> 'Weight (kg)'
                )
            ),
            "legend"=> array(
                "layout"=> 'vertical',
                "align"=> 'left',
                "verticalAlign"=> 'top',
                "x"=> 100,
                "y"=> 70,
                "floating"=> true,
                "backgroundColor"=> '#FFFFFF',
                "borderWidth"=> 1
            ),
            "plotOptions"=> array(
                "scatter"=> array(
                    "marker"=> array(
                        "radius"=> 5,
                        "states"=> array(
                            "hover"=> array(
                                "enabled"=> true,
                                "lineColor"=> 'rgb(100,100,100)'
                            )
                        )
                    ),
                    "states"=> array(
                        "hover"=> array(
                            "marker"=> array(
                                "enabled"=> false
                            )
                        )
                    )
                )
            ),
        );
        
		$wgOut->addJsConfigVars('params', json_encode($chart));

		$series = array(
            "series"=> array(
            	array(
                	"name"=> 'Female',
                	"color"=> 'rgba(223, 83, 83, .5)',
                	"data"=> $this->parseResultData($res))));

		$wgOut->addJsConfigVars('data', json_encode($series));

		return Html::element(
			'div',
			array(
				'id' => 'container',
				'style' => Sanitizer::checkCss("margin-top: 20px;margin-left: 20px;width: {$this->params['width']}px;height: {$this->params['height']}px;")
			)
		);
	}

	protected function parseResultData(SMWQueryResult $res){
		$tempdata = SMWDISerializer::getSerializedQueryResult( $res );
		$out = array();
		$num = 0;
		foreach($tempdata['results'] as $pk=>$pv){
			$out[$num] = array();
			foreach($pv['printouts'] as $ck=>$cv){
				$out[$num][] = floatval($cv[0]['fulltext']);
			}
			$num++;
		}
		return $out;
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

		$tparams['height'] = new Parameter( 'height', Parameter::TYPE_NUMBER, 400 );
		$tparams['height']->setMessage( 'highcharts-plot-height' );

		$tparams['width'] = new Parameter( 'width', Parameter::TYPE_NUMBER, 600 );
		$tparams['width']->setMessage( 'highcharts-plot-width' );

		return $tparams;
	}

}
