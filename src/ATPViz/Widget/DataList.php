<?php

namespace ATPViz\Widget;

class DataList extends \ATPViz\Widget\AbstractWidget
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setTemplate('atp-viz/widget/dataList.phtml');
	}
	
	public function getSampleData()
	{
		return array(
			'This' => 0,
			'Is' => 1,
			'Some' => 2,
			'Sample' => 'Data'
		);
	}
}
