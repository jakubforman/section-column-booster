<?php

namespace jayjay666\SectionColumnBooster;

use jayjay666\SectionColumnBooster\includes\i18n;
use jayjay666\SectionColumnBooster\includes\RequirementValidator;
use jayjay666\SectionColumnBooster\includes\Loader;

/**
 * Class SectionColumnBooster
 *
 * Main booster class
 *
 * @package SectionColumnBooster
 */
class SectionColumnBooster
{
    /**
     * Plugin Version
     *
     * @var     string The plugin version.
     * @since   1.0.0
     */
    const VERSION = '1.0.0';

    /**
     * Define localised domain
     */
    const DOMAIN = 'elementor-column-order';

    /**
     * Constructor
     *
     * Loadiging default needs files, class and others
     *
     * @access  public
     * @since   1.0.0
     */
    public function __construct()
    {
        $this->loadDependencies();
        RequirementValidator::requirementsValidate();
        $this->i18n();
        $this->loadElementorExtends();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Plugin_Name_Loader. Orchestrates the hooks of the plugin.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.1
     * @access   private
     */
    private function loadDependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         * Zde použít require pokud by bylo třeba, ukázka je zakomentovaná
         */
        // require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/Loader.php';
    }


    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * @access  public
     * @since   1.0.0
     */
    public function i18n()
    {
        $plugin_i18n = new i18n();
        Loader::addAction('plugins_loaded', $plugin_i18n, 'LoadPluginTextdomain');
    }

    /**
     * Initialize elementor extends
     *
     * Load all elementor extends
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @access  public
     * @since   1.0.0
     */
    public function loadElementorExtends()
    {
        $elementor = new Elementor();
        $elementor->loadElementorExtends();
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        Loader::run();
    }
}