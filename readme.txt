=== MBR Elementor Form Icons ===
Contributors: robertpalmer
Tags: elementor, form, icons, font awesome, atomic
Requires at least: 5.8
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.5.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add Font Awesome icons to Elementor Pro form fields — supports both the classic Form widget and the new atomic Form > Input element (Elementor 4.0+).

== Description ==

MBR Elementor Form Icons lets you add Font Awesome icons to your Elementor Pro forms with zero code.

**Dual-mode support:**

* **Classic Form widget** — per-field icon controls in the repeater (above field or in placeholder).
* **Atomic Form > Input element (Elementor 4.0.1+)** — icon sits inside the input placeholder area. Size and Color are controlled via the auto-generated Style panel under "Icon".

The plugin automatically detects which architecture is active and loads the correct mode. Both can run side-by-side on the same site.

**Icon selection** — 20 popular Font Awesome icons are available from a dropdown in the Content panel: user, envelope, phone, lock, search, home, globe, building, calendar, comment, credit card, map marker, tag, pen, briefcase, heart, star, bell, link, and hashtag.

**Free, no upsells, no premium tier.**

== Installation ==

1. Upload the `mbr-elementor-form-icons` folder to `/wp-content/plugins/`.
2. Activate via the Plugins screen.
3. **Classic forms:** edit any Form widget, expand a field's Content tab, and toggle "Enable Icon".
4. **Atomic inputs:** drag a Form > Input element, open its Content panel, toggle "Enable Icon" and choose an icon. Adjust Size and Color in the Style panel under "Icon".

== Changelog ==

= 1.5.1 =
* Self-hosted updates via Plugin Update Checker 5.7 (GitHub-hosted manifest).

= 1.5.0 =
* NEW: Atomic Form > Input element support (Elementor 4.0.1+).
* Icon renders inside the input placeholder area via custom Twig template.
* Style panel "Icon" section with Size and Color controls (auto-generated).
* Transparently replaces the stock atomic Input widget — no manual steps.
* Classic Form widget support retained and unchanged.

= 1.4.0 =
* Icons always visible (no hide-on-focus behaviour).
* Improved editor preview fallback matching.
