<?php

if( ! function_exists( 'mc_financ-simulator_options')){
    function mc_financ-simulator_options(){
        $show_bullets = isset( Mc_financ-simulator_Settings::$options['mc_financ-simulator_bullets']) && Mc_financ-simulator_Settings::$options['mc_financ-simulator_bullets']  == 1 ; true : false;

        //Inclui dinamicamente uma propriedade dentro de um arquivo JS sem precisar incluit código PHP
        wp_enqueue_script( 'mc-financ-simulator-options-js', MC_financ-simulator_URL . 'vendor/flexfinanc-simulator/flexfinanc-simulator.js', array('jquery'), MC_financ-simulator_VERSION, true );
        wp_localize_script( 'mc-financ-simulator-options-js', 'financ-simulator_OPTIONS', array(
            'controlNav' => $show_bullets
        ) );
    }
}
