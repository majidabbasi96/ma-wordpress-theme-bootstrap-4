<?php 
class MAWTB4_theme
{
	private static $instance = NULL;
	
	protected function __construct()
    {
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
    }
	public function shortcode($shortcode, $function)
    {
        return add_shortcode($shortcode, $function);
    }
	
	public function setup()
    {
        
    }
    
    public function sidebars()
    {
    }
    
    public function assets()
    {
                
    }
}
$MAWTB4_theme = MAWTB4_theme::instance();
$MAWTB4_theme->init();