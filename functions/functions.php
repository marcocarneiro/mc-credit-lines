<?php

if( ! function_exists( 'mc_fin_simulator_options')){
    function mc_fin_simulator_options(){
        $show_bullets = isset( Mc_Fin_simulator_Settings::$options['mc_fin_simulator_bullets']) && Mc_Fin_simulator_Settings::$options['mc_fin_simulator_bullets']  == 1 ; true : false;

        //Inclui dinamicamente uma propriedade dentro de um arquivo JS sem precisar incluit código PHP
        wp_enqueue_script( 'mc-fin_simulator-options-js', MC_FIN_SIMULATOR_URL . 'vendor/flexfin_simulator/flexfin_simulator.js', array('jquery'), MC_FIN_SIMULATOR_VERSION, true );
        wp_localize_script( 'mc-fin_simulator-options-js', 'FIN_SIMULATOR_OPTIONS', array(
            'controlNav' => $show_bullets
        ) );
    }
}
