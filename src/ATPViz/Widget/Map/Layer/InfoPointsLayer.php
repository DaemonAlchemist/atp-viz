<?php

namespace ATPViz\Widget\Map\Layer;

class InfoPointsLayer extends \ATPViz\Widget\AbstractWidget
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setTemplate('atp-viz/widget/map/infoPointsLayer.phtml');
	}
	
	public function init()
	{
		$sm = $this->getServiceLocator();
		$dataSourceFactory = $sm->get('DataSourceFactory');
		$dataSource = $dataSourceFactory->getInstance($this->dataSource);
		$this->data = $dataSource->getData();
	}
}
