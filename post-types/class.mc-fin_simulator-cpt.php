<?php

if( ! class_exists( 'MC_Fin_simulator_Post_Type')){
    class MC_Fin_simulator_Post_Type{
        function __construct(){
            add_action( 'init', array( $this, 'create_post_type' ) );
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes') );
            add_action( 'save_post', array( $this, 'save_post' ), 10, 2 );

            //Show other columns on admin panel. Filter manage_{cpt-name}_posts_columns
            add_filter('manage_mc-fin_simulator_posts_columns', array( $this, 'mc_fin_simulator_cpt_columns'));
            add_action( 'manage_mc-fin_simulator_posts_custom_column', array( $this, 'mc_fin_simulator_custom_columns'), 10, 2);
            //enable sortable CPT columns
            add_filter( 'manage_edit-mc-fin_simulator_sortable_columns', array( $this, 'mc_sortable_columns') );
            //image thumbnail column
            add_filter('manage_posts_columns', array( $this, 'posts_columns' ), 5);
            add_action('manage_posts_custom_column', array( $this, 'posts_custom_columns' ), 5, 2);          
        }

        public function create_post_type(){
            register_post_type(
                'mc-fin_simulator',
                array(
                    'label' => 'Fin_simulator',
                    'description' => 'Descrição Fin_simulators',
                    'labels' => array(
                        'name' => 'Fin_simulators',
                        'singular_name' => 'Fin_simulator'
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

        public function mc_fin_simulator_cpt_columns( $columns ){
            $columns['mc_fin_simulator_link_text'] = esc_html__('Link Text', 'mc-fin_simulator');
            $columns['mc_fin_simulator_link_url'] = esc_html__('Link URL', 'mc-fin_simulator');
            return $columns;
        }

        public function mc_fin_simulator_custom_columns( $column, $post_id){
            switch( $column ){
                case 'mc_fin_simulator_link_text':
                    echo esc_html( get_post_meta( $post_id, 'mc_fin_simulator_link_text', true ));
                break;
                case 'mc_fin_simulator_link_url':
                    echo esc_url( get_post_meta( $post_id, 'mc_fin_simulator_link_url', true ));
                break;
            }
        }

        public function mc_sortable_columns( $columns ){
            $columns['mc_fin_simulator_link_text'] = 'mc_fin_simulator_link_text';
            return $columns;
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
                'mc_fin_simulator_meta_box',
                'Link Options',
                array( $this, 'add_inner_meta_boxes'),
                'mc-fin_simulator',
                'normal',
                'high',
            );
        }        

        public function add_inner_meta_boxes( $post ){
            //formulário HTML
            require_once( MC_FIN_SIMULATOR_PATH . 'views/mc-fin_simulator_metabox.php' );
        }

        public function save_post( $post_id ){
            //check NONCE
            if( isset( $_POST['mc_fin_simulator_nonce'])){
                if( ! wp_verify_nonce( $_POST['mc_fin_simulator_nonce'], 'mc_fin_simulator_nonce' )){
                    return;
                }
            }

            //not save data if wp doing autosave
            if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
                return;
            }

            //check if is correct CPT and user can edit pages and posts
            if( isset( $_POST['post_type']) && $_POST['post_type'] === 'mc-fin_simulator' ){
                if( ! current_user_can( 'edit_page', $post_id ) ){
                    return;
                }elseif( ! current_user_can( 'edit_post', $post_id ) ){
                    return;
                }
            }

            if( isset( $_POST['action']) && $_POST['action'] == 'editpost'){
                $old_link_text = get_post_meta( $post_id, 'mc_fin_simulator_link_text', true );
                $new_link_text = $_POST['mc_fin_simulator_link_text'];
                $old_link_url  = get_post_meta( $post_id, 'mc_fin_simulator_link_url', true );
                $new_link_url = $_POST['mc_fin_simulator_link_url'];
                //checkbox
                $old_link_newwindow  = get_post_meta( $post_id, 'mc_fin_simulator_link_newwindow', true );
                $new_link_newwindow = $_POST['mc_fin_simulator_link_newwindow'];

                if(empty( $new_link_text )){
                    update_post_meta( $post_id, 'mc_fin_simulator_link_text', 'Add some text');
                }else{
                    update_post_meta( $post_id, 'mc_fin_simulator_link_text', sanitize_text_field( $new_link_text ), $old_link_text);
                }

                if(empty( $new_link_url )){
                    update_post_meta( $post_id, 'mc_fin_simulator_link_url', '#');
                }else{
                    update_post_meta( $post_id, 'mc_fin_simulator_link_url', sanitize_text_field( $new_link_url ), $old_link_url);
                }
                
                if(empty( $new_link_newwindow )){
                    update_post_meta( $post_id, 'mc_fin_simulator_link_newwindow', sanitize_text_field('0') );
                }else{
                    update_post_meta( $post_id, 'mc_fin_simulator_link_newwindow', sanitize_text_field( $new_link_newwindow ), $old_link_newwindow);
                }
                
            }
        }

    }
}
