<?php

/**
 * Plugin Name: Section Column Booster
 * Plugin URI: https://github.com/jayjay666/section-column-booster
 * Description: A extension plugin used in sections & columns for Elementor. Enable custome width in columns & enable horizontal align columns in section
 * Version: 1.0
 * Author: jayjay666
 * Author URI: http://jakubforman.eu
 * Domain Path: /languages/
 * License: GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
//
// Kontrola
defined('ABSPATH') || exit;

//
// Pro composer, import composer dependencies
if (is_readable(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

use SectionColumnBooster\Extend\SectionColumnBooster;


// Instance hlavní třídy
SectionColumnBooster::instance();