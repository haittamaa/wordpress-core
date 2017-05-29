<?php

/**
  Plugin Name: Advanced Access Manager
  Description: All you need to manage access to your WordPress website
  Version: 4.7.5
  Author: Vasyl Martyniuk <vasyl@vasyltech.com>
  Author URI: https://vasyltech.com

  -------
  LICENSE: This file is subject to the terms and conditions defined in
  file 'license.txt', which is part of Advanced Access Manager source package.
 *
 */

/**
 * Main plugin's class
 * 
 * @package AAM
 * @author Vasyl Martyniuk <vasyl@vasyltech.com>
 */
class AAM {

    /**
     * Single instance of itself
     *
     * @var AAM
     *
     * @access private
     */
    private static $_instance = null;

    /**
     * User Subject
     *
     * @var AAM_Core_Subject_User|AAM_Core_Subject_Visitor
     *
     * @access private
     */
    private $_user = null;

    /**
     * Initialize the AAM Object
     *
     * @return void
     *
     * @access protected
     */
    protected function __construct() {
        $uid = get_current_user_id();
        
        //initialize the user subject
        if ($uid) {
            $this->setUser(new AAM_Core_Subject_User($uid));
        } else {
            $this->setUser(new AAM_Core_Subject_Visitor(''));
        }
        
        //load AAM core config
        AAM_Core_Config::bootstrap();
    }

    /**
     * Set Current User
     *
     * @param AAM_Core_Subject $user
     *
     * @return void
     *
     * @access public
     */
    protected function setUser(AAM_Core_Subject $user) {
        $this->_user = $user;
    }

    /**
     * Get current user
     * 
     * @return AAM_Core_Subject
     * 
     * @access public
     */
    public static function getUser() {
        return self::getInstance()->_user;
    }

    /**
     * Make sure that AAM UI Page is used
     *
     * @return boolean
     *
     * @access public
     */
    public static function isAAM() {
        $page      = AAM_Core_Request::get('page');
        $action    = AAM_Core_Request::post('action');
        
        $intersect = array_intersect(array('aam', 'aamc'), array($page, $action));
        
        return (is_admin() && count($intersect));
    }

    /**
     * Initialize the AAM plugin
     *
     * @return AAM
     *
     * @access public
     * @static
     */
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            load_plugin_textdomain(
                    AAM_KEY, false, dirname(plugin_basename(__FILE__)) . '/Lang/'
            );
            self::$_instance = new self;
            
            //load AAM cache
            AAM_Core_Cache::bootstrap();
            
            //load all installed extension
            //TODO - Remove in Aug 2017
            AAM_Extension_Repository::getInstance()->load();
            
            //check if user is locked
            if (get_current_user_id() && AAM::getUser()->user_status == 1) {
                wp_logout();
            }

            //bootstrap the correct interface
            if (is_admin()) {
                AAM_Backend_Manager::bootstrap();
            } else {
                AAM_Frontend_Manager::bootstrap();
            }
            
            //load media control
            AAM_Core_Media::bootstrap();
        }

        return self::$_instance;
    }

    /**
     * Run daily routine
     * 
     * Check server extension versions
     * 
     * @return void
     * 
     * @access public
     */
    public static function cron() {
        $extensions = AAM_Core_API::getOption('aam-extensions', null, 'site');
        
        if (!empty($extensions)) {
            //grab the server extension list
            AAM_Core_API::updateOption(
                    'aam-check', AAM_Extension_Server::check(), 'site'
            );
        }
    }

    /**
     * Create aam folder
     * 
     * @return void
     * 
     * @access public
     */
    public static function activate() {
        global $wp_version;
        
        //check PHP Version
        if (version_compare(PHP_VERSION, '5.2') == -1) {
            exit(__('PHP 5.2 or higher is required.', AAM_KEY));
        } elseif (version_compare($wp_version, '3.8') == -1) {
            exit(__('WP 3.8 or higher is required.', AAM_KEY));
        }

        //create an wp-content/aam folder if does not exist
        $dirname = WP_CONTENT_DIR . '/aam';
        
        if (file_exists($dirname) === false) {
            @mkdir($dirname, fileperms( ABSPATH ) & 0777 | 0755);
        }
    }

    /**
     * De-install hook
     *
     * Remove all leftovers from AAM execution
     *
     * @return void
     *
     * @access public
     */
    public static function uninstall() {
        //trigger any uninstall hook that is registered by any extension
        do_action('aam-uninstall-action');

        //remove aam directory if exists
        $dirname = WP_CONTENT_DIR . '/aam';
        if (file_exists($dirname)) {
            AAM_Core_API::removeDirectory($dirname);
        }
        
        //clear schedules
        wp_clear_scheduled_hook('aam-cron');
    }

}

if (defined('ABSPATH')) {
    //define few common constants
    define(
        'AAM_MEDIA', 
        preg_replace('/^http[s]?:/', '', plugins_url('/media', __FILE__))
    );
    define('AAM_KEY', 'advanced-access-manager');
    define('AAM_EXTENSION_BASE', WP_CONTENT_DIR . '/aam/extension');
    define('AAM_CODEPINCH_AFFILIATE_CODE', 'H2K31P8H');
    
    //register autoloader
    require (dirname(__FILE__) . '/autoloader.php');
    AAM_Autoloader::register();
    
    //the highest priority (higher the core)
    //this is important to have to catch events like register core post types
    add_action('init', 'AAM::getInstance', -1);
    
    //schedule cron
    if (!wp_next_scheduled('aam-cron')) {
        wp_schedule_event(time(), 'daily', 'aam-cron');
    }
    add_action('aam-cron', 'AAM::cron');
    
    //activation & deactivation hooks
    register_activation_hook(__FILE__, array('AAM', 'activate'));
    register_uninstall_hook(__FILE__, array('AAM', 'uninstall'));
}