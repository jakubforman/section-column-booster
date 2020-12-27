<?php

namespace jayjay666\SectionColumnBooster;

use Elementor\Controls_Manager;
use Elementor\Element_Section;
use jayjay666\SectionColumnBooster\Controls\MultiUnit;
use jayjay666\SectionColumnBooster\Extend\Elements\Column;
use jayjay666\WPRequirementsChecker\Validator;

// use jayjay666\SectionColumnBooster\Utilities\PluginValidator;

/**
 * Class SectionColumnBooster
 *
 * Main booster class
 *
 * @package SectionColumnBooster\Extend
 */
class SectionColumnBooster
{
    /**
     * Plugin Version
     *
     * @var string The plugin version.
     * @since 1.0.0
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     *
     * @var string Minimum Elementor version required to run the plugin.
     * @since 1.0.0
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
     * Minimum PHP Version
     *
     * @var string Minimum PHP version required to run the plugin.
     * @since 1.0.0
     */
    const MINIMUM_PHP_VERSION = '7.1';

    /**
     * Define localised domain
     */
    const DOMAIN = 'elementor-column-order';

    /**
     * Instance
     *
     * @access private
     * @static
     * @var SectionColumnBooster The single instance of the class.
     * @since 1.0.0
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @access public
     * @static
     * @return SectionColumnBooster An instance of the class.
     * @since 1.0.0
     *
     */
    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * @access public
     * @since 1.0.0
     */
    public function __construct()
    {

        add_action('init', [$this, 'i18n']);

        add_action('plugins_loaded', [$this, 'init']);
    }


    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     * @access public
     * @since 1.0.0
     */
    public function i18n()
    {
        load_plugin_textdomain(self::DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    /**
     * Init Controls
     *
     * Include controls files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init_controls()
    {
        // Register control
        \Elementor\Plugin::$instance->controls_manager->register_control('scp-multi-unit-control', new MultiUnit());
    }

    /**
     * Initialize the plugin
     *
     * Load the plugin only after Elementor (and other plugins) are loaded.
     * Checks for basic plugin requirements, if one check fail don't continue,
     * if all check have passed load the files required to run the plugin.
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @access public
     * @since 1.0.0
     */
    public function init()
    {
        // Check requirements
        $validator = new Validator('7.1', 'section-column-booster/section-column-booster.php', self::DOMAIN);
        // $validator = new PluginValidator('7.1', 'section-column-booster/section-column-booster.php',self::DOMAIN);
        $validator->addRequiredPlugin('elementor/elementor.php', '3.0');
        if (!$validator->check()) {
            return;
        }

        // přidá vlastní ovládací prvky
        // TODO: dodělat ovládací prvky
        // add_action('elementor/controls/controls_registered', [$this, 'init_controls']);


        // Přidám prvky do třídy sloupce
        (new Column())->init();

        // přidá rozšířené možnosti sekcí
        add_action('elementor/element/section/section_layout/before_section_end', [__CLASS__, 'add_section_controls']);
    }

    /**
     * Přidává ovládací prvky do sekcí
     *
     * @param Element_Section $element
     */
    public static function add_section_controls(Element_Section $element)
    {
        //
        // Přidám responzivní pro zarovnání slopců
        $element->add_responsive_control(
            'scb_section_horizontal_align',
            [
                'label' => __('Horizontal align', self::DOMAIN),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('Default', 'elementor'),
                    'flex-start' => __('Start', 'elementor'),
                    'flex-end' => __('End', 'elementor'),
                    'center' => __('Center', 'elementor'),
                    'space-between' => __('Space Between', 'elementor'),
                    'space-around' => __('Space Around', 'elementor'),
                    'space-evenly' => __('Space Evenly', 'elementor'),
                ],
                'selectors' => [ // Zde se předají data do CSS
                    '{{WRAPPER}} .elementor-row' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
    }


}