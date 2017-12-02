<?php
class WBHTL_theme_config{
	
	protected function __construct()
    {
		//Register Nav Menu like this
		$this->nav_menus = array(
								'top-menu' => __('Top Menu', 'mawtb4')
								,'footer-menu' => __('Footer Menu', 'mawtb4')
							);
		
		$this->use_parallax = true;
		
		$this->sidebars_data[] = array(
            'name'=>__('Blog Sidebar', 'mawtb4'),
            'id'=>'mawtb4-blog-sidebar'
        );
		
		$this->disable_admin_bar = true;
	}
}