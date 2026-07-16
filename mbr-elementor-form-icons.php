<?php
/**
 * Plugin Name: MBR Elementor Form Icons
 * Plugin URI: https://littlewebshack.com
 * Description: Add Font Awesome icons to Elementor Pro form fields — supports both classic Form widget and atomic Form > Input elements
 * Version: 1.5.1
 * Author: Robert Palmer
 * Author URI: https://littlewebshack.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mbr-elementor-form-icons
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'plugin_row_meta', function ( $links, $file, $data ) {
    if ( $file !== plugin_basename( __FILE__ ) ) return $links;
    $links[] = sprintf(
        '<a href="%s" target="_blank" rel="noopener nofollow">☕ %s</a>',
        esc_url( 'https://buymeacoffee.com/robertpalmer/' ),
        esc_html__( 'Buy me a coffee', 'mbr-elementor-form-icons' )
    );
    return $links;
}, 10, 3 );

define( 'MBR_EFI_VERSION',         '1.5.1' );
define( 'MBR_EFI_PLUGIN_DIR',      plugin_dir_path( __FILE__ ) );
define( 'MBR_EFI_PLUGIN_URL',      plugin_dir_url( __FILE__ ) );
define( 'MBR_EFI_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/*
 * Self-hosted updates via Plugin Update Checker (PUC 5.7).
 * Manifest lives on GitHub raw to avoid host cache-header issues.
 */
if ( ! function_exists( 'mbr_efi_init_update_checker' ) ) {
	function mbr_efi_init_update_checker() {
		require_once MBR_EFI_PLUGIN_DIR . 'plugin-update-checker/plugin-update-checker.php';

		\YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
			'https://raw.githubusercontent.com/HarbourBob/mbr-updates/main/mbr-elementor-form-icons.json',
			__FILE__,
			'mbr-elementor-form-icons'
		);
	}
	mbr_efi_init_update_checker();
}

class MBR_Elementor_Form_Icons {

    private static $instance = null;

    public static function get_instance() {
        if ( null === self::$instance ) self::$instance = new self();
        return self::$instance;
    }

