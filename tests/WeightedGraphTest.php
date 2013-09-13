<?php

require_once __DIR__.'/../vendor/autoload.php';

use hannesvdvreken\Graph\WeightedGraph;

class WeightedGraphTest extends PHPUnit_Framework_TestCase 
{

	public function testEmpty()
	{
		// arrange
		$graph = array();

		// act
		$g = new WeightedGraph($graph);
		$mst = $g->mst();

		// assert
		$this->assertEquals($mst, array());
	}

	public function testMst()
	{
		// arrange
		$graph = array(
			array('vertices' => array('A', 'D'), 'weight' => 5),
			array('vertices' => array('A', 'B'), 'weight' => 7),
			array('vertices' => array('B', 'C'), 'weight' => 8),
			array('vertices' => array('B', 'E'), 'weight' => 7),
			array('vertices' => array('C', 'E'), 'weight' => 5),
			array('vertices' => array('D', 'E'), 'weight' => 15),
			array('vertices' => array('D', 'F'), 'weight' => 6),
			array('vertices' => array('E', 'F'), 'weight' => 8),
			array('vertices' => array('E', 'G'), 'weight' => 9),
			array('vertices' => array('F', 'G'), 'weight' => 11),
		);

		$mst = array(
			array('vertices' => array('A', 'D'), 'weight' => 5),
			array('vertices' => array('D', 'F'), 'weight' => 6),
			array('vertices' => array('A', 'B'), 'weight' => 7),
			array('vertices' => array('B', 'E'), 'weight' => 7),
			array('vertices' => array('B', 'C'), 'weight' => 8),
			array('vertices' => array('E', 'G'), 'weight' => 9),
		);

		$g = new WeightedGraph($graph);

		// act
		$mst = $g->mst();

		// assert
		$this->assertEquals($g->mst(), $mst);
	}

}