<?php 
include 'funcitons.config.php';

class MAWTB4_theme extends WBHTL_theme_config
{
	public $nav_menus = array();
	
	public $use_parallax = false;
	public $use_slick = false;
	
	public $sidebars_data = array();
	public $disable_admin_bar = false;
	
	private static $instance = NULL;
	
	protected function __construct()
    {
		parent::__CONSTRUCT();
		
        if(!defined('MAWTB4_THEME_VERSION')) define('MAWTB4_THEME_VERSION', '0.0.1');
    }
    
    private function __clone()
    {
    }
    
    private function __wakeup()
    {
    }
	
	public static function instance()
	{
        if(!self::$instance) self::$instance = new self();
        
        return self::$instance;
	}
	private function addAction($hook, $function, $priority = 10, $accepted_args = 1)
    {
        if(!trim($hook) or !$function) return false;
        
        return add_action($hook, $function, $priority, $accepted_args);
    }
	public function showMenu($themeLocation, $menuID = '')
	{
		if($themeLocation == '') return false;
		
		$params = array(
			'theme_location' => $themeLocation,
			'menu_id' => $menuID
		);
		
		wp_nav_menu( $params );
	}
	public function AddFilter($tag, $function, $priority = 10, $accepted_args = 1)
    {
        
        if(!trim($tag) or !$function) return false;
        
        return add_filter($tag, $function, $priority, $accepted_args);
    }
	
	public function init()
    {
        $this->addAction('after_setup_theme', array($this, 'setup'));
        $this->addAction('widgets_init', array($this, 'sidebars'));
        $this->addAction('wp_enqueue_scripts', array($this, 'assets'));
		if($this->disable_admin_bar)
		{
			$this->AddFilter('show_admin_bar', array($this, 'disableAdminBar'));
		}
    }
	public function disableAdminBar(){
		return false;
	}
	public function shortcode($shortcode, $function)
    {
        return add_shortcode($shortcode, $function);
    }
	
	public function setup()
    {
        load_theme_textdomain('mawtb4', get_template_directory().'/languages');
		
		add_theme_support('post-thumbnails');
		
		add_theme_support('title-tag');
		
		add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));
		
		if($this->nav_menus)
		{
			register_nav_menus($this->nav_menus);
		}
    }
    
    public function sidebars()
    {
		if($this->sidebars_data)
		{
			foreach($this->sidebars_data as $sidebar)
			{
				register_sidebar($sidebar);
			}
		}
    }
    
    public function assets()
    {
		wp_enqueue_style('mawtb4-css-bootstrap', get_template_directory_uri().'/assets/plugins/bootstrap-4/css/bootstrap.min.css');
		if($this->use_slick)
		{
			wp_enqueue_style('mawtb4-css-slick', get_template_directory_uri().'/assets/plugins/slick/slick.css');
			wp_enqueue_style('mawtb4-css-slick-theme', get_template_directory_uri().'/assets/plugins/slick/slick-theme.css');
		}
		wp_enqueue_style('mawtb4-css-template', get_template_directory_uri().'/assets/css/template.css');
		
		wp_enqueue_script('mawtb4-js-jquery-slim', get_template_directory_uri().'/assets/plugins/jquery.slim/jquery-3.2.1.slim.min.js', array(), '20151010', true);
		wp_enqueue_script('mawtb4-js-popper', get_template_directory_uri().'/assets/plugins/properjs/popper.min.js', array(), '20151010', true);
		wp_enqueue_script('mawtb4-js-bootstrap', get_template_directory_uri().'/assets/plugins/bootstrap-4/js/bootstrap.min.js', array(), '20151010', true);
		if($this->use_parallax)
		{
			wp_enqueue_script('mawtb4-js-parallax', get_template_directory_uri().'/assets/plugins/parallax/parallax.min.js', array(), '20151010', true);
		}
		if($this->use_slick)
		{
			wp_enqueue_script('mawtb4-js-slick', get_template_directory_uri().'/assets/plugins/slick/slick.min.js', array(), '20151010', true);
		}
		wp_enqueue_script('mawtb4-js-template', get_template_directory_uri().'/assets/js/template.js', array(), '20151010', true);
    }
}
$MAWTB4_theme = MAWTB4_theme::instance();
$MAWTB4_theme->init();