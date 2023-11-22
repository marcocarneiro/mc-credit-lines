<?php

if( ! class_exists( 'MC_Fin_simulator_Shortcode') ){  
    class MC_Fin_simulator_Shortcode{
        public function __construct()
        {
            add_shortcode( 'mc_fin_simulator', array( $this, 'add_shortcode' ) );
        }

        public function add_shortcode( $atts = array(), $content = null, $tag = '' ){
            //all caracters must be lowercase
            $atts = array_change_key_case( (array) $atts, CASE_LOWER );
            extract(shortcode_atts(
                //array with all possible parameters for this shortcode
                array(
                    'id' => '',
                    'orderby' => 'date',
                ),
                $atts,
                $tag
            ));

            if( !empty( $id )){
                $id = array_map( 'absint', explode( ',', $id ) );
            }

            //build HTML of shortcode on buffer and return
            ob_start();
            require( MC_FIN_SIMULATOR_PATH . 'views/mc-fin_simulator-shortcode.php' );
            //enqueue all necessary scripts - register in class construct
            wp_enqueue_script( 'mc-fin_simulator-main-jp' );
            wp_enqueue_style( 'mc-fin_simulator-main-css' );
            wp_enqueue_style( 'mc-fin_simulator-style-css' );
            //Ativa a função que interfere em um arquivo JAVASCRIPT
            mc_fin_simulator_options();
            return ob_get_clean();
        }

    }
}