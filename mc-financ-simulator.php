<?php
/**
* Plugin name: MC financ-simulator
* Plugin URI: https://br.wordpress.org/
* Version: 1.0
* Requires at last: 5.6
* Author: Marco Carneiro
* Author URI: https://marco-carneiro.com.br
* Description: MC WordPress financial simulator Plugin.
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: mc-financ-simulator
* Domain Path: /languages
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Se o plugin for acessado diretamente, sai do sistema
if(! defined('ABSPATH')){
    exit;
}

//Se a classe não existe, executa a sua construção
if( ! class_exists( 'MC_financSimulator')){
    class MC_financSimulator{
        //função construtora
        function __construct(){
            $this->define_constants();

            require_once( MC_financSimulator_PATH . 'functions/functions.php' );

            add_action( 'admin_menu', array( $this, 'add_menu' ) );

            require_once( MC_financSimulator_PATH . 'post-types/class.mc-financ-simulator-cpt.php' );
            $MC_financSimulator_cpt = new MC_financSimulator_Post_Type();

            require_once( MC_financSimulator_PATH . 'class.mc-financ-simulator-settings.php' );
            $MC_financSimulator_Settings = new MC_financSimulator_Settings();

            require_once( MC_financSimulator_PATH . 'shortcodes/class.mc-financ-simulator-shortcode.php' );
            $MC_financSimulator_Shortcode = new MC_financSimulator_Shortcode();

            add_action( 'wp_enqueue_scripts', array($this, 'register_scripts' ), 999 );
            add_action( 'admin_enqueue_scripts', array($this, 'register_admin_scripts' ));
        }

        //Define as constantes utilizadas no plugin
        public function define_constants(){
            define( 'MC_financSimulator_PATH', plugin_dir_path(__FILE__) );
            define( 'MC_financSimulator_URL', plugin_dir_url(__FILE__) );
            define( 'MC_financSimulator_VERSION', '1.0.0' );
        }

        public static function activate(){
            update_option( 'rewrite_rules', '');
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type( 'mc-financ-simulator' );
        }

        public static function uninstall(){

        }

        public function add_menu(){
            add_menu_page(
                'MC financ-simulator Options',
                'MC financ-simulator',
                'manage_options',
                'MC_financSimulator_admin',
                array( $this, 'MC_financSimulator_settings_page' ),
                'dashicons-images-alt2',
            );

            add_submenu_page( 
                'MC_financSimulator_admin',
                'Manage Slides',
                'Manage Slides',
                'manage_options',
                'edit.php?post_type=mc-financ-simulator',
                null,
                null
            );
        }

        public function MC_financSimulator_settings_page(){
            if( ! current_user_can( 'manage_options' )){
                return;
            }
            if( isset( $_GET['settings-updated'] )){
                add_settings_error( 'MC_financSimulator_options', 'MC_financSimulator_message', 'Settings Saved', 'success');
            }
            settings_errors( 'MC_financSimulator_options' );

            require( MC_financSimulator_PATH . 'views/settings-page.php' );
        }

        public function register_scripts(){
            //register script to use only include shortcode in page 
            // wp_register_script( 'mc-financ-simulator-main-jp', MC_financSimulator_URL . 'vendor/flexfinanc-simulator/jquery.flexfinanc-simulator-min.js', array('jquery'), MC_financSimulator_VERSION, true );
            // wp_register_style( 'mc-financ-simulator-main-css', MC_financSimulator_URL . 'vendor/flexfinanc-simulator/flexfinanc-simulator.css', array(), MC_financSimulator_VERSION, 'all' );
            // wp_register_style( 'mc-financ-simulator-style-css', MC_financSimulator_URL . 'assets/css/frontend.css', array(), MC_financSimulator_VERSION, 'all' );
        }

        public function register_admin_scripts(){
            //enqueue style only mc-financ-simulator posts
            global $typenow;
            if( $typenow == 'mc-financ-simulator' ){
                wp_enqueue_style( 'mc-financ-simulator-admin', MC_financSimulator_URL . 'assets/css/admin.css' );
            }            
        }
    }    
}

//Se a classe já existe, registra os hooks e instancia a classe
if( class_exists( 'MC_financSimulator')){  
    register_activation_hook( __FILE__, array('MC_financSimulator', 'activate') );
    register_deactivation_hook(__FILE__, array('MC_financSimulator', 'deactivate'));
    register_uninstall_hook(__FILE__, array('MC_financSimulator', 'uninstall')); 

    $MC_financSimulator = new MC_financSimulator();
}




/* if( ! class_exists( 'MC_financSimulator')){
    class MC_financSimulator{
        //função construtora
        function __construct(){
            $this->define_constants();

            require_once( MC_financSimulator_PATH . 'functions/functions.php' );

            add_action( 'admin_menu', array( $this, 'add_menu' ) );

            require_once( MC_financSimulator_PATH . 'post-types/class.mc-financ-simulator-cpt.php' );
            $MC_financSimulator_cpt = new MC_financSimulator_Post_Type();

            require_once( MC_financSimulator_PATH . 'class.mc-financ-simulator-settings.php' );
            $MC_financSimulator_Settings = new MC_financSimulator_Settings();

            require_once( MC_financSimulator_PATH . 'shortcodes/class.mc-financ-simulator-shortcode.php' );
            $MC_financSimulator_Shortcode = new MC_financSimulator_Shortcode();

            add_action( 'wp_enqueue_scripts', array($this, 'register_scripts' ), 999 );
            add_action( 'admin_enqueue_scripts', array($this, 'register_admin_scripts' ));
        }

        //Define as constantes utilizadas no plugin
        public function define_constants(){
            define( 'MC_financSimulator_PATH', plugin_dir_path(__FILE__) );
            define( 'MC_financSimulator_URL', plugin_dir_url(__FILE__) );
            define( 'MC_financSimulator_VERSION', '1.0.0' );
        }

        public static function activate(){
            update_option( 'rewrite_rules', '');
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type( 'mc-financ-simulator' );
        }

        public static function uninstall(){

        }

        public function add_menu(){
            add_menu_page(
                'MC financ-simulator Options',
                'MC financ-simulator',
                'manage_options',
                'MC_financSimulator_admin',
                array( $this, 'MC_financSimulator_settings_page' ),
                'dashicons-images-alt2',
            );

            add_submenu_page( 
                'MC_financSimulator_admin',
                'Manage Slides',
                'Manage Slides',
                'manage_options',
                'edit.php?post_type=mc-financ-simulator',
                null,
                null
            );
        }


        public function MC_financSimulator_settings_page(){
            if( ! current_user_can( 'manage_options' )){
                return;
            }
            if( isset( $_GET['settings-updated'] )){
                add_settings_error( 'MC_financSimulator_options', 'MC_financSimulator_message', 'Settings Saved', 'success');
            }
            settings_errors( 'MC_financSimulator_options' );

            require( MC_financSimulator_PATH . 'views/settings-page.php' );
        }

        public function register_scripts(){
            //register script to use only include shortcode in page 
            wp_register_script( 'mc-financ-simulator-main-jp', MC_financSimulator_URL . 'vendor/flexfinanc-simulator/jquery.flexfinanc-simulator-min.js', array('jquery'), MC_financSimulator_VERSION, true );
            wp_register_style( 'mc-financ-simulator-main-css', MC_financSimulator_URL . 'vendor/flexfinanc-simulator/flexfinanc-simulator.css', array(), MC_financSimulator_VERSION, 'all' );
            wp_register_style( 'mc-financ-simulator-style-css', MC_financSimulator_URL . 'assets/css/frontend.css', array(), MC_financSimulator_VERSION, 'all' );
        }

        public function register_admin_scripts(){
            //enqueue style only mc-financ-simulator posts
            global $typenow;
            if( $typenow == 'mc-financ-simulator' ){
                wp_enqueue_style( 'mc-financ-simulator-admin', MC_financSimulator_URL . 'assets/css/admin.css' );
            }            
        }
    }
}

//Se a classe já existe, registra os hooks e instancia a classe
if( class_exists( 'MC_financSimulator')){  
    register_activation_hook( __FILE__, array('MC_financSimulator', 'activate') );
    register_deactivation_hook(__FILE__, array('MC_financSimulator', 'deactivate'));
    register_uninstall_hook(__FILE__, array('MC_financSimulator', 'uninstall')); 

    $MC_financSimulator = new MC_financSimulator();
} */
