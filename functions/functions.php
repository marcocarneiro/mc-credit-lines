<?php

if( ! function_exists( 'mc_credit_lines_options')){
    function mc_credit_lines_options(){
        $show_bullets = isset( Mc_credit_lines_Settings::$options['mc_credit_lines_bullets']) && Mc_credit_lines_Settings::$options['mc_credit_lines_bullets']  == 1 ; true : false;

        //Inclui dinamicamente uma propriedade dentro de um arquivo JS sem precisar incluit código PHP
        wp_enqueue_script( 'mc-credit_lines-options-js', MC_credit_lines_URL . 'vendor/flexcredit_lines/flexcredit_lines.js', array('jquery'), MC_credit_lines_VERSION, true );
        wp_localize_script( 'mc-credit_lines-options-js', 'credit_lines_OPTIONS', array(
            'controlNav' => $show_bullets
        ) );
    }
}
