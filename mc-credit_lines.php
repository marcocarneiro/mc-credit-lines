<?php
/**
* Plugin name: MC Credit Lines
* Plugin URI: https://br.wordpress.org/
* Version: 1.0
* Requires at last: 5.6
* Author: Marco Carneiro
* Author URI: https://marco-carneiro.com.br
* Description: MC WordPress Credit Financial simulator Plugin.
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: mc-credit-lines
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
if( ! class_exists( 'MC_credit_lines')){
    class MC_credit_lines{
        //função construtora
        function __construct(){
            $this->define_constants();

            require_once( MC_credit_lines_PATH . 'functions/functions.php' );

            add_action( 'admin_menu', array( $this, 'add_menu' ) );

            require_once( MC_credit_lines_PATH . 'post-types/class.mc-credit_lines-cpt.php' );
            $mc_credit_lines_cpt = new MC_credit_lines_Post_Type();
            
            require_once( MC_credit_lines_PATH . 'class.mc-credit_lines-settings.php' );
            $Mc_credit_lines_Settings = new Mc_credit_lines_Settings();

            require_once( MC_credit_lines_PATH . 'shortcodes/class.mc-credit_lines-shortcode.php' );
            $MC_credit_lines_Shortcode = new MC_credit_lines_Shortcode();

            add_action( 'wp_enqueue_scripts', array($this, 'register_scripts' ), 999 );
            add_action( 'admin_enqueue_scripts', array($this, 'register_admin_scripts' ));
        }

        //Define as constantes utilizadas no plugin
        public function define_constants(){
            define( 'MC_credit_lines_PATH', plugin_dir_path(__FILE__) );
            define( 'MC_credit_lines_URL', plugin_dir_url(__FILE__) );
            define( 'MC_credit_lines_VERSION', '1.0.0' );
        }

        public static function activate(){
            update_option( 'rewrite_rules', '');
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type( 'mc-credit_lines' );
        }

        public static function uninstall(){

        }

        public function add_menu(){
            add_menu_page(
                'MC credit_lines Options',
                'MC credit_lines',
                'manage_options',
                'mc_credit_lines_admin',
                array( $this, 'mc_credit_lines_settings_page' ),
                'dashicons-money-alt',
            );

            add_submenu_page( 
                'mc_credit_lines_admin',
                'Manage Credit Lines',
                'Manage Credit Lines',
                'manage_options',
                'edit.php?post_type=mc-credit_lines',
                null,
                null
            );
        }


        public function mc_credit_lines_settings_page(){
            if( ! current_user_can( 'manage_options' )){
                return;
            }
            if( isset( $_GET['settings-updated'] )){
                add_settings_error( 'mc_credit_lines_options', 'mc_credit_lines_message', 'Settings Saved', 'success');
            }
            settings_errors( 'mc_credit_lines_options' );

            require( MC_credit_lines_PATH . 'views/settings-page.php' );
        }

        public function register_scripts(){
            //register script to use only include shortcode in page 
            wp_register_script( 'mc-credit_lines-main-jp', MC_credit_lines_URL . 'vendor/flexcredit_lines/jquery.flexcredit_lines-min.js', array('jquery'), MC_credit_lines_VERSION, true );
            wp_register_style( 'mc-credit_lines-main-css', MC_credit_lines_URL . 'vendor/flexcredit_lines/flexcredit_lines.css', array(), MC_credit_lines_VERSION, 'all' );
            wp_register_style( 'mc-credit_lines-style-css', MC_credit_lines_URL . 'assets/css/frontend.css', array(), MC_credit_lines_VERSION, 'all' );
        }

        public function register_admin_scripts(){
            //enqueue style only mc-credit_lines posts
            global $typenow;
            if( $typenow == 'mc-credit_lines' ){
                wp_enqueue_style( 'mc-credit_lines-admin', MC_credit_lines_URL . 'assets/css/admin.css' );
            }            
        }
    }
}

//Se a classe já existe, registra os hooks e instancia a classe
if( class_exists( 'MC_credit_lines')){  
    register_activation_hook( __FILE__, array('MC_credit_lines', 'activate') );
    register_deactivation_hook(__FILE__, array('MC_credit_lines', 'deactivate'));
    register_uninstall_hook(__FILE__, array('MC_credit_lines', 'uninstall')); 

    $mc_credit_lines = new MC_credit_lines();
}
