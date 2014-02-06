<?php

namespace ATPViz\Widget\Map\Layer;

class FeatureLayer extends \ATPViz\Widget\AbstractWidget
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setTemplate('atp-viz/widget/map/featureLayer.phtml');
	}
	
	public function init()
	{
		$this->hasQuery = isset($this->query);
	}
	
	protected function buildQuery($data, $options)
	{
		return "";
	}
}
