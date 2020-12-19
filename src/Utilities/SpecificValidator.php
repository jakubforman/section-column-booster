<?php

namespace SectionColumnBooster\Utilities;

/**
 * Class SpecificValidator
 *
 * Validation plugin specification, versions and other plugins is instaled
 *
 * @package ElementorColumnOrder\Utilities
 */
class SpecificValidator
{
    /**
     * Plugin Version
     *
     * @var string The plugin version.
     * @since 1.0.0
     */
    private $VERSION;

    /**
     * Minimum Elementor Version
     *
     * @var string Minimum Elementor version required to run the plugin.
     * @since 1.0.0
     */
    private $MINIMUM_ELEMENTOR_VERSION;

    /**
     * Minimum PHP Version
     *
     * @var string Minimum PHP version required to run the plugin.
     * @since 1.0.0
     */
    private $MINIMUM_PHP_VERSION;

    /**
     * @var string Unique identifier for retrieving translated strings
     */
    private $DOMAIN;

    public function __construct($domain, $version, $min_elementor_version, $min_php_version)
    {
        $this->VERSION = $version;
        $this->MINIMUM_ELEMENTOR_VERSION = $min_elementor_version;
        $this->MINIMUM_PHP_VERSION = $min_php_version;
        $this->DOMAIN = $domain;
    }

    /**
     * Initialize the plugin
     *
     * Load the plugin only after Elementor (and other plugins) are loaded.
     * Checks for basic plugin requirements, if one check fail don't continue,
     * if all check have passed return true.
     *
     * @access public
     * @return bool
     * @since 1.0.0
     */
    public function init()
    {

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return false;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, $this->MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return false;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, $this->MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return false;
        }

        return true;
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @access public
     * @since 1.0.0
     */
    public function admin_notice_missing_main_plugin()
    {

        $this->unsetGetActivate();

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'elementor-column-order'),
            '<strong>' . esc_html__('Elementor Column Order', 'elementor-column-order') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-column-order') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @access public
     * @since 1.0.0
     */
    public function admin_notice_minimum_elementor_version()
    {
        $this->unsetGetActivate();

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-column-order'),
            '<strong>' . esc_html__('Elementor Column Order', 'elementor-column-order') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-column-order') . '</strong>',
            $this->MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @access public
     * @since 1.0.0
     */
    public function admin_notice_minimum_php_version()
    {
        $this->unsetGetActivate();

        $message = sprintf(
        /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-column-order'),
            '<strong>' . esc_html__('Elementor Column Order', 'elementor-column-order') . '</strong>',
            '<strong>' . esc_html__('PHP', 'elementor-column-order') . '</strong>',
            $this->MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Unset Activate
     *
     * Remove $_GET['activate]
     *
     * @access private
     * @since 1.0.0
     */
    private function unsetGetActivate()
    {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }
    }
}