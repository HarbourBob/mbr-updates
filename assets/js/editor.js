/**
 * MBR Elementor Form Icons - Editor Panel Script
 *
 * Runs in the editor panel (sidebar) context.
 *
 * Responsibilities:
 *  1. When any mbr_* setting changes on the form widget, trigger a full
 *     preview re-render so the PHP inject_icons() sees the new values.
 *  2. Hide the global colours switcher on the icon colour control.
 */

'use strict';

( function ( $, w ) {

    $( w ).on( 'elementor:init', function () {

        /* ------------------------------------------------------------------
         * Listen for setting changes on form widgets and force a re-render.
         *
         * Elementor's PHP-rendered widgets don't auto-refresh when repeater
         * sub-fields change. We hook into the editor channel to detect when
         * any mbr_* field has changed and call elementor.reloadPreview()
         * (or the lighter per-widget re-render if available).
         * ------------------------------------------------------------------ */
        elementor.channels.editor.on( 'change', function ( model ) {

            // model.changed is an object of what just changed
            var changed = model.changed || {};

            // Check if form_fields repeater changed (our controls live inside it)
            if ( ! changed.hasOwnProperty( 'form_fields' ) ) {
                return;
            }

            // Check if the widget is a form widget
            var container = elementor.channels.editor.request( 'editor:current:container' );
            if ( ! container ) return;

            var widgetType = container.model.get( 'widgetType' );
            if ( 'form' !== widgetType ) return;

            // Debounce to avoid rapid-fire reloads while typing
            clearTimeout( w._mbrEfiReloadTimeout );
            w._mbrEfiReloadTimeout = setTimeout( function () {
                // Use the targeted widget re-render if available (Elementor 3.x)
                if ( typeof elementor.reloadPreview === 'function' ) {
                    elementor.reloadPreview();
                }
            }, 500 );
        } );

        /* ------------------------------------------------------------------
         * Hide the global colour switcher on mbr_icon_color.
         * ------------------------------------------------------------------ */
        function hideGlobalColorSwitcher() {
            $( '.elementor-control-mbr_icon_color .elementor-control-dynamic-switcher' ).remove();
        }

        elementor.hooks.addAction( 'panel/open_editor/widget', function () {
            setTimeout( hideGlobalColorSwitcher, 150 );
            setTimeout( hideGlobalColorSwitcher, 600 );
        } );

        setTimeout( function () {
            var panel = document.querySelector( '#elementor-panel-content-wrapper' );
            if ( ! panel ) return;
            new MutationObserver( hideGlobalColorSwitcher )
                .observe( panel, { childList: true, subtree: true } );
        }, 1000 );

    } );

} ( jQuery, window ) );
