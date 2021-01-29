<?php


namespace jayjay666\SectionColumnBooster\includes;


use jayjay666\SectionColumnBooster\SectionColumnBooster;

/**
 * Class i18n
 *
 * Loading language taxdomains
 *
 * @package jayjay666\SectionColumnBooster\includes
 */
class i18n
{
    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.1
     */
    public function LoadPluginTextdomain()
    {
        load_plugin_textdomain(
            SectionColumnBooster::DOMAIN,
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );

    }
}