    private function __construct() {
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    public function init() {
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'notice_no_elementor' ] );
            return;
        }
        if ( ! function_exists( 'elementor_pro_load_plugin' ) ) {
            add_action( 'admin_notices', [ $this, 'notice_no_elementor_pro' ] );
            return;
        }

        // Classic form widget support.
        require_once MBR_EFI_PLUGIN_DIR . 'includes/class-form-field-controls.php';

        add_action( 'elementor/init', [ $this, 'init_components' ] );
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_assets' ] );
        add_action( 'elementor/editor/after_enqueue_scripts',  [ $this, 'enqueue_editor_assets' ] );

        // Atomic form input support (Elementor 4.0+).
        $this->maybe_init_atomic();
    }

    /* ------------------------------------------------------------------
     * Atomic widgets – replace the stock Input with our icon-aware version
     * ----------------------------------------------------------------*/

    private function maybe_init_atomic() {
        if ( ! defined( 'ELEMENTOR_VERSION' ) || version_compare( ELEMENTOR_VERSION, '4.0', '<' ) ) {
            return;
        }

        add_filter( 'elementor/widgets/register', [ $this, 'replace_atomic_input' ], 999 );
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_atomic_styles' ] );
    }

    /**
     * If the stock atomic Input is registered, unregister it and register ours.
     *
     * Runs at priority 999 on elementor/widgets/register — well after
     * Elementor Pro's atomic form module registers the stock Input at
     * the default priority.
     */
    public function replace_atomic_input( $widgets_manager ) {
        if ( ! class_exists( 'ElementorPro\\Modules\\AtomicForm\\Input\\Input' ) ) {
            return $widgets_manager;
        }

        $registered = $widgets_manager->get_widget_types();
        if ( ! isset( $registered['e-form-input'] ) ) {
            return $widgets_manager;
        }

        try {
            require_once MBR_EFI_PLUGIN_DIR . 'includes/class-atomic-input-icon.php';

            $widgets_manager->unregister( 'e-form-input' );
            $widgets_manager->register( new \MBR\ElementorFormIcons\Atomic\Atomic_Input_Icon() );
        } catch ( \Throwable $e ) {
            // Silently fall back to the stock Input widget.
        }

        return $widgets_manager;
    }

    public function enqueue_atomic_styles() {
        $this->enqueue_font_awesome();

        wp_enqueue_style(
            'mbr-efi-atomic-styles',
            MBR_EFI_PLUGIN_URL . 'assets/css/atomic-form-icons.css',
            [],
            MBR_EFI_VERSION
        );
    }

    /* ------------------------------------------------------------------
     * Classic form widget support
     * ----------------------------------------------------------------*/

    public function init_components() {
        MBR_EFI_Form_Field_Controls::get_instance();
    }

    private static function sanitize_color( string $color ): string {
        $color = trim( $color );
        if ( '' === $color ) return '';
        if ( sanitize_hex_color( $color ) ) return $color;
        if ( preg_match( '/^var\(--[a-zA-Z0-9_-]+\)$/' , $color ) ) return $color;
        return '';
    }

    private function get_current_post_id() {
        if ( isset( $_GET['post_id'] ) && intval( $_GET['post_id'] ) ) {
            return intval( $_GET['post_id'] );
        }
        $id = get_queried_object_id();
        if ( $id ) return $id;
        return get_the_ID();
    }

    private function collect_form_icons( array $elements, array &$data ) {
        foreach ( $elements as $element ) {
            if ( ! is_array( $element ) ) continue;
            if ( ( $element['widgetType'] ?? '' ) === 'form' ) {
                $widget_id   = $element['id'] ?? '';
                $widget_data = [];
                foreach ( $element['settings']['form_fields'] ?? [] as $field ) {
                    if ( ( $field['mbr_enable_icon'] ?? '' ) !== 'yes' ) continue;
                    $icon_value = $field['mbr_selected_icon']['value'] ?? '';
                    if ( ! $icon_value ) continue;
                    $widget_data[ $field['custom_id'] ] = [
                        'icon'     => sanitize_text_field( $icon_value ),
                        'position' => sanitize_text_field( $field['mbr_icon_position'] ?? 'above' ),
                        'color'    => ( self::sanitize_color( $field['mbr_icon_color'] ?? '' ) ?: '#333333' ),
                        'size'     => intval( $field['mbr_icon_size']['size'] ?? 16 ),
                        'type'     => sanitize_text_field( $field['field_type'] ?? '' ),
                    ];
                }
                if ( $widget_id && ! empty( $widget_data ) ) {
                    $data[ $widget_id ] = $widget_data;
                }
            }
            if ( ! empty( $element['elements'] ) && is_array( $element['elements'] ) ) {
                $this->collect_form_icons( $element['elements'], $data );
            }
        }
    }

    private function localize_icon_data() {
        $post_id = $this->get_current_post_id();
        if ( ! $post_id ) return;

        $elementor = \Elementor\Plugin::instance();
        if ( ! $elementor || ! isset( $elementor->documents ) ) return;

        $document = $elementor->documents->get( $post_id );
        if ( ! $document ) return;

        $elements = $document->get_elements_data();
        if ( empty( $elements ) || ! is_array( $elements ) ) return;

        $data = [];
        $this->collect_form_icons( $elements, $data );

        if ( ! empty( $data ) ) {
            wp_localize_script( 'mbr-efi-scripts', 'mbrEfiData', $data );
        }
    }

    /**
     * Enqueue Font Awesome from Elementor's own bundled copy.
     */
    private function enqueue_font_awesome() {
        $existing_handles = [
            'font-awesome-6-all', 'font-awesome-5-all',
            'font-awesome-6-solid', 'font-awesome-5-solid',
            'font-awesome', 'fontawesome',
        ];
        foreach ( $existing_handles as $handle ) {
            if ( wp_style_is( $handle, 'enqueued' ) || wp_style_is( $handle, 'done' ) ) {
                return;
            }
        }

        $fa_url  = ELEMENTOR_URL . 'assets/lib/font-awesome/css/all.min.css';
        $fa_path = ELEMENTOR_PATH . 'assets/lib/font-awesome/css/all.min.css';

        if ( file_exists( $fa_path ) ) {
            wp_enqueue_style( 'mbr-efi-fontawesome', $fa_url, [], ELEMENTOR_VERSION );
        } else {
            wp_enqueue_style(
                'mbr-efi-fontawesome',
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
                [],
                '6.5.1'
            );
        }
    }

    public function enqueue_frontend_assets() {
        $this->enqueue_font_awesome();

        wp_enqueue_style(
            'mbr-efi-styles',
            MBR_EFI_PLUGIN_URL . 'assets/css/form-icons.css',
            [],
            MBR_EFI_VERSION
        );

        wp_enqueue_script(
            'mbr-efi-scripts',
            MBR_EFI_PLUGIN_URL . 'assets/js/form-icons.js',
            [ 'jquery', 'elementor-frontend' ],
            MBR_EFI_VERSION,
            true
        );

        $this->localize_icon_data();
    }

    public function enqueue_editor_assets() {
        wp_enqueue_style(
            'mbr-efi-editor-styles',
            MBR_EFI_PLUGIN_URL . 'assets/css/editor.css',
            [],
            MBR_EFI_VERSION
        );
        wp_enqueue_script(
            'mbr-efi-editor-scripts',
            MBR_EFI_PLUGIN_URL . 'assets/js/editor.js',
            [ 'jquery', 'elementor-editor' ],
            MBR_EFI_VERSION,
            true
        );
    }

    public function notice_no_elementor() {
        printf( '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
            wp_kses_post( sprintf( __( '"%1$s" requires "%2$s" to be installed and activated.', 'mbr-elementor-form-icons' ),
                '<strong>MBR Elementor Form Icons</strong>', '<strong>Elementor</strong>' ) ) );
    }

    public function notice_no_elementor_pro() {
        printf( '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
            wp_kses_post( sprintf( __( '"%1$s" requires "%2$s" to be installed and activated.', 'mbr-elementor-form-icons' ),
                '<strong>MBR Elementor Form Icons</strong>', '<strong>Elementor Pro</strong>' ) ) );
    }
}

MBR_Elementor_Form_Icons::get_instance();
