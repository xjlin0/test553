<?php

class BridgeCoreElementorInfoCardWithIcon extends \Elementor\Widget_Base{
    public function get_name() {
        return 'bridge_info_card_with_icon';
    }

    public function get_title() {
        return esc_html__('Info Card With Icon', 'bridge-core');
    }

    public function get_icon() {
        return 'bridge-elementor-custom-icon bridge-elementor-info-card-with-icon';
    }

    public function get_categories() {
        return [ 'qode' ];
    }

    protected function _register_controls(){
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'bridge-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'bridge-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        bridge_qode_icon_collections()->getElementorParamsArray($this, '', '', true);

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'bridge-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title Tag', 'bridge-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''   => '',
                    'h2' => 'h2',
                    'h3' => 'h3',
                    'h4' => 'h4',
                    'h5' => 'h5',
                    'h6' => 'h6',
                ],
                'default' => 'h3'
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'bridge-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'bridge-core'),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'target',
            [
                'label' => esc_html__('Target', 'bridge-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '_self' => esc_html__('Self', 'bridge-core'),
                    '_blank' => esc_html__('Blank', 'bridge-core'),
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon Style', 'bridge-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'bridge-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'qode-icon-tiny' => esc_html__( 'Tiny', 'bridge-core' ),
                    'qode-icon-small' => esc_html__( 'Small', 'bridge-core' ),
                    'qode-icon-medium' => esc_html__( 'Medium', 'bridge-core' ),
                    'qode-icon-large' => esc_html__( 'Large', 'bridge-core' ),
                    'qode-icon-huge' => esc_html__( 'Very Large', 'bridge-core' )
                ],
                'default' => 'qode-icon-medium',
                'condition' => [
                    'icon_pack' => array('font_awesome', 'font_elegant', 'linea_icons', 'dripicons')
                ]
            ]
        );

        $this->add_control(
            'custom_icon_size',
            [
                'label' => esc_html__( 'Icon Custom Size (px)', 'bridge-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'icon_pack' => array('font_awesome', 'font_elegant', 'linea_icons', 'dripicons')
                ]
            ]
        );

        $this->add_control(
            'icon_shape_size',
            [
                'label' => esc_html__( 'Icon Shape Size (px)', 'bridge-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'icon_pack' => array('font_awesome', 'font_elegant', 'linea_icons', 'dripicons')
                ]
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'bridge-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'icon_pack' => array('font_awesome', 'font_elegant', 'linea_icons', 'dripicons')
                ]
            ]
        );

        $this->add_control(
            'icon_background_color',
            [
                'label' => esc_html__( 'Icon Background Color', 'bridge-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'icon_pack' => array('font_awesome', 'font_elegant', 'linea_icons', 'dripicons')
                ]
            ]
        );

        $this->add_control(
            'hover_icon_color',
            [
                'label' => esc_html__( 'Hover Icon Color', 'bridge-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'icon_pack' => array('font_awesome', 'font_elegant', 'linea_icons', 'dripicons')
                ]
            ]
        );

        $this->add_control(
            'hover_icon_background_color',
            [
                'label' => esc_html__( 'Hover Icon Background Color', 'bridge-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'icon_pack' => array('font_awesome', 'font_elegant', 'linea_icons', 'dripicons')
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();

        if( ! empty( $params['image'] ) ){
            $params['image'] = $params['image']['id'];
        }

        $params['icon'] = bridge_qode_icon_collections()->getElementorIconFromIconPack( $params );

        $params['holder_classes'] = $this->getIconHolderClasses($params);
        $params['icon_holder_style'] = $this->getIconHolderStyle($params);
        $params['icon_holder_data'] = $this->getIconHolderData($params);
        $params['icon_style'] = $this->getIconStyle($params);

        echo bridge_core_get_shortcode_template_part('templates/info-card-with-icon-template', 'info-card-with-icon', '', $params);
    }

    private function getIconHolderClasses($params) {
        $classes = array('qode-icon-holder', 'qode-icon-circle');

        if($params['custom_icon_size'] == '') {
            $classes[] = $params['icon_size'];
        }

        return implode(' ', $classes);
    }

    private function getIconHolderStyle($params) {
        $style = array();

        if($params['custom_icon_size']) {
            $style[] = 'font-size:' . $params['custom_icon_size'] . 'px';
        }
        if($params['icon_background_color']) {
            $style[] = 'background-color:' . $params['icon_background_color'];
        }
        if(!empty($params['icon_shape_size'])) {
            $style[] = 'width: '.bridge_qode_filter_px($params['icon_shape_size']).'px';
            $style[] = 'height: '.bridge_qode_filter_px($params['icon_shape_size']).'px';
            $style[] = 'line-height: '.bridge_qode_filter_px($params['icon_shape_size']).'px';
        }
        return $style;
    }
    private function getIconStyle($params) {
        $style = array();


        if($params['icon_color']) {
            $style[] = 'color:' . $params['icon_color'];
        }

        return implode(';', $style);
    }
    private function getIconHolderData($params) {
        $iconHolderData = array();


        if(!empty($params['hover_icon_background_color'])) {
            $iconHolderData['data-hover-background-color'] = $params['hover_icon_background_color'];
        }

        if(!empty($params['hover_icon_color'])) {
            $iconHolderData['data-hover-color'] = $params['hover_icon_color'];
        }

        if(!empty($params['icon_color'])) {
            $iconHolderData['data-color'] = $params['icon_color'];
        }

        return $iconHolderData;
    }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BridgeCoreElementorInfoCardWithIcon() );