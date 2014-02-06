<?php

namespace ATPViz\Widget;

class BarChart extends \ATPViz\Widget\AbstractWidget
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setTemplate('atp-viz/widget/barChart.phtml');
	}

	public function getSampleData()
	{
		return array(
			'labels' => array('Variable', 'Data Series 1', 'Data Series 2'),
			'data' => array(
				'0' => array(1, 2),
				'1' => array(2, 3),
				'2' => array(1, 5),
			),
		);
	}
}
