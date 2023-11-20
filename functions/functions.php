<?php

if( ! function_exists( 'mc_financSimulator_options')){
    function mc_financSimulator_options(){
        $show_bullets = isset( Mc_financSimulator_Settings::$options['mc_financSimulator_bullets']) && Mc_financSimulator_Settings::$options['mc_financSimulator_bullets']  == 1 ; true : false;

        //Inclui dinamicamente uma propriedade dentro de um arquivo JS sem precisar incluir código PHP
        //wp_enqueue_script( 'mc-financ-simulator-options-js', MC_financ-simulator_URL . 'vendor/flexfinanc-simulator/flexfinanc-simulator.js', array('jquery'), MC_financSimulator_VERSION, true );
        //wp_localize_script( 'mc-financ-simulator-options-js', 'financ-simulator_OPTIONS', array(
            //'controlNav' => $show_bullets
        //) );
    }
}
