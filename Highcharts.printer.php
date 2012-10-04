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

	/**
	 * @see SMWResultPrinter::handleParameters
	 *
	 * @param array $params
	 * @param $outputmode
	 */
	protected function handleParameters( array $params, $outputmode ) {
		return true;
	}

	/**
	 * @see SMWResultPrinter::getResultText
	 *
	 * @param SMWQueryResult $res
	 * @param $outputmode
	 */
	protected function getResultText( SMWQueryResult $res, $outputmode ) {
		$result = '';

		// Our code can be viewed as HTML if requested, no more parsing needed
		$this->isHTML = ( $outputmode == SMW_OUTPUT_HTML );

		return $result;
	}

	/**
	 * Gets User-entered Parameters
	 * 
	 * @return array $params
	 */
	public function getParameters() {
		global $gtDefaultGeographicOrigin, $gtDefaultDistanceUnit, $gtDefaultConstraint, $gtDefaultDistance;
		$params = array_merge( parent::getParameters(), parent::textDisplayParameters() );
		
		$params['origin'] = new Parameter( 'origin', Parameter::TYPE_STRING );
		$params['origin']->setMessage( 'geotools-distancetable-origin' );
		$params['origin']->setDefault( $gtDefaultGeographicOrigin );
		
		$params['units'] = new Parameter( 'units', Parameter::TYPE_STRING );
		$params['units']->setMessage( 'geotools-distancetable-units' );
		$params['units']->setDefault( $gtDefaultDistanceUnit );
		$params['units']->addCriteria( new CriterionInArray( 'kilometers', 'miles', 'nauticalmiles' ) );

		$params['constraint'] = new Parameter( 'constraint', Parameter::TYPE_STRING );
		$params['constraint']->setMessage( 'geotools-distancetable-constraint' );
		$params['constraint']->setDefault( $gtDefaultConstraint );
		$params['constraint']->addCriteria( new CriterionInArray( 'less than', 'greater than' ) );
		
		$params['distance'] = new Parameter( 'distance', Parameter::TYPE_FLOAT );
		$params['distance']->setMessage( 'geotools-distancetable-distance' );
		$params['distance']->setDefault( $gtDefaultDistance );
		
		return $params;
	}

}
