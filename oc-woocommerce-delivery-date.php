<?php
/**
* Plugin Name: Select Delivery Dates Woo
* Description: Using This Plugin You will allow your customers to choose a specific delivery date for the products they purchase. 
* Version: 1.0
* Author: Ajay Radadiya
* License: A "GNUGPLv3" license name 
*/

if (!defined('ABSPATH')) {
  die('-1');
}
if (!defined('OCWDD_PLUGIN_NAME')) {
  define('OCWDD_PLUGIN_NAME', 'WooCommerce Delivery Dates');
}
if (!defined('OCWDD_PLUGIN_VERSION')) {
  define('OCWDD_PLUGIN_VERSION', '1.0.0');
}
if (!defined('OCWDD_PLUGIN_FILE')) {
  define('OCWDD_PLUGIN_FILE', __FILE__);
}
if (!defined('OCWDD_PLUGIN_DIR')) {
  define('OCWDD_PLUGIN_DIR',plugins_url('', __FILE__));
}

if (!defined('OCWDD_DOMAIN')) {
  define('OCWDD_DOMAIN', 'ocwdd');
}

//Main class
//Load required js,css and other files

if (!class_exists('OCWDD_main')) {

  class OCWDD_main {

    protected static $OCWDD_instance;

           /**
       * Constructor.
       *
       * @version 3.2.3
       */
      function __construct() {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        //check plugin activted or not
        add_action('admin_init', array($this, 'OCWDD_check_plugin_state'));
      }

    //Add JS and CSS on Frontend
    function OCWDD_load_script_style()
    {
      wp_enqueue_style( 'ocwdd_front_css', OCWDD_PLUGIN_DIR . '/assets/css/ocwdd-front-css.css', false, '1.0.0' );
      wp_enqueue_style( 'ocwdd_jquery_ui', OCWDD_PLUGIN_DIR . '/assets/css/jquery-ui.css', false, '1.0.0' );
      wp_enqueue_script( 'ocwdd_front_ui', OCWDD_PLUGIN_DIR . '/assets/js/ocwdd-front-js.js', false, '1.0.0' );
      wp_enqueue_script('jquery');
      wp_enqueue_script('jquery-ui-core');//enables UI
      wp_enqueue_script('jquery-ui-datepicker');
      


    }

    //Add JS and CSS on Backend
    function OCWDD_load_admin_script_style() {
      wp_enqueue_style( 'ocwdd_admin_css', OCWDD_PLUGIN_DIR . '/assets/css/ocwdd-admin-css.css', false, '1.0.0' );
      wp_enqueue_script( 'ocwdd_admin_js', OCWDD_PLUGIN_DIR . '/assets/js/ocwdd-admin-js.js', false, '1.0.0' );
      wp_enqueue_script('jquery-ui-datepicker');
    }

    function OCWDD_show_notice() {

        if ( get_transient( get_current_user_id() . 'ocwdderror' ) ) {

          deactivate_plugins( plugin_basename( __FILE__ ) );

          delete_transient( get_current_user_id() . 'ocwdderror' );

          echo '<div class="error"><p> This plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=woocommerce">WooCommerce</a> plugin installed and activated.</p></div>';

        }

    }

    function OCWDD_check_plugin_state(){
      if ( ! ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) ) {
        set_transient( get_current_user_id() . 'ocwdderror', 'message' );
      }
    }

    function init() {
      add_action( 'admin_notices', array($this, 'OCWDD_show_notice'));
      add_action('admin_enqueue_scripts', array($this, 'OCWDD_load_admin_script_style'));
      add_action( 'wp_enqueue_scripts',  array($this, 'OCWDD_load_script_style'));
    }

    //Load all includes files
    function includes() {
        //Plugin Settings
        include_once('admin/ocwdd-all-settings.php');
        //For Front
        include_once('front/ocwdd-front-action.php');
    }

    //Plugin Rating
    public static function OCWDD_do_activation() {
      set_transient('ocwdd-first-rating', true, MONTH_IN_SECONDS);
    }

    public static function OCWDD_instance() {
      if (!isset(self::$OCWDD_instance)) {
        self::$OCWDD_instance = new self();
        self::$OCWDD_instance->init();
        self::$OCWDD_instance->includes();
      }
      return self::$OCWDD_instance;
    }

  }

  add_action('plugins_loaded', array('OCWDD_main', 'OCWDD_instance'));

  register_activation_hook(OCWDD_PLUGIN_FILE, array('OCWDD_main', 'OCWDD_do_activation'));
}
