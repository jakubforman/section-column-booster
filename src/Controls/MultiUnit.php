<?php

namespace jayjay666\SectionColumnBooster\Controls;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * scp multiunit dimension control
 * A base control for creating multiunit dimension control. Displays input fields with seprate unit for top,
 * right, bottom, left and the option to link them together.
 *
 * @since 1.0.0
 */
class MultiUnit extends \Elementor\Control_Base_Multiple
{

    /**
     * Get multiunit dimensions control type.
     *
     * Retrieve the control type, in this case `dimensions`.
     */
    public function get_type()
    {
        return 'scp-multi-unit-control';
    }

    /**
     * Get dimensions control default values.
     */
    public function get_default_value()
    {
        return [
            'top' => '',
            'right' => '',
            'bottom' => '',
            'left' => '',
            'top_unit' => 'px',
            'right_unit' => 'px',
            'left_unit' => 'px',
            'bottom_unit' => 'px',
            'isLinked' => true,
        ];
    }

    /**
     * Get dimensions control default settings.
     */
    protected function get_default_settings()
    {
        return [
            'size_units' => ['px'],
            'label_block' => true,
            'range' => [
                'px' => [
                    'min' => '',
                    'max' => 100,
                    'step' => 1,
                    'type' => 'number'
                ],
                'em' => [
                    'min' => 0.1,
                    'max' => 10,
                    'step' => 0.1,
                    'type' => 'number'
                ],
                'rem' => [
                    'min' => 0.1,
                    'max' => 10,
                    'step' => 0.1,
                    'type' => 'number'
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'type' => 'number'
                ],
                'deg' => [
                    'min' => 0,
                    'max' => 360,
                    'step' => 1,
                    'type' => 'number'
                ],
                'vh' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'type' => 'number'
                ],
                'vw' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'type' => 'number'
                ],
                'text' => [
                    'min' => 0,
                    'max' => 0,
                    'step' => 0,
                    'type' => 'text',
                ],
            ],
        ];
    }

    // add css and javascript files to control
    public function enqueue()
    {
        wp_enqueue_script('scp_multi_unit', plugins_url('/js/MultiUnit.js', __FILE__));
        wp_enqueue_style('scp_multi_unit', plugins_url('/css/MultiUnit.css', __FILE__));

    }

    // render gear and sublink 
    private function print_link_unit_template()
    {
        ?>
        <# if ( data.size_units && data.size_units.length > 1 ) { #>
        <button class="scp_linkAllUnit">
			 		<span class="scp_link_first">
					 <i class="fa fa-gear" aria-hidden="true"></i>
					 <i class="scp_link_tooltiptext">Sync Unit</i>
					</span>
            <div class="scp_tooltip">
                <# _.each( data.size_units, function( unit ) { #>
                <span class="scp_link">{{{unit}}}</span>
                <#});#>
            </div>
        </button>
        <#}#>
        <?php
    }

    // render units
    private function print_units_template($arg)
    {
        ?>
        <# if ( data.size_units && data.size_units.length > 1 ) { #>
        <div class="scp-units-choices">
            <# _.each( data.size_units, function( unit ) {
            if(unit=='px' && data.range.px.step < 1){
            data.range.px.step=1;
            }
            #>
            <input id="scp-choose-{{ data._cid + data.name + unit }}-<?php echo $arg ?>" type="radio"
                   class="{{data.name}}" name="scp-choose-{{data.name}}-<?php echo $arg ?>"
                   data-setting="<?php echo $arg ?>_unit" value="{{ unit }}"/>
            <label class="scp-units-choices-label-<?php echo $arg ?>" data-cat="<?php echo $arg ?>_{{ data._cid }}"
                   for="scp-choose-{{ data._cid + data.name + unit }}-<?php echo $arg ?>">{{{ unit }}}</label>
            <# } ); #>
        </div>
        <# } #>
        <?php
    }

    /**
     * Render dimensions control output in the editor.
     */
    public function content_template()
    {

        $dimensions = [
            'top' => __('Top', 'scp-extension'),
            'right' => __('Right', 'scp-extension'),
            'bottom' => __('Bottom', 'scp-extension'),
            'left' => __('Left', 'scp-extension'),
        ];
        ?>
        <div class="elementor-control-field">
            <label class="elementor-control-title">{{{ data.label }}}</label>
            <div class="scp-control-input-wrapper">
                <div class="units-wrapper">
                    <div>
                        <ul>
                            <?php
                            foreach ($dimensions as $dimension_key => $dimension_title) :
                                echo '<li>';
                                ?>
                                <# if ( -1 !== _.indexOf( allowed_dimensions, '<?php echo $dimension_key; ?>' ) ) { #>
                                <?php
                                $this->print_units_template($dimension_key);
                                ?>
                                <# } #>
                                <?php
                                echo '</li>';
                            endforeach;
                            ?>
                        </ul>
                    </div>
                </div>

                <div>
                    <ul class="scp-control-dimensions">
                        <?php
                        foreach ($dimensions as $dimension_key => $dimension_title) :
                            $control_uid = $this->get_control_uid($dimension_key);
                            ?>
                            <li class="scp-control-multiunit">
                                <#
                                var unit=data.controlValue[<?php echo "'" . $dimension_key . '_unit' . "'"; ?>];
                                #>
                                <input id="<?php echo $control_uid; ?>" type="{{data.range[unit].type}}"
                                       data-name="{{data.name}}-<?php echo esc_attr($dimension_key); ?>"
                                       min="{{ data.range[unit].min}}" max="{{ data.range[unit].max}}"
                                       step="{{ data.range[unit].step}}"
                                       data-setting="<?php echo esc_attr($dimension_key); ?>"
                                       placeholder="<#
								if ( _.isObject( data.placeholder ) ) {
									if ( ! _.isUndefined( data.placeholder.<?php echo $dimension_key; ?> ) ) {
										print( data.placeholder.<?php echo $dimension_key; ?> );
									}
								} else {
									print( data.placeholder );
								} #>"

                                <# if ( -1 === _.indexOf( allowed_dimensions, '<?php echo $dimension_key; ?>' ) ) { #>
                                disabled
                                <# } #>
                                />
                                <label for="<?php echo esc_attr($control_uid); ?>"
                                       class="scp-control-multiunit-label"><?php echo $dimension_title; ?></label>
                            </li>
                        <?php endforeach; ?>
                        <li>
                            <div style="display: flex;">
                                <button class="scp-link-dimensions tooltip-target"
                                        data-tooltip="<?php echo esc_attr__('Link values together', 'scp'); ?>">
										<span id="spisy-{{data.name}}" class="scp-linked">
											<i class="fa fa-link" aria-hidden="true"></i>
										<span class="elementor-screen-only"><?php echo __('Link values together', 'scp'); ?></span>
										</span>
                                    <span id="spisy-{{data.name}}" class="scp-unlinked">
											<i class="fa fa-chain-broken" aria-hidden="true"></i>
										<span class="elementor-screen-only"><?php echo __('Unlinked values', 'scp'); ?></span>
										</span>
                                </button>
                                <?php
                                $this->print_link_unit_template();
                                ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <# if ( data.description ) { #>
        <div class="elementor-control-field-description">{{{ data.description }}}</div>
        <# } #>
        <?php
    }
}
