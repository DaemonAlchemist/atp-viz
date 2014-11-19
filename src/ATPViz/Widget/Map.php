<?php

namespace ATPViz\Widget;

class Map extends \ATPViz\Widget\AbstractWidget
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setTemplate('atp-viz/widget/map.phtml');
	}
	
	public function setOptions($options)
	{
		parent::setOptions($options);
		
		$requires = array();
		foreach($options['mapLayers'] as $layer)
		{
			//Add requires
			foreach($layer['requires'] as $req)
			{
				$requires[] = $req;
			}
		
			//Add labeling requires
			$requires[] = "esri.symbols.TextSymbol";
			$requires[] = "esri.renderers.SimpleRenderer";
			$requires[] = "esri.layers.LabelLayer";
			$requires[] = "esri.Color";
		
			//Create layer sub-widget
			$class = $layer['class'];
			$widget = new $class();
			$widget->setServiceLocator($this->getServiceLocator());
			$widget->setOptions($layer['options']);
			$widget->init();
			$this->addChild($widget, 'layers', true);
		}
		
		$this->requires = array_unique($requires);
	}
	
	public function getSampleData()
	{
		return array(
		);
	}
}
