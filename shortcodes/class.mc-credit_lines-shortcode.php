<?php

if( ! class_exists( 'MC_credit_lines_Shortcode') ){  
    class MC_credit_lines_Shortcode{

        public function __construct()
        {
            add_shortcode( 'mc_credit_lines', array( $this, 'add_shortcode' ) );
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
            require( MC_credit_lines_PATH . 'views/mc-credit_lines-shortcode.php' );
            //enqueue all necessary scripts - register in class construct
            wp_enqueue_script( 'mc-credit_lines-main-jp' );
            wp_enqueue_style( 'mc-credit_lines-main-css' );
            wp_enqueue_style( 'mc-credit_lines-style-css' );
            //Ativa a função que interfere em um arquivo JAVASCRIPT
            mc_credit_lines_options();
            return ob_get_clean();
        }

    }
}