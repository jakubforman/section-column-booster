<?php

namespace jayjay666\SectionColumnBooster\Extend\Elements;


use Elementor\Controls_Manager;
use Elementor\Element_Column;
use jayjay666\SectionColumnBooster\SectionColumnBooster;

/**
 * Class Column
 *
 * Extending existing columns in elementor
 *
 * @package SectionColumnBooster\Extend\Elements
 */
class Column
{
    /**
     * Add new column controls
     *
     * @param Element_Column $element
     */
    public static function addColumnControls(Element_Column $element)
    {
        //
        // Přidám responzivní ovladač pro order
        $element->add_responsive_control(
            '_scb_column_order',
            [
                // 'devices' => [], // Přidá další
                'label' => __('Column Order', SectionColumnBooster::DOMAIN),
                'separator' => 'before',
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}}.elementor-column' => '-webkit-box-ordinal-group: calc({{VALUE}} + 1 ); -ms-flex-order:{{VALUE}}; order: {{VALUE}};',
                ],
                'description' => sprintf(
                    __('Column ordering is a great addition for responsive design. You can learn more about CSS order property from %sMDN%s or %sw3schools%s.', SectionColumnBooster::DOMAIN),
                    '<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Flexible_Box_Layout/Ordering_Flex_Items#The_order_property" target="_blank">',
                    '</a>',
                    '<a href="https://www.w3schools.com/cssref/css3_pr_order.asp" target="_blank">',
                    '</a>'
                ),
            ]
        );

        //
        // Přidám responzivní ovladač pro šířku
        $element->add_responsive_control(
            '_scb_column_width',
            [
                'label' => __('Custom Column Width', SectionColumnBooster::DOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'description' => __('E.g 250px, 50%, calc(100% - 250px)', SectionColumnBooster::DOMAIN),
                'selectors' => [ // Zde se předají data do CSS
                    '{{WRAPPER}}.elementor-column' => 'width: {{VALUE}};',
                ],
            ]
        );

        /* TODO: dodělat ovládací prvky
        // Přidává možnost aplikovat margin na sloupec jako takový
        $element->add_responsive_control(
            'spicy_image_border_radius',
            [
                'label' => __('Border Radius', SectionColumnBooster::DOMAIN),
                'type' => 'scp-multi-unit-control',
                'size_units' => ['px', '%', 'text'],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{TOP_UNIT}} {{RIGHT}}{{RIGHT_UNIT}} {{BOTTOM}}{{BOTTOM_UNIT}} {{LEFT}}{{LEFT_UNIT}};',
                ],
            ]
        );*/
    }
}