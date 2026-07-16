<?php
/**
 * Form Field Renderer
 *
 * Injects icon HTML into the Elementor Pro form widget's rendered output.
 *
 * Runs in three contexts:
 *   1. Editor initial load (is_edit_mode = YES)  — server-side render on page load
 *   2. Editor AJAX re-render (is_edit_mode = NO, is_preview_mode = YES or NO) — fires when settings change
 *   3. Public frontend (both = NO)
 *
 * We run in ALL three contexts. Never bail based on edit/preview mode.
 *
 * Regex strategy: target the label by for="form-field-{custom_id}" for 'above' mode,
 * and the input/textarea by id="form-field-{custom_id}" for 'placeholder' mode.
 * Both are unique, stable, and don't require matching nested divs.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class MBR_EFI_Form_Field_Renderer {

    private static $instance = null;
    private $fields_with_icons = [];

    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action( 'elementor/widget/before_render_content', [ $this, 'capture_form_settings' ] );
        add_filter( 'elementor/widget/render_content',        [ $this, 'inject_icons' ], 10, 2 );
    }

    /**
     * Read settings before the widget renders and store which fields need icons.
     */
    public function capture_form_settings( $widget ) {
        if ( 'form' !== $widget->get_name() ) {
            return;
        }

        $this->fields_with_icons = [];
        $settings = $widget->get_settings_for_display();

        if ( empty( $settings['form_fields'] ) ) {
            return;
        }

        foreach ( $settings['form_fields'] as $field ) {
            if ( empty( $field['mbr_enable_icon'] ) || 'yes' !== $field['mbr_enable_icon'] ) {
                continue;
            }

            $icon_value = $field['mbr_selected_icon']['value'] ?? '';
            if ( ! $icon_value ) {
                continue;
            }

            $this->fields_with_icons[ $field['custom_id'] ] = [
                'icon_value'    => $icon_value,
                'icon_position' => $field['mbr_icon_position'] ?? 'above',
                'icon_color'    => $field['mbr_icon_color']    ?: '#333333',
                'icon_size'     => intval( $field['mbr_icon_size']['size'] ?? 16 ),
            ];
        }
    }

    /**
     * Inject icon markup into the rendered widget HTML.
     */
    public function inject_icons( $content, $widget ) {
        if ( 'form' !== $widget->get_name() ) {
            return $content;
        }

        if ( empty( $this->fields_with_icons ) ) {
            return $content;
        }

        foreach ( $this->fields_with_icons as $field_id => $icon ) {

            $base_style = sprintf(
                'color:%s;font-size:%dpx;line-height:1;',
                esc_attr( $icon['icon_color'] ),
                $icon['icon_size']
            );

            if ( 'above' === $icon['icon_position'] ) {

                /*
                 * Inject icon immediately after the opening <label> tag.
                 * We target the label by its for="form-field-{custom_id}" attribute.
                 * This is unique per field and doesn't require matching nested divs.
                 */
                $icon_tag = sprintf(
                    '<i class="%s mbr-efi-icon" aria-hidden="true" style="%sdisplay:inline-block;margin-right:5px;"></i>',
                    esc_attr( $icon['icon_value'] ),
                    $base_style
                );

                $pattern = '/(<label\s[^>]*for="form-field-' . preg_quote( $field_id, '/' ) . '"[^>]*>)/i';
                $content = preg_replace( $pattern, '$1' . $icon_tag, $content, 1 );

            } else {

                /*
                 * Placeholder mode: inject icon immediately before the input or textarea.
                 * The field group div also gets position:relative via an inline style
                 * injected onto the field group's class attribute match.
                 *
                 * Icon is placed absolutely inside the field group via CSS/inline style.
                 * Input padding is handled by our plugin CSS (.mbr-efi-placeholder-group input).
                 */
                $icon_tag = sprintf(
                    '<i class="%s mbr-efi-placeholder-icon" aria-hidden="true" style="%sposition:absolute;left:12px;top:50%%;transform:translateY(-50%%);pointer-events:none;z-index:1;"></i>',
                    esc_attr( $icon['icon_value'] ),
                    $base_style
                );

                // Add position:relative and our marker class to the field group div
                $group_pattern = '/(class="[^"]*elementor-field-group-' . preg_quote( $field_id, '/' ) . '[^"]*")/i';
                $content = preg_replace(
                    $group_pattern,
                    '$1 style="position:relative;"',
                    $content,
                    1
                );

                // Inject icon before the input element
                $input_pattern = '/(<input[^>]+id="form-field-' . preg_quote( $field_id, '/' ) . '"[^>]*>)/i';
                if ( preg_match( $input_pattern, $content ) ) {
                    $content = preg_replace( $input_pattern, $icon_tag . '$1', $content, 1 );
                } else {
                    // Textarea
                    $textarea_pattern = '/(<textarea[^>]+id="form-field-' . preg_quote( $field_id, '/' ) . '"[^>]*>)/i';
                    $content = preg_replace( $textarea_pattern, $icon_tag . '$1', $content, 1 );
                }
            }
        }

        return $content;
    }
}
