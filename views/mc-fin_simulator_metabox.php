<?php
    $link_text = get_post_meta( $post->ID, 'mc_fin_simulator_link_text', true );
    $link_url = get_post_meta( $post->ID, 'mc_fin_simulator_link_url', true );
    $link_newwindow = get_post_meta( $post->ID, 'mc_fin_simulator_link_newwindow', true );
?>
<table class="form-table mc-fin_simulator-metabox">
    <?php //CAMPO OCULTO COM NONCE - SEGURANÇA // ?>
    <input type="hidden" name="mc_fin_simulator_nonce" value="<?php echo wp_create_nonce( 'mc_fin_simulator_nonce' ); ?>">
    <tr>
        <th>
            <label for="mc_fin_simulator_link_text">Link Text</label>
        </th>
        <td>
            <input 
            type="text"
            name="mc_fin_simulator_link_text"
            id="mc_fin_simulator_link_text"
            class="regular-text link-text"
            value="<?php echo ( isset( $link_text )) ? esc_html( $link_text ) : ''; ?>"
            required
        >
        </td>
    </tr>
    <tr>
        <th>
            <label for="mc_fin_simulator_link_url">Link URL</label>
        </th>
        <td>
            <input 
            type="url"
            name="mc_fin_simulator_link_url"
            id="mc_fin_simulator_link_url"
            class="regular-text link-url"
            value="<?php echo ( isset( $link_url )) ? esc_html( $link_url ) : ''; ?>"
            required
        >
        </td>
    </tr>
    <tr>
        <th>
            <label for="mc_fin_simulator_link_newwindow">Open in a new window?</label>
        </th>
        <td>
            <input type="checkbox" 
                name="mc_fin_simulator_link_newwindow" 
                id="mc_fin_simulator_link_newwindow"
                value="1"
                <?php
                    if( isset( $link_newwindow ) ){
                        checked( '1', $link_newwindow, true );
                    }                    
                ?>
            >
        </td>
    </tr>
</table>