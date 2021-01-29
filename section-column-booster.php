<?php

/**
 * Plugin Name: Section Column Booster
 * Plugin URI: https://github.com/jayjay666/section-column-booster
 * Description: An extension plugin used in sections & columns for Elementor. It's enabling custom width in columns & horizontal align columns in a section.
 * Version: 1.0
 * Author: jayjay666
 * Author URI: http://jakubforman.eu
 * Domain Path: /languages/
 * License: GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
use jayjay666\SectionColumnBooster\SectionColumnBooster;

//
// Kontrola
defined('ABSPATH') || exit;

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_plugin_name() {
    // require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-activator.php';
    // Plugin_Name_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_plugin_name() {
    // require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-deactivator.php';
    // Plugin_Name_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_name' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );


//
// Pro composer, import composer dependencies
if (is_readable(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function runSectionColumnBooster() {

    $plugin = new SectionColumnBooster();
    $plugin->run();

}
runSectionColumnBooster();

