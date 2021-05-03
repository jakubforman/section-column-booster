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
 * @package jayjay666\SectionColumnBooster
 */
class SectionColumnBooster
{
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
        RequirementValidator::requirementsValidate();
        $this->i18n();
        $this->loadElementorExtends();
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