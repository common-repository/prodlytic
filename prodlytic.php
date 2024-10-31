<?php
/**
 * Plugin Name: Prodlytic
 * Plugin URI: https://prodlytic.com/
 * Description: Seamlessly connect Prodlytic, the analytics tool that automatically records every user interaction from day one, and start understanding what people do on your website straight away.
 * Version: 1.0.4
 * Author: D4 Software
 * Author URI: http://weared4.com/
 * License: GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 */

//Add content to the head
add_action( 'wp_footer', 'prodlytic_collector_snippet' );
function prodlytic_collector_snippet() {
  
  if (strlen(get_option('PRODLYTIC_PID')) == 16 && get_option('PRODLYTIC_PID') != null) {
    ?>
  <script src="https://collector.prodlytic.com/collector.js" charset="utf-8" data-pid="<?php echo(get_option('PRODLYTIC_PID'))?>"></script>
    <?php
  }
	
	function mytheme_enqueue_typekit() {
	   wp_enqueue_script( 'mytheme-typekit', 'https://use.typekit.net/.js', array(), '1.0' );
	   wp_add_inline_script( 'mytheme-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
	 }

}

//Settings page
add_action('admin_menu', 'prodlytic_plugin_menu');

function prodlytic_plugin_menu() {
	add_menu_page('Prodlytic Settings', 'Prodlytic', 'administrator', 'prodlytic-settings', 'prodlytic_plugin_settings_page', 'dashicons-chart-line');
}

function prodlytic_plugin_settings_page() {
  include 'admin-config-panel.php';
}


add_action( 'admin_init', 'prodlytic_plugin_settings' );

function prodlytic_plugin_settings() {
  //PID key as referenced in the settings page
	register_setting( 'prodlytic_plugin-settings-group', 'PRODLYTIC_PID' );
}


function prodlytic_admin_notice__no_pid() {
  ?>
  <div class="notice notice-error is-dismissible">
      <p><?php _e( 'Prodlytic will not work without a product ID. Please supply one to enable user tracking.', 'sample-text-domain' ); ?></p>
  </div>
  <?php
}

function prodlytic_admin_notice__invalid_pid() {
  ?>
  <div class="notice notice-warning is-dismissible">
      <p><?php _e( 'That product id does not look valid. Prodlytic will not work without a valid product ID. Please supply one to enable user tracking.', 'sample-text-domain' ); ?></p>
  </div>
  <?php
}


if (get_option('PRODLYTIC_PID') == null) {
  add_action( 'admin_notices', 'prodlytic_admin_notice__no_pid' );
}

if (strlen(get_option('PRODLYTIC_PID')) != 16 && get_option('PRODLYTIC_PID') != null) {
  add_action( 'admin_notices', 'prodlytic_admin_notice__invalid_pid' );
}
