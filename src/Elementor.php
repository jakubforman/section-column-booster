<?php


namespace jayjay666\SectionColumnBooster;


use jayjay666\SectionColumnBooster\Controls\MultiUnit;
use jayjay666\SectionColumnBooster\Extend\Elements\Column;
use jayjay666\SectionColumnBooster\Extend\Elements\Section;
use jayjay666\SectionColumnBooster\includes\Loader;

class Elementor
{
    /**
     * Init Controls
     *
     * Include controls files and register them
     *
     * @since   1.0.0
     * @access  public
     */
    public function init_controls()
    {
        // Register control
        \Elementor\Plugin::$instance->controls_manager->register_control('scp-multi-unit-control', new MultiUnit());

        // přidá vlastní ovládací prvky
        // TODO: dodělat ovládací prvky
        // add_action('elementor/controls/controls_registered', [$this, 'init_controls']);
    }

    /**
     * Initialize elementor extends
     *
     * Load all elementor extends
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @access  public
     * @since   1.1
     */
    public function loadElementorExtends()
    {
        // přidá vlastní ovládací prvky
        // TODO: dodělat ovládací prvky
        // add_action('elementor/controls/controls_registered', [$this, 'init_controls']);


        // Přidám prvky do třídy sloupce
        Loader::addAction('elementor/element/column/layout/before_section_end', new Column(), 'addColumnControls');
        // přidá rozšířené možnosti sekcí
        Loader::addAction('elementor/element/section/section_layout/before_section_end', new Section(), 'addSectionControls');
    }
}