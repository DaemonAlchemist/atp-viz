<?php

namespace ATPViz\Widget;

class PlaceHolderWidget extends \ATPViz\Widget\AbstractWidget
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setTemplate('atp-viz/widget/placeHolder.phtml');
	}
}
