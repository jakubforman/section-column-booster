<?php

/**
 * Plugin Name: Section Column Booster
 * Plugin URI: https://jakubforman.eu/personal-projects/section-column-booster/
 * Description: An extension plugin used in sections & columns for Elementor. It's enabling custom width in columns & horizontal align columns in a section.
 * Version: 1.2
 * Author: Jakub Josef Forman
 * Author URI: http://jakubforman.eu
 * Domain Path: /languages/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: section-column-booster
 * Domain Path: /languages/
 */

use jayjay666\SectionColumnBooster\SectionColumnBooster;

defined( 'ABSPATH' ) || exit;

// Import všech potřebných knihoven
if ( is_readable( __DIR__ . '/lib/autoload.php' ) ) {
	require __DIR__ . '/lib/autoload.php';
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

