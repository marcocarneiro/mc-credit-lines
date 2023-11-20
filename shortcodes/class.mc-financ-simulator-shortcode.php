<?php

if( ! class_exists( 'MC_financ-simulator_Shortcode') ){  
    class MC_financ-simulator_Shortcode{
        public function __construct()
        {
            add_shortcode( 'mc_financ-simulator', array( $this, 'add_shortcode' ) );
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
            require( MC_financ-simulator_PATH . 'views/mc-financ-simulator-shortcode.php' );
            //enqueue all necessary scripts - register in class construct
            wp_enqueue_script( 'mc-financ-simulator-main-jp' );
            wp_enqueue_style( 'mc-financ-simulator-main-css' );
            wp_enqueue_style( 'mc-financ-simulator-style-css' );
            //Ativa a função que interfere em um arquivo JAVASCRIPT
            mc_financ-simulator_options();
            return ob_get_clean();
        }

    }
}