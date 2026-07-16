# Changelog

All notable changes to MBR Elementor Form Icons are documented here.

## [1.5.1] – 2026-07-16

### Added
- Self-hosted update support via Plugin Update Checker 5.7, checking the GitHub-hosted manifest (`HarbourBob/mbr-updates`).

## [1.5.0] – 2026-04-10

### Added
- **Atomic Form > Input support (Elementor 4.0.1+):** extends the stock atomic Input widget with a Font Awesome icon positioned inside the input placeholder area.
- Content panel "Icon" section with Enable Icon toggle and 20-icon dropdown selector.
- Style panel "Icon" section with auto-generated Size and Color controls.
- Custom Twig template that wraps the input in a container with an absolutely-positioned `<i>` element.
- Dedicated `atomic-form-icons.css` stylesheet for atomic icon layout.
- Robust widget replacement via `elementor/widgets/register` at priority 999 with class-existence detection (no fragile experiment-name checks).

### Unchanged
- Classic Form widget support fully retained from 1.4.0.
- Font Awesome loading strategy (Elementor bundled copy with CDN fallback).

## [1.4.0] – 2026-03-05

### Changed
- Icons now always visible (removed hide-on-focus behaviour).
- Improved editor preview fallback matching for fields without group-ID classes.
