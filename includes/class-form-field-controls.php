<?php
/**
 * Form Field Controls
 *
 * Adds custom controls to the Elementor Pro form widget's form_fields repeater.
 *
 * Uses the correct API: controls_manager->get_control_from_stack()
 * instead of $element->get_controls(), so Elementor's sanitizer recognises
 * and preserves our fields when saving / during AJAX preview re-renders.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class MBR_EFI_Form_Field_Controls {

    private static $instance = null;

    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action(
            'elementor/element/form/section_form_fields/before_section_end',
            [ $this, 'add_icon_controls' ],
            10,
            2
        );
    }

    /**
     * Inject icon controls into the form_fields repeater.
     *
     * @param \Elementor\Widget_Base $widget The form widget instance.
     */
    public function add_icon_controls( $widget ) {

        /*
         * Use get_control_from_stack() — the correct method.
         * get_controls() returns a local copy that update_control() may not
         * properly persist for Elementor's sanitizer.
         * get_control_from_stack() fetches the authoritative registered data.
         */
        $elementor    = \Elementor\Plugin::instance();
        $control_data = $elementor->controls_manager->get_control_from_stack(
            $widget->get_unique_name(),
            'form_fields'
        );

        if ( is_wp_error( $control_data ) ) {
            return;
        }

        $new_fields = [

            'mbr_enable_icon' => [
                'name'         => 'mbr_enable_icon',
                'label'        => esc_html__( 'Enable Icon', 'mbr-elementor-form-icons' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'mbr-elementor-form-icons' ),
                'label_off'    => esc_html__( 'No', 'mbr-elementor-form-icons' ),
                'return_value' => 'yes',
                'default'      => '',
                'separator'    => 'before',
                'tab'          => 'content',
                'inner_tab'    => 'form_fields_content_tab',
                'tabs_wrapper' => 'form_fields_tabs',
            ],

            'mbr_selected_icon' => [
                'name'         => 'mbr_selected_icon',
                'label'        => esc_html__( 'Choose Icon', 'mbr-elementor-form-icons' ),
                'type'         => \Elementor\Controls_Manager::ICONS,
                'default'      => [
                    'value'   => 'fas fa-user',
                    'library' => 'fa-solid',
                ],
                'condition'    => [ 'mbr_enable_icon' => 'yes' ],
                'tab'          => 'content',
                'inner_tab'    => 'form_fields_content_tab',
                'tabs_wrapper' => 'form_fields_tabs',
            ],

            'mbr_icon_position' => [
                'name'         => 'mbr_icon_position',
                'label'        => esc_html__( 'Icon Position', 'mbr-elementor-form-icons' ),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'options'      => [
                    'above'       => esc_html__( 'Above Field', 'mbr-elementor-form-icons' ),
                    'placeholder' => esc_html__( 'In Placeholder', 'mbr-elementor-form-icons' ),
                ],
                'default'      => 'above',
                'condition'    => [ 'mbr_enable_icon' => 'yes' ],
                'tab'          => 'content',
                'inner_tab'    => 'form_fields_content_tab',
                'tabs_wrapper' => 'form_fields_tabs',
            ],

            'mbr_icon_color' => [
                'name'         => 'mbr_icon_color',
                'label'        => esc_html__( 'Icon Color', 'mbr-elementor-form-icons' ),
                'type'         => \Elementor\Controls_Manager::COLOR,
                'default'      => '#333333',
                'condition'    => [ 'mbr_enable_icon' => 'yes' ],
                'tab'          => 'content',
                'inner_tab'    => 'form_fields_content_tab',
                'tabs_wrapper' => 'form_fields_tabs',
            ],

            'mbr_icon_size' => [
                'name'         => 'mbr_icon_size',
                'label'        => esc_html__( 'Icon Size', 'mbr-elementor-form-icons' ),
                'type'         => \Elementor\Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px' => [ 'min' => 10, 'max' => 50, 'step' => 1 ],
                ],
                'default'      => [ 'unit' => 'px', 'size' => 16 ],
                'condition'    => [ 'mbr_enable_icon' => 'yes' ],
                'tab'          => 'content',
                'inner_tab'    => 'form_fields_content_tab',
                'tabs_wrapper' => 'form_fields_tabs',
            ],

        ];

        // Merge our fields into the repeater's existing fields array
        $control_data['fields'] = array_merge( $control_data['fields'], $new_fields );

        $widget->update_control( 'form_fields', $control_data );
    }
}
