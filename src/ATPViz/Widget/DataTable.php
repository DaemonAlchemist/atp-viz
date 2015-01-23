<?php

namespace ATPViz\Widget;

class DataTable extends \ATPViz\Widget\AbstractWidget
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setTemplate('atp-viz/widget/dataTable.phtml');
	}

	public function getSampleData()
	{
		return array(
			'columns' => array('First Column', 'Second Column', 'Third Column'),
			'data' => array(
				array(1, 2, 3),
				array(4, 5, 6),
				array(7, 8, 9)
			)
		);
	}
}
