<?php
    //Usar esc_html para escapar código HTML e esc_attr para atributos de tags HTML
?>
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

<table class="simulacao_tabela">
    <tr>
        <td colspan="2">
            Digite o valor desejado e em seguida digite as parcelas<br>
            <small>(taxa de <?php echo esc_html($taxa); ?>% / mês):</small>
        </td>
    </tr>
    <tr>
        <td>
            <label>Valor desejado</label><br>  
            <input type="number" class="simulacao_valor" value="0">
        </td>
        <td>
            <label>Número de parcelas:</label><br>
            <input type="number" class="simulacao_parcelas" 
            oninput="calc_parcelas(<?php echo esc_attr($taxa); ?>, <?php echo esc_attr($button_parcelas); ?>, this.value, this)" 
            placeholder="Digite num. de parcelas">
        </td> 
    </tr>
    <tr>
        <td colspan="2">
            <p>Valor das parcelas:</p>
            <h2 id="simulacao_resultado">
            <span class="txt_val_parcelas">0,00</span></h2>
        </td>
    </tr>
</table>

<?php 
    endwhile; 
    wp_reset_postdata(  );//restore default loop posts
endif; 
?>
