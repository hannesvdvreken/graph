<?php

namespace hannesvdvreken\Graph;

class WeightedGraph
{
	private $graph;
	private $mst; // minimum spanning tree

	/**
	 * Constructor
	 * 
	 * @param array $graph
	 */
	public function __construct($graph)
	{
		$this->graph = $graph;
	}

	/**
	 * Minimum spanning tree (Kruskal Algorithm)
	 * 
	 * @return array $mst
	 */
	public function mst()
	{
		// return cached result
		if ($this->mst) return $this->mst;

		// init
		$this->mst = array();
		$vertices = array();

		// first step: build vertices set
		foreach ($this->graph as $edge)
		{
			$vertices[] = reset($edge['vertices']);
			$vertices[] = end($edge['vertices']);
		}

		// make set
		$vertices = array_unique($vertices);
		$vertices_used = array();

		// compare function
		$cmp = function($a, $b) 
		{
			return $a['weight'] > $b['weight'];
		};

		// user defined sort
		usort($this->graph, $cmp);

		// second step: loop edges, as long as $vertices_u != $vertices
		if (count($this->graph))
		{
			$this->mst[] = $edge = reset($this->graph);
			$vertices_used = $edge['vertices'];
		}

		foreach ($this->graph as $edge)
		{
			if (in_array(reset($edge['vertices']), $vertices_used) != in_array(end($edge['vertices']), $vertices_used))
			{
				// add to mst
				$this->mst[] = $edge;
				$vertices_used = array_unique(array_merge($edge['vertices'], $vertices_used));
			}
		}

		// report back
		return $this->mst;
	}
}