<p>
    Exibiu a bagaça!!!
</p>

<!-- <h3>
    <?php echo (!empty( $content )) ? esc_html($content) : esc_html( Mc_credit_lines_Settings::$options['mc_credit_lines_title'] ); ?>
</h3>
<div class="mc-credit_lines flexcredit_lines <?php //include class with selected option in admin
    echo ( isset( Mc_credit_lines_Settings::$options['mc_credit_lines_style']) ) ? esc_attr(Mc_credit_lines_Settings::$options['mc_credit_lines_style']) : 'style-1';
?>
">
    <ul class="slides">
        <?php
        $args = array(
            'post_type' => 'mc-credit_lines',
            'post_status' => 'publish',
            'post__in' => $id,
            'orderby' => $orderby
        );

        $mc_query = new WP_Query( $args );
        if( $mc_query->have_posts() ):
            while( $mc_query->have_posts() ): $mc_query->the_post(  );
            $button_nome = get_post_meta( get_the_ID(), 'mc_credit_lines_nome_linha', true );
            $button_parcelas = get_post_meta( get_the_ID(), 'mc_credit_lines_parcelas', true );
            $taxa = get_post_meta( get_the_ID(), 'mc_credit_lines_taxa', true );
        ?>
        <li>
            <?php if( has_post_thumbnail() ){
                the_post_thumbnail( 'full', array( 'class'=>'img-fluid' ) ); 
            }else{
                echo '<img src="'.MC_credit_lines_URL.'assets/images/default.jpg" class="img-fluid wp-post-image" >';
            }            
            ?>
            <div class="mcs-container">
                <div class="credit_lines-details-container">
                    <div class="wrapper">
                        <div class="credit_lines-title">
                            <h2><?php the_title(); ?></h2>
                        </div>
                        <div class="credit_lines-description">
                            <div class="subtitle"><?php the_content(); ?></div>
                            <span>O que é isso?</span>
                            <a href="<?php echo esc_attr( $button_parcelas ); ?>" class="link"
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
</div> -->