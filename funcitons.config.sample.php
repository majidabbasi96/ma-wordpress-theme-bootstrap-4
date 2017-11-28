<?php
class WBHTL_theme_config{
	
	protected function __construct()
    {
		//Register Nav Menu like this
		$this->nav_menus = array(
								'top-menu' => __('Top Menu', 'mawtb4')
								,'footer-menu' => __('Footer Menu', 'mawtb4')
							);
	}
}