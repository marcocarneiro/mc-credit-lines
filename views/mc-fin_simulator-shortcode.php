<h3>
    <?php echo (!empty( $content )) ? esc_html($content) : esc_html( Mc_Fin_simulator_Settings::$options['mc_fin_simulator_title'] ); ?>
</h3>
<div class="mc-fin_simulator flexfin_simulator <?php //include class with selected option in admin
    echo ( isset( Mc_Fin_simulator_Settings::$options['mc_fin_simulator_style']) ) ? esc_attr(Mc_Fin_simulator_Settings::$options['mc_fin_simulator_style']) : 'style-1';
?>
">
    <ul class="slides">
        <?php
        $args = array(
            'post_type' => 'mc-fin_simulator',
            'post_status' => 'publish',
            'post__in' => $id,
            'orderby' => $orderby
        );

        $mc_query = new WP_Query( $args );
        if( $mc_query->have_posts() ):
            while( $mc_query->have_posts() ): $mc_query->the_post(  );
            $button_text = get_post_meta( get_the_ID(), 'mc_fin_simulator_link_text', true );
            $button_url = get_post_meta( get_the_ID(), 'mc_fin_simulator_link_url', true );
            $newwindow = get_post_meta( get_the_ID(), 'mc_fin_simulator_link_newwindow', true );
        ?>
        <li>
            <?php if( has_post_thumbnail() ){
                the_post_thumbnail( 'full', array( 'class'=>'img-fluid' ) ); 
            }else{
                echo '<img src="'.MC_FIN_SIMULATOR_URL.'assets/images/default.jpg" class="img-fluid wp-post-image" >';
            }
            
            ?>
            <div class="mcs-container">
                <div class="fin_simulator-details-container">
                    <div class="wrapper">
                        <div class="fin_simulator-title">
                            <h2><?php the_title(); ?></h2>
                        </div>
                        <div class="fin_simulator-description">
                            <div class="subtitle"><?php the_content(); ?></div>
                            <a href="<?php echo esc_attr( $button_url ); ?>" class="link"
                            <?php echo $newwindow == '1' ? 'target="_blank"' : ''; ?>>
                            <?php echo esc_html( $button_text ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php 
        endwhile; 
        wp_reset_postdata(  );//restore default loop posts
    endif; 
    ?>
    </ul>
</div>