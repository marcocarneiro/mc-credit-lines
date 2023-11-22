jQuery(window).load(function(){
    jQuery('.flexfin_simulator').flexfin_simulator({
        animation: 'slide',
        touch: true,
        directionNav: false,
        smoothHeight: true,
        controlNav: FIN_SIMULATOR_OPTIONS.controlNav,
    });
});