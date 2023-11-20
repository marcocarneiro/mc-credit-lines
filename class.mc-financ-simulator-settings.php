<?php

if (!class_exists('MC_financSimulator_Settings')) {
    class MC_financSimulator_Settings
    {
        public static $options;

        public function __construct(){
            self::$options = get_option( 'mc_financ-simulator_options' );
            add_action( 'admin_init', array($this, 'admin_init') );
        }

        public function admin_init(){
            register_setting( 
                'mc_financ-simulator_group', //option_group
                'mc_financ-simulator_options', //option_name
                array( $this, 'mc_financ-simulator_validate' ) //validation callback
            );
            //Sections of plugin page
            add_settings_section( 
                'mc_financ-simulator_second_section', //id
                'Other plugin options', //title
                null, //callback
                'mc_financ-simulator_page2', //page
                null //args
            );
            add_settings_section( 
                'mc_financ-simulator_main_section', //id
                'How does it work?', //title
                null, //callback
                'mc_financ-simulator_page1', //page
                null //args
            );

            //fields to section settings
            add_settings_field( 
                'mc_financ-simulator_shortcode', //id
                'Shortcode', //title
                array( $this, 'mc_financ-simulator_shortcode_callback' ), //callback
                'mc_financ-simulator_page1', //page id
                'mc_financ-simulator_main_section', //id section
                null //args
            );
            add_settings_field( 
                'mc_financ-simulator_title', //id
                'financ-simulator title', //title
                array( $this, 'mc_financ-simulator_title_callback' ), //callback
                'mc_financ-simulator_page2', //page id
                'mc_financ-simulator_second_section', //id section
                array(                    
                    'label_for' => 'mc_financ-simulator_title'
                )
            );
            add_settings_field( 
                'mc_financ-simulator_bullets', //id
                'Display bullets', //title
                array( $this, 'mc_financ-simulator_bullets_callback' ), //callback
                'mc_financ-simulator_page2', //page id
                'mc_financ-simulator_second_section', //id section
                array(                    
                    'label_for' => 'mc_financ-simulator_bullets'
                )
            );
            add_settings_field( 
                'mc_financ-simulator_style', //id
                'financ-simulator style', //title
                array( $this, 'mc_financ-simulator_style_callback' ), //callback
                'mc_financ-simulator_page2', //page id
                'mc_financ-simulator_second_section', //id section
                array(
                    'items' => array(
                        'style-1',
                        'style-2'
                    ),
                    'label_for' => 'mc_financ-simulator_style'
                )
            );
        }

        //validate method for all fields
        public function mc_financSimulator_validate( $input ){
            $new_input = array();
            foreach( $input as $key => $value ){
                switch( $key ){
                    case 'mc_financ-simulator_title':
                        if( empty( $value )){
                            $value = 'Please, type some text';
                        }
                        $new_input[$key] = sanitize_text_field( $value );
                    break;
                    case 'mc_financ-simulator_url':
                        $new_input[$key] = esc_url( $value );
                    break;
                    case 'mc_financ-simulator_int':
                        $new_input[$key] = absint( $value );
                    break;
                    default:
                        $new_input[$key] = sanitize_text_field( $value );
                    break;
                }                
            }
            return $new_input;
        }

        public function mc_financSimulator_shortcode_callback(){
            ?>
            <span>Use the shortcode [mc_financ-simulator] to display financ-simulator in any page/post/widget</span>
            <?php
        }

        public function mc_financSimulator_title_callback(){
            ?>
                <input type="text" 
                name="mc_financ-simulator_options[mc_financ-simulator_title]" 
                id="mc_financ-simulator_title"
                value="<?php echo isset( self::$options['mc_financ-simulator_title'] ) ? esc_attr( self::$options['mc_financ-simulator_title'] ) : ''; ?>"
                >
            <?php
        }

        public function mc_financSimulator_bullets_callback(){
            ?>
                <input type="checkbox" 
                name="mc_financ-simulator_options[mc_financ-simulator_bullets]" 
                id="mc_financ-simulator_bullets"
                value="1"
                <?php
                    if( isset( self::$options['mc_financ-simulator_bullets'] ) ){
                        checked( '1', self::$options['mc_financ-simulator_bullets'], true );
                    }                    
                ?>
                >
                <label for="mc_financ-simulator_bullets">Whether to display bullets or not</label>
            <?php
        }

        public function mc_financSimulator_style_callback( $args ){
            ?>
                <select 
                name="mc_financ-simulator_options[mc_financ-simulator_style]" 
                id="mc_financ-simulator_style">
                    <?php
                        foreach( $args['items'] as $item):
                    ?>
                        <option value="<?php echo esc_attr( $item );?>" 
                        <?php isset( self::$options['mc_financ-simulator_style'] ) ? selected( $item, self::$options['mc_financ-simulator_style'], true ): ''; ?>     
                        >
                        <?php echo esc_html( ucfirst( $item )); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php
        }


    }
}
