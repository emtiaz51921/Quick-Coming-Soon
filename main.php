<?php

/**
 * Plugin Name:       Quick Coming Soon
 * Plugin URI:        http://qcs.imtiazshamim.com/
 * Description:       This plugin is for quickly adding a coming soon page when you have very less time for customization.
 * Version:           2.0.4
 * Author:            Shamim Imtiaz
 * Author URI:        http://imtiazshamim.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       quick-coming-soon
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}

if ( !class_exists( 'QUICK_COMINGSOON' ) ) {
    class QUICK_COMINGSOON {
        private $plugin_path;

        private $plugin_url;

        private $plugin_version = '2.0.1';

        function __construct() {
            define( 'QUICK_COMINGSOON_VERSION', $this->plugin_version );
            define( 'QUICK_COMINGSOON_SITE_URL', site_url() );
            define( 'QUICK_COMINGSOON_URL', $this->plugin_url() );
            define( 'QUICK_COMINGSOON_PATH', $this->plugin_path() );
            $this->plugin_includes();
        }

        function is_valid_page() {
            return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
        }

        function load_cs_page() {
            header( 'HTTP/1.0 503 Service Unavailable' );
            include_once "quick-coming-soon.php";
            exit();
        }

        function plugin_includes() {
            add_action( 'template_redirect', array( &$this, 'quick_redirect_mm' ) );
        }

        function plugin_path() {
            if ( $this->plugin_path ) {
                return $this->plugin_path;
            }

            return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
        }

        function plugin_url() {
            if ( $this->plugin_url ) {
                return $this->plugin_url;
            }

            return $this->plugin_url = plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) );
        }

        function quick_redirect_mm() {
            if ( is_user_logged_in() ) {
                //do not display coming soon page
            } else {
                if ( !is_admin() && !$this->is_valid_page() ) { //show maintenance page
                    $this->load_cs_page();
                }
            }
        }
    }
    $GLOBALS['quick_comingsoon'] = new QUICK_COMINGSOON();
}

add_action( 'init', 'quick_coming_soon' );
function quick_coming_soon() {
    load_plugin_textdomain( 'quick-coming-soon', false, QUICK_COMINGSOON_URL . '/languages' );
}

require_once dirname( __FILE__ ) . '/includes/class.settings-api.php';
require_once dirname( __FILE__ ) . '/includes/admin.php';
new QCS_Settings_API();