<?php

if (!class_exists('Mc_credit_lines_Settings')) {
    class Mc_credit_lines_Settings
    {
        public static $options;

        public function __construct(){
            self::$options = get_option( 'mc_credit_lines_options' );
            add_action( 'admin_init', array($this, 'admin_init') );
        }

        public function admin_init(){
            register_setting( 
                'mc_credit_lines_group', //option_group
                'mc_credit_lines_options', //option_name
                array( $this, 'mc_credit_lines_validate' ) //validation callback
            );
            //Sections of plugin page
            add_settings_section( 
                'mc_credit_lines_second_section', //id
                'Other plugin options', //title
                null, //callback
                'mc_credit_lines_page2', //page
                null //args
            );
            add_settings_section( 
                'mc_credit_lines_main_section', //id
                'How does it work?', //title
                null, //callback
                'mc_credit_lines_page1', //page
                null //args
            );

            //fields to section settings
            add_settings_field( 
                'mc_credit_lines_shortcode', //id
                'Shortcode', //title
                array( $this, 'mc_credit_lines_shortcode_callback' ), //callback
                'mc_credit_lines_page1', //page id
                'mc_credit_lines_main_section', //id section
                null //args
            );
            add_settings_field( 
                'mc_credit_lines_title', //id
                'credit_lines title', //title
                array( $this, 'mc_credit_lines_title_callback' ), //callback
                'mc_credit_lines_page2', //page id
                'mc_credit_lines_second_section', //id section
                array(                    
                    'label_for' => 'mc_credit_lines_title'
                )
            );
            add_settings_field( 
                'mc_credit_lines_bullets', //id
                'Display bullets', //title
                array( $this, 'mc_credit_lines_bullets_callback' ), //callback
                'mc_credit_lines_page2', //page id
                'mc_credit_lines_second_section', //id section
                array(                    
                    'label_for' => 'mc_credit_lines_bullets'
                )
            );
            add_settings_field( 
                'mc_credit_lines_style', //id
                'credit_lines style', //title
                array( $this, 'mc_credit_lines_style_callback' ), //callback
                'mc_credit_lines_page2', //page id
                'mc_credit_lines_second_section', //id section
                array(
                    'items' => array(
                        'style-1',
                        'style-2'
                    ),
                    'label_for' => 'mc_credit_lines_style'
                )
            );
        }

        //validate method for all fields
        public function mc_credit_lines_validate( $input ){
            $new_input = array();
            foreach( $input as $key => $value ){
                switch( $key ){
                    case 'mc_credit_lines_title':
                        if( empty( $value )){
                            $value = 'Please, type some text';
                        }
                        $new_input[$key] = sanitize_text_field( $value );
                    break;
                    case 'mc_credit_lines_url':
                        $new_input[$key] = esc_url( $value );
                    break;
                    case 'mc_credit_lines_int':
                        $new_input[$key] = absint( $value );
                    break;
                    default:
                        $new_input[$key] = sanitize_text_field( $value );
                    break;
                }                
            }
            return $new_input;
        }

        public function mc_credit_lines_shortcode_callback(){
            ?>
            <span>Use the shortcode [mc_credit_lines] to display credit_lines in any page/post/widget</span>
            <?php
        }

        public function mc_credit_lines_title_callback(){
            ?>
                <input type="text" 
                name="mc_credit_lines_options[mc_credit_lines_title]" 
                id="mc_credit_lines_title"
                value="<?php echo isset( self::$options['mc_credit_lines_title'] ) ? esc_attr( self::$options['mc_credit_lines_title'] ) : ''; ?>"
                >
            <?php
        }

        public function mc_credit_lines_bullets_callback(){
            ?>
                <input type="checkbox" 
                name="mc_credit_lines_options[mc_credit_lines_bullets]" 
                id="mc_credit_lines_bullets"
                value="1"
                <?php
                    if( isset( self::$options['mc_credit_lines_bullets'] ) ){
                        checked( '1', self::$options['mc_credit_lines_bullets'], true );
                    }                    
                ?>
                >
                <label for="mc_credit_lines_bullets">Whether to display bullets or not</label>
            <?php
        }

        public function mc_credit_lines_style_callback( $args ){
            ?>
                <select 
                name="mc_credit_lines_options[mc_credit_lines_style]" 
                id="mc_credit_lines_style">
                    <?php
                        foreach( $args['items'] as $item):
                    ?>
                        <option value="<?php echo esc_attr( $item );?>" 
                        <?php isset( self::$options['mc_credit_lines_style'] ) ? selected( $item, self::$options['mc_credit_lines_style'], true ): ''; ?>     
                        >
                        <?php echo esc_html( ucfirst( $item )); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php
        }


    }
}
