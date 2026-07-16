<?php
/**
 * MBR Atomic Input Icon Widget
 *
 * Extends the Elementor Pro atomic Form > Input widget to add
 * a Font Awesome icon inside the input (placeholder position).
 *
 * Icon appearance (Size, Color) is controlled via the auto-generated
 * Style panel section labelled "Icon".
 *
 * @since 1.5.0
 */

namespace MBR\ElementorFormIcons\Atomic;

use Elementor\Modules\AtomicWidgets\Controls\Section;
use Elementor\Modules\AtomicWidgets\Controls\Types\Select_Control;
use Elementor\Modules\AtomicWidgets\Controls\Types\Switch_Control;
use Elementor\Modules\AtomicWidgets\Controls\Types\Text_Control;
use Elementor\Modules\AtomicWidgets\PropTypes\Classes_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Attributes_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Primitives\Boolean_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Primitives\String_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Size_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Color_Prop_Type;
use Elementor\Modules\AtomicWidgets\Styles\Style_Definition;
use Elementor\Modules\AtomicWidgets\Styles\Style_Variant;
use Elementor\Modules\AtomicWidgets\Styles\Style_States;
use Elementor\Modules\Components\PropTypes\Overridable_Prop_Type;
use ElementorPro\Modules\AtomicForm\Input\Input;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Atomic_Input_Icon extends Input {

	/**
	 * Return the same element type so this is a transparent replacement.
	 */
	public static function get_element_type(): string {
		return 'e-form-input';
	}

	public function get_title(): string {
		return esc_html__( 'Input', 'mbr-elementor-form-icons' );
	}

	/* ------------------------------------------------------------------
	 * Props – parent props + icon fields
	 * ----------------------------------------------------------------*/

	protected static function define_props_schema(): array {
		return array_merge( parent::define_props_schema(), [
			'enable_icon' => Boolean_Prop_Type::make()
				->default( false ),
			'icon_class'  => String_Prop_Type::make()
				->default( 'fas fa-user' )
				->enum( [
					// People & identity
					'fas fa-user',
					'fas fa-user-circle',
					'fas fa-users',
					'fas fa-id-card',
					'fas fa-user-tie',
					'fas fa-user-shield',
					// Communication
					'fas fa-envelope',
					'fas fa-envelope-open',
					'fas fa-phone',
					'fas fa-phone-alt',
					'fas fa-comment',
					'fas fa-comments',
					'fas fa-paper-plane',
					'fas fa-inbox',
					// Security & auth
					'fas fa-lock',
					'fas fa-unlock',
					'fas fa-key',
					'fas fa-shield-alt',
					'fas fa-fingerprint',
					'fas fa-eye',
					'fas fa-eye-slash',
					// Location & navigation
					'fas fa-map-marker-alt',
					'fas fa-map-pin',
					'fas fa-globe',
					'fas fa-compass',
					'fas fa-home',
					'fas fa-building',
					'fas fa-city',
					'fas fa-directions',
					// Business & finance
					'fas fa-briefcase',
					'fas fa-credit-card',
					'fas fa-money-bill-wave',
					'fas fa-file-invoice-dollar',
					'fas fa-chart-line',
					'fas fa-store',
					'fas fa-shopping-cart',
					'fas fa-receipt',
					// Content & editing
					'fas fa-pen',
					'fas fa-pencil-alt',
					'fas fa-edit',
					'fas fa-file-alt',
					'fas fa-clipboard',
					'fas fa-align-left',
					// Date & time
					'fas fa-calendar',
					'fas fa-calendar-alt',
					'fas fa-clock',
					'fas fa-hourglass-half',
					// Media & web
					'fas fa-link',
					'fas fa-image',
					'fas fa-camera',
					'fas fa-video',
					'fas fa-microphone',
					// General UI
					'fas fa-search',
					'fas fa-tag',
					'fas fa-tags',
					'fas fa-hashtag',
					'fas fa-at',
					'fas fa-bell',
					'fas fa-bookmark',
					'fas fa-flag',
					'fas fa-heart',
					'fas fa-star',
					'fas fa-thumbs-up',
					'fas fa-info-circle',
					'fas fa-question-circle',
					'fas fa-exclamation-circle',
					'fas fa-check-circle',
					'fas fa-cog',
					// Misc
					'fas fa-bolt',
					'fas fa-gift',
					'fas fa-rocket',
					'fas fa-palette',
					'fas fa-graduation-cap',
					'fas fa-stethoscope',
					'fas fa-truck',
					'fas fa-wifi',
					'fas fa-cloud',
					'fas fa-code',
				] ),
		] );
	}

	/* ------------------------------------------------------------------
	 * Controls – parent controls + icon section
	 * ----------------------------------------------------------------*/

	protected function define_atomic_controls(): array {
		$parent = parent::define_atomic_controls();

		$icon_section = Section::make()
			->set_label( __( 'Icon', 'mbr-elementor-form-icons' ) )
			->set_items( [
				Switch_Control::bind_to( 'enable_icon' )
					->set_label( __( 'Enable Icon', 'mbr-elementor-form-icons' ) ),
				Select_Control::bind_to( 'icon_class' )
					->set_label( __( 'Choose Icon', 'mbr-elementor-form-icons' ) )
					->set_options( [
						// People & identity
						[ 'label' => '👤 User',              'value' => 'fas fa-user' ],
						[ 'label' => '👤 User Circle',       'value' => 'fas fa-user-circle' ],
						[ 'label' => '👥 Users',             'value' => 'fas fa-users' ],
						[ 'label' => '🪪 ID Card',           'value' => 'fas fa-id-card' ],
						[ 'label' => '👔 User Tie',          'value' => 'fas fa-user-tie' ],
						[ 'label' => '🛡️ User Shield',       'value' => 'fas fa-user-shield' ],
						// Communication
						[ 'label' => '✉️ Envelope',          'value' => 'fas fa-envelope' ],
						[ 'label' => '📬 Envelope Open',     'value' => 'fas fa-envelope-open' ],
						[ 'label' => '📞 Phone',             'value' => 'fas fa-phone' ],
						[ 'label' => '📱 Phone Alt',         'value' => 'fas fa-phone-alt' ],
						[ 'label' => '💬 Comment',           'value' => 'fas fa-comment' ],
						[ 'label' => '💬 Comments',          'value' => 'fas fa-comments' ],
						[ 'label' => '📨 Paper Plane',       'value' => 'fas fa-paper-plane' ],
						[ 'label' => '📥 Inbox',             'value' => 'fas fa-inbox' ],
						// Security & auth
						[ 'label' => '🔒 Lock',              'value' => 'fas fa-lock' ],
						[ 'label' => '🔓 Unlock',            'value' => 'fas fa-unlock' ],
						[ 'label' => '🔑 Key',               'value' => 'fas fa-key' ],
						[ 'label' => '🛡️ Shield',            'value' => 'fas fa-shield-alt' ],
						[ 'label' => '🔏 Fingerprint',       'value' => 'fas fa-fingerprint' ],
						[ 'label' => '👁️ Eye',               'value' => 'fas fa-eye' ],
						[ 'label' => '🙈 Eye Slash',         'value' => 'fas fa-eye-slash' ],
						// Location & navigation
						[ 'label' => '📍 Map Marker',        'value' => 'fas fa-map-marker-alt' ],
						[ 'label' => '📌 Map Pin',           'value' => 'fas fa-map-pin' ],
						[ 'label' => '🌐 Globe',             'value' => 'fas fa-globe' ],
						[ 'label' => '🧭 Compass',           'value' => 'fas fa-compass' ],
						[ 'label' => '🏠 Home',              'value' => 'fas fa-home' ],
						[ 'label' => '🏢 Building',          'value' => 'fas fa-building' ],
						[ 'label' => '🏙️ City',              'value' => 'fas fa-city' ],
						[ 'label' => '🧭 Directions',        'value' => 'fas fa-directions' ],
						// Business & finance
						[ 'label' => '💼 Briefcase',         'value' => 'fas fa-briefcase' ],
						[ 'label' => '💳 Credit Card',       'value' => 'fas fa-credit-card' ],
						[ 'label' => '💵 Money',             'value' => 'fas fa-money-bill-wave' ],
						[ 'label' => '🧾 Invoice',           'value' => 'fas fa-file-invoice-dollar' ],
						[ 'label' => '📈 Chart',             'value' => 'fas fa-chart-line' ],
						[ 'label' => '🏪 Store',             'value' => 'fas fa-store' ],
						[ 'label' => '🛒 Shopping Cart',     'value' => 'fas fa-shopping-cart' ],
						[ 'label' => '🧾 Receipt',           'value' => 'fas fa-receipt' ],
						// Content & editing
						[ 'label' => '✏️ Pen',               'value' => 'fas fa-pen' ],
						[ 'label' => '✏️ Pencil',            'value' => 'fas fa-pencil-alt' ],
						[ 'label' => '📝 Edit',              'value' => 'fas fa-edit' ],
						[ 'label' => '📄 File',              'value' => 'fas fa-file-alt' ],
						[ 'label' => '📋 Clipboard',         'value' => 'fas fa-clipboard' ],
						[ 'label' => '📄 Align Left',        'value' => 'fas fa-align-left' ],
						// Date & time
						[ 'label' => '📅 Calendar',          'value' => 'fas fa-calendar' ],
						[ 'label' => '📅 Calendar Alt',      'value' => 'fas fa-calendar-alt' ],
						[ 'label' => '🕐 Clock',             'value' => 'fas fa-clock' ],
						[ 'label' => '⏳ Hourglass',         'value' => 'fas fa-hourglass-half' ],
						// Media & web
						[ 'label' => '🔗 Link',              'value' => 'fas fa-link' ],
						[ 'label' => '🖼️ Image',             'value' => 'fas fa-image' ],
						[ 'label' => '📷 Camera',            'value' => 'fas fa-camera' ],
						[ 'label' => '🎥 Video',             'value' => 'fas fa-video' ],
						[ 'label' => '🎤 Microphone',        'value' => 'fas fa-microphone' ],
						// General UI
						[ 'label' => '🔍 Search',            'value' => 'fas fa-search' ],
						[ 'label' => '🏷️ Tag',               'value' => 'fas fa-tag' ],
						[ 'label' => '🏷️ Tags',              'value' => 'fas fa-tags' ],
						[ 'label' => '#️⃣ Hashtag',           'value' => 'fas fa-hashtag' ],
						[ 'label' => '@ At',                 'value' => 'fas fa-at' ],
						[ 'label' => '🔔 Bell',              'value' => 'fas fa-bell' ],
						[ 'label' => '🔖 Bookmark',          'value' => 'fas fa-bookmark' ],
						[ 'label' => '🚩 Flag',              'value' => 'fas fa-flag' ],
						[ 'label' => '❤️ Heart',             'value' => 'fas fa-heart' ],
						[ 'label' => '⭐ Star',              'value' => 'fas fa-star' ],
						[ 'label' => '👍 Thumbs Up',         'value' => 'fas fa-thumbs-up' ],
						[ 'label' => 'ℹ️ Info',              'value' => 'fas fa-info-circle' ],
						[ 'label' => '❓ Question',          'value' => 'fas fa-question-circle' ],
						[ 'label' => '⚠️ Exclamation',       'value' => 'fas fa-exclamation-circle' ],
						[ 'label' => '✅ Check',             'value' => 'fas fa-check-circle' ],
						[ 'label' => '⚙️ Cog',               'value' => 'fas fa-cog' ],
						// Misc
						[ 'label' => '⚡ Bolt',              'value' => 'fas fa-bolt' ],
						[ 'label' => '🎁 Gift',              'value' => 'fas fa-gift' ],
						[ 'label' => '🚀 Rocket',            'value' => 'fas fa-rocket' ],
						[ 'label' => '🎨 Palette',           'value' => 'fas fa-palette' ],
						[ 'label' => '🎓 Graduation Cap',    'value' => 'fas fa-graduation-cap' ],
						[ 'label' => '🩺 Stethoscope',       'value' => 'fas fa-stethoscope' ],
						[ 'label' => '🚚 Truck',             'value' => 'fas fa-truck' ],
						[ 'label' => '📶 WiFi',              'value' => 'fas fa-wifi' ],
						[ 'label' => '☁️ Cloud',             'value' => 'fas fa-cloud' ],
						[ 'label' => '💻 Code',              'value' => 'fas fa-code' ],
					] ),
			] );

		// Insert the icon section after the first (Content) section.
		array_splice( $parent, 1, 0, [ $icon_section ] );

		return $parent;
	}

	/* ------------------------------------------------------------------
	 * Base styles – parent styles + Icon style definition
	 *
	 * The key 'icon' creates an "Icon" section in the Style panel.
	 * Elementor auto-generates Size and Color controls from the
	 * font-size and color props declared here.
	 * ----------------------------------------------------------------*/

	protected function define_base_styles(): array {
		$parent = parent::define_base_styles();

		$parent['icon'] = Style_Definition::make()
			->add_variant(
				Style_Variant::make()
					->add_props( [
						'color'     => Color_Prop_Type::generate( '#9DA5AE' ),
						'font-size' => Size_Prop_Type::generate( [
							'size' => 14,
							'unit' => 'px',
						] ),
					] ),
			);

		return $parent;
	}

	/* ------------------------------------------------------------------
	 * Template – override to use our icon-aware template
	 * ----------------------------------------------------------------*/

	protected function get_templates(): array {
		return [
			'input' => MBR_EFI_PLUGIN_DIR . 'includes/templates/input.html.twig',
		];
	}
}
