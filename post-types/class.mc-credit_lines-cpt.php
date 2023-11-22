<?php

if( ! class_exists( 'MC_credit_lines_Post_Type')){
    class MC_credit_lines_Post_Type{
        function __construct(){
            add_action( 'init', array( $this, 'create_post_type' ) );
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes') );
            add_action( 'save_post', array( $this, 'save_post' ), 10, 2 );

            //Show other columns on admin panel. Filter manage_{cpt-name}_posts_columns
            add_filter('manage_mc-credit_lines_posts_columns', array( $this, 'mc_credit_lines_cpt_columns'));
            add_action( 'manage_mc-credit_lines_posts_custom_column', array( $this, 'mc_credit_lines_custom_columns'), 10, 2);
            //enable sortable CPT columns
            add_filter( 'manage_edit-mc-credit_lines_sortable_columns', array( $this, 'mc_sortable_columns') );
            //image thumbnail column
            add_filter('manage_posts_columns', array( $this, 'posts_columns' ), 5);
            add_action('manage_posts_custom_column', array( $this, 'posts_custom_columns' ), 5, 2);          
        }

        public function create_post_type(){
            register_post_type(
                'mc-credit_lines',
                array(
                    'label' => 'Linha de crédito',
                    'description' => 'Descrição credit_lines',
                    'labels' => array(
                        'name' => 'credit_lines',
                        'singular_name' => 'credit_line'
                    ),
                    'public' => true,
                    'supports' => array(
                        'title', 'editor', 'thumbnail'
                    ),
                    'hierarchical' => false,
                    'show_ui' => true,
                    'show_in_menu' => false,
                    'menu_position' => 10,
                    'show_in_admin_bar' => true,
                    'can_export' => true,
                    'has_archive' => false,
                    'exclude_from_search' => false,
                    'publicly_queryable' => true,
                    'show_in_rest' => true,
                    'menu_icon' => 'dashicons-images-alt2'
                )
            );            
        }

        public function mc_credit_lines_cpt_columns( $columns ){
            $columns['mc_credit_lines_nome_linha'] = esc_html__('Nome da linha de crédito', 'mc-credit_lines');
            $columns['mc_credit_lines_parcelas'] = esc_html__('Máximo de parcelas', 'mc-credit_lines');
            $columns['mc_credit_lines_taxa'] = esc_html__('Taxa de juros', 'mc-credit_lines');
            return $columns;
        }

        public function mc_credit_lines_custom_columns( $column, $post_id){
            switch( $column ){
                case 'mc_credit_lines_nome_linha':
                    echo esc_html( get_post_meta( $post_id, 'mc_credit_lines_nome_linha', true ));
                break;
                case 'mc_credit_lines_parcelas':
                    echo esc_html( get_post_meta( $post_id, 'mc_credit_lines_parcelas', true ));
                break;
                case 'mc_credit_lines_taxa':
                    echo esc_html( get_post_meta( $post_id, 'mc_credit_lines_taxa', true ));
                break;
            }
        }

        public function mc_sortable_columns( $columns ){
            /* $columns['mc_credit_lines_nome_linha'] = 'mc_credit_lines_nome_linha';
            return $columns; */
        }

        //show column image thumbnails methods
        public function posts_columns($defaults){            
            $defaults['my_post_thumbs'] = __('Imagem');
            return $defaults;
        }
        public function posts_custom_columns($column_name, $id){
            add_image_size( 'admin-thumb', 100, 999999 );
            if($column_name === 'my_post_thumbs'){
                echo the_post_thumbnail( 'admin-thumb' );
            }
        }

        public function add_meta_boxes(){
            add_meta_box( 
                'mc_credit_lines_meta_box',
                'Opções para a Linha de crédito',
                array( $this, 'add_inner_meta_boxes'),
                'mc-credit_lines',
                'normal',
                'high',
            );
        }        

        public function add_inner_meta_boxes( $post ){
            //formulário HTML
            require_once( MC_credit_lines_PATH . 'views/mc-credit_lines_metabox.php' );
        }

        public function save_post( $post_id ){
            //check NONCE
            if( isset( $_POST['mc_credit_lines_nonce'])){
                if( ! wp_verify_nonce( $_POST['mc_credit_lines_nonce'], 'mc_credit_lines_nonce' )){
                    return;
                }
            }

            //not save data if wp doing autosave
            if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
                return;
            }

            //check if is correct CPT and user can edit pages and posts
            if( isset( $_POST['post_type']) && $_POST['post_type'] === 'mc-credit_lines' ){
                if( ! current_user_can( 'edit_page', $post_id ) ){
                    return;
                }elseif( ! current_user_can( 'edit_post', $post_id ) ){
                    return;
                }
            }

            if( isset( $_POST['action']) && $_POST['action'] == 'editpost'){
                $old_nome_linha = get_post_meta( $post_id, 'mc_credit_lines_nome_linha', true );
                $new_nome_linha = $_POST['mc_credit_lines_nome_linha'];
                $old_parcelas  = get_post_meta( $post_id, 'mc_credit_lines_parcelas', true );
                $new_parcelas = $_POST['mc_credit_lines_parcelas'];
                $old_taxa  = get_post_meta( $post_id, 'mc_credit_lines_taxa', true );
                $new_taxa = $_POST['mc_credit_lines_taxa'];
                

                if(empty( $new_nome_linha )){
                    update_post_meta( $post_id, 'mc_credit_lines_nome_linha', 'Add some text');
                }else{
                    update_post_meta( $post_id, 'mc_credit_lines_nome_linha', sanitize_text_field( $new_nome_linha ), $old_nome_linha);
                }

                if(empty( $new_parcelas )){
                    update_post_meta( $post_id, 'mc_credit_lines_parcelas', '0');
                }else{
                    update_post_meta( $post_id, 'mc_credit_lines_parcelas', sanitize_text_field( $new_parcelas ), $old_parcelas);
                }
                
                if(empty( $new_taxa )){
                    update_post_meta( $post_id, 'mc_credit_lines_taxa', '0');
                }else{
                    update_post_meta( $post_id, 'mc_credit_lines_taxa', sanitize_text_field( $new_taxa ), $old_taxa);
                }
                
            }
        }

    }
}
