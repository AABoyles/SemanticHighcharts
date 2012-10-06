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

class SMWJSON {
	protected $results;
	protected $count;

	/**
	 * Constructor
	 *
	 * @param SMWQueryResult $res
	 */
	public function __construct( SMWQueryResult $res ){
		$this->results = $res;
		$this->count   = $res->getCount();
	}

	/**
	 * Standard SMW JSON layer
	 *
	 * The output structure resembles that of the api json format structure
	 *
	 * @since 1.8
	 *
	 * @return array
	 */
	public function getSerialization() {
		return array(
			'query' => array_merge( 
				SMWDISerializer::getSerializedQueryResult( $this->results ),
				array ( 'rows' => $this->count ) ) );
	}

	/**
	 * Basic SMW JSON layer
	 *
	 * This is a convenience layer which is eliminating some overhead from the
	 * standard SMW JSON
	 *
	 * @since 1.8
	 *
	 * @return array
	 */
	public function getBasicSerialization( ) {
		$results = array();
		$printRequests = array();

		foreach ( $this->results->getPrintRequests() as /* SMWPrintRequest */ $printRequest ) {
			$printRequests[$printRequest->getLabel()] = array(
				'label'  => $printRequest->getLabel(),
				'typeid' => $printRequest->getTypeID()
			);
		}

		foreach ( $this->results->getResults() as /* SMWDIWikiPage */ $diWikiPage ) {
			$result = array( );

			foreach ( $this->results->getPrintRequests() as /* SMWPrintRequest */ $printRequest ) {
				$serializationItems = array();
				$resultAarray = new SMWResultArray( $diWikiPage, $printRequest, $this->results->getStore() );

				if ( $printRequest->getMode() === SMWPrintRequest::PRINT_THIS ) {
					$dataItems = $resultAarray->getContent();
					$fulltext = SMWDISerializer::getSerialization( array_shift( $dataItems ) );
					$result  += array ( 'label' => $fulltext["fulltext"] );
				}
				else {
					$serializationItems = array_map(
						array( 'SMWDISerializer', 'getSerialization' ),
						$resultAarray->getContent()
					);

					$type  = $printRequest->getTypeID();
					$items = array();

					foreach ( $serializationItems as $item ) {
						if ( $type == "_wpg" ) {
								$items[] = $item["fulltext"];
						} else {
								$items[] = $item;
						}
					}
					$result[$printRequest->getLabel()] = $items;
				}
			}
			$results[$diWikiPage->getTitle()->getFullText()] = $result;
		}
		return array( 'printrequests' => $printRequests, 'results' => $results, 'rows' => $this->count );
	}

	/**
	 * JSON Encoding
	 *
	 * @since 1.8
	 *
	 * @param $syntax string
	 * @param $isPretty boolean prettify JSON output
	 *
	 * @return string
	*/
	public function getEncoding( $syntax = '' , $isPretty = false ){
		return FormatJSON::encode( $syntax === 'basic' ? $this->getBasicSerialization() : $this->getSerialization(), $isPretty );
	}
}
