<?php

namespace jayjay666\SectionColumnBooster\Extend\Elements;


use Elementor\Controls_Manager;
use Elementor\Element_Column;
use Elementor\Element_Section;
use jayjay666\SectionColumnBooster\SectionColumnBooster;

/**
 * Class Section
 *
 * Extending existing sections in elementor
 *
 * @package SectionColumnBooster\Extend\Elements
 */
class Section
{
    /**
     * Přidává ovládací prvky do sekcí
     *
     * @param Element_Section $element
     */
    public static function addSectionControls(Element_Section $element)
    {
        //
        // Přidám responzivní pro zarovnání slopců
        $element->add_responsive_control(
            'scb_section_horizontal_align',
            [
                'label' => __('Horizontal align', SectionColumnBooster::DOMAIN),
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