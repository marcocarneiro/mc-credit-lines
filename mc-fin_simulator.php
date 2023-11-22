<?php
/**
* Plugin name: MC Financial Simuletor
* Plugin URI: https://br.wordpress.org/
* Version: 1.0
* Requires at last: 5.6
* Author: Marco Carneiro
* Author URI: https://marco-carneiro.com.br
* Description: MC WordPress Financial simulator Plugin.
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
if( ! class_exists( 'MC_Fin_simulator')){
    class MC_Fin_simulator{
        //função construtora
        function __construct(){
            $this->define_constants();

            require_once( MC_FIN_SIMULATOR_PATH . 'functions/functions.php' );

            add_action( 'admin_menu', array( $this, 'add_menu' ) );

            require_once( MC_FIN_SIMULATOR_PATH . 'post-types/class.mc-fin_simulator-cpt.php' );
            $mc_fin_simulator_cpt = new MC_Fin_simulator_Post_Type();

            require_once( MC_FIN_SIMULATOR_PATH . 'class.mc-fin_simulator-settings.php' );
            $Mc_Fin_simulator_Settings = new Mc_Fin_simulator_Settings();

            require_once( MC_FIN_SIMULATOR_PATH . 'shortcodes/class.mc-fin_simulator-shortcode.php' );
            $MC_Fin_simulator_Shortcode = new MC_Fin_simulator_Shortcode();

            add_action( 'wp_enqueue_scripts', array($this, 'register_scripts' ), 999 );
            add_action( 'admin_enqueue_scripts', array($this, 'register_admin_scripts' ));
        }

        //Define as constantes utilizadas no plugin
        public function define_constants(){
            define( 'MC_FIN_SIMULATOR_PATH', plugin_dir_path(__FILE__) );
            define( 'MC_FIN_SIMULATOR_URL', plugin_dir_url(__FILE__) );
            define( 'MC_FIN_SIMULATOR_VERSION', '1.0.0' );
        }

        public static function activate(){
            update_option( 'rewrite_rules', '');
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type( 'mc-fin_simulator' );
        }

        public static function uninstall(){

        }

        public function add_menu(){
            add_menu_page(
                'MC Fin_simulator Options',
                'MC Fin_simulator',
                'manage_options',
                'mc_fin_simulator_admin',
                array( $this, 'mc_fin_simulator_settings_page' ),
                'dashicons-images-alt2',
            );

            add_submenu_page( 
                'mc_fin_simulator_admin',
                'Manage Slides',
                'Manage Slides',
                'manage_options',
                'edit.php?post_type=mc-fin_simulator',
                null,
                null
            );
        }


        public function mc_fin_simulator_settings_page(){
            if( ! current_user_can( 'manage_options' )){
                return;
            }
            if( isset( $_GET['settings-updated'] )){
                add_settings_error( 'mc_fin_simulator_options', 'mc_fin_simulator_message', 'Settings Saved', 'success');
            }
            settings_errors( 'mc_fin_simulator_options' );

            require( MC_FIN_SIMULATOR_PATH . 'views/settings-page.php' );
        }

        public function register_scripts(){
            //register script to use only include shortcode in page 
            wp_register_script( 'mc-fin_simulator-main-jp', MC_FIN_SIMULATOR_URL . 'vendor/flexfin_simulator/jquery.flexfin_simulator-min.js', array('jquery'), MC_FIN_SIMULATOR_VERSION, true );
            wp_register_style( 'mc-fin_simulator-main-css', MC_FIN_SIMULATOR_URL . 'vendor/flexfin_simulator/flexfin_simulator.css', array(), MC_FIN_SIMULATOR_VERSION, 'all' );
            wp_register_style( 'mc-fin_simulator-style-css', MC_FIN_SIMULATOR_URL . 'assets/css/frontend.css', array(), MC_FIN_SIMULATOR_VERSION, 'all' );
        }

        public function register_admin_scripts(){
            //enqueue style only mc-fin_simulator posts
            global $typenow;
            if( $typenow == 'mc-fin_simulator' ){
                wp_enqueue_style( 'mc-fin_simulator-admin', MC_FIN_SIMULATOR_URL . 'assets/css/admin.css' );
            }            
        }
    }
}

//Se a classe já existe, registra os hooks e instancia a classe
if( class_exists( 'MC_Fin_simulator')){  
    register_activation_hook( __FILE__, array('MC_Fin_simulator', 'activate') );
    register_deactivation_hook(__FILE__, array('MC_Fin_simulator', 'deactivate'));
    register_uninstall_hook(__FILE__, array('MC_Fin_simulator', 'uninstall')); 

    $mc_fin_simulator = new MC_Fin_simulator();
}
