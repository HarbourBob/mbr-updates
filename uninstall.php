<?php
/**
 * Uninstall MBR Elementor Form Icons
 * 
 * Fired when the plugin is uninstalled.
 */

// Exit if accessed directly or not uninstalling
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Clean up any plugin options if we add them in future
// Currently this plugin doesn't store any options in the database

// Optional: Clean up any transients if we add them
// delete_transient('mbr_efi_transient_name');

// The plugin doesn't modify any Elementor data directly,
// so no cleanup of Elementor post meta is needed
