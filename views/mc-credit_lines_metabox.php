<?php
    $nome_linha = get_post_meta( $post->ID, 'mc_credit_lines_nome_linha', true );
    $parcelas = get_post_meta( $post->ID, 'mc_credit_lines_parcelas', true );
    $taxa = get_post_meta( $post->ID, 'mc_credit_lines_taxa', true );
?>
<table class="form-table mc-credit_lines-metabox">
    <?php //CAMPO OCULTO COM NONCE - SEGURANÇA // ?>
    <input type="hidden" name="mc_credit_lines_nonce" value="<?php echo wp_create_nonce( 'mc_credit_lines_nonce' ); ?>">
    <tr>
        <th>
            <label for="mc_credit_lines_nome_linha">Nome da Linha de Crédito</label>
        </th>
        <td>
            <input 
            type="text"
            name="mc_credit_lines_nome_linha"
            id="mc_credit_lines_nome_linha"
            class="regular-text"
            value="<?php echo ( isset( $nome_linha )) ? esc_html( $nome_linha ) : ''; ?>"
            required
        >
        </td>
    </tr>
    <tr>
        <th>
            <label for="mc_credit_lines_parcelas">Máximo de parcelas </label>
        </th>
        <td>
            <input 
            type="number"
            name="mc_credit_lines_parcelas"
            id="mc_credit_lines_parcelas"
            class="regular-text"
            value="<?php echo ( isset( $parcelas )) ? esc_html( $parcelas ) : ''; ?>"
            required
        >
        </td>
    </tr>
    <tr>
        <th>
            <label for="mc_credit_lines_taxa">Taxa de juros</label>
        </th>
        <td>
            <input 
            type="number"
            name="mc_credit_lines_taxa"
            id="mc_credit_lines_taxa"
            class="regular-text"
            value="<?php echo ( isset( $taxa )) ? esc_html( $taxa ) : ''; ?>"
            required
        > %
        </td>
    </tr>
</table>