<?php
/*
Plugin Name: Post Editor Insert link with class
Plugin URI: 
Description: The plugin adds a class option to the insert link popup box.
Version: 1.0
License: GPLv2
License URI: http://www.opensource.org/licenses/GPL-2.0
*/ 
add_action( 'admin_print_scripts-post.php',     'peilwc_wplinks' );
add_action( 'admin_print_scripts-post-new.php', 'peilwc_wplinks' );
/**
 * enqueue script
 */
function peilwc_wplinks( $hook ) {
	wp_deregister_script('wplink');
  //   register is important, that other plugins will change or deactivate this
    wp_register_script(
        'peilwc-wplinks', 
        plugins_url( '/insert-link-class/inc/wp-link-modified.js'),
        array( 'jquery' ),
        '',
        TRUE
    );
    wp_enqueue_script( 'peilwc-wplinks' );
}

	

 /* Plugin Acivation Hook
     * 
     */

    function hook_activate() {

        if (!current_user_can('activate_plugins'))
            return;
        $plugin = isset($_REQUEST['plugin']) ? $_REQUEST['plugin'] : '';
        check_admin_referer("activate-plugin_{$plugin}");
    }

    /* Plugin Deactivation Hook
     * 
     */

    function hook_deactivate() {

        if (!current_user_can('activate_plugins'))
            return;
        $plugin = isset($_REQUEST['plugin']) ? $_REQUEST['plugin'] : '';
        check_admin_referer("deactivate-plugin_{$plugin}");
    }



?>