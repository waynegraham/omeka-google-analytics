<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * GoogleAnalytics plugin for Omeka adds support for Google analytics to Omeka.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at http://www.apache.org/licenses/LICENSE-2.0 Unless required by
 * applicable law or agreed to in writing, software distributed under the
 * License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS
 * OF ANY KIND, either express or implied. See the License for the specific
 * language governing permissions and limitations under the License.
 *
 * @package omeka
 * @subpackage GoogleAnalytics
 * @author Wayne Graham (wayne.graham@gmail.com)
 * @copyright 2011
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 * @version 
 * @link http://www.liquidfoot.com
 *
 * PHP version 5
 *
 */
?>


<?php
// {{{ constants 
define('GOOGLE_ANALYTICS_PLUGIN_VERSION', get_plugin_ini('GoogleAnalytics', 'version'));
define('GOOGLE_ANALYTICS_PLUGIN_DIR', dirname(__FILE__));
// }}}

// {{{ hooks
add_plugin_hook('install', 'ga_install');
add_plugin_hook('uninstall', 'ga_uninstall');
add_plugin_hook('public_theme_footer', 'ga_footer');
add_plugin_hook('config_form', 'ga_config_form');
add_plugin_hook('config', 'ga_config');
// }}}

function ga_install()
{
    set_option('google_analytics_version', GOOGLE_ANALYTICS_PLUGIN_VERSION);
}

function ga_uninstall()
{
    delete_option('google_analytics_version');
}

function ga_config()
{
    set_option('google_analytics_key', trim($_POST['google_analytics_key']));
}

function ga_config_form()
{
    echo('<div id="ga_config_form">');
    echo('<label for="google_analytics_key">Google Analytics Key:</label>');
    echo text(array('name' => 'google_analytics_key', get_option('google_analytics_key'), null));
    echo('</div>');
}

function ga_footer()
{
    $gaKey = get_option('google_analytics_key'); // google analytics key
    $analytics =<<< ANALYTICS
    <!-- asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet -->
      <script>var _gaq=[['_setAccount','$gaKey'],['_trackPageview']];(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=true;g.src=('https:'==location.protocol?'https://ssl':'http://www')+'.google-analytics.com/ga.js';s.parentNode.insertBefore(g,s);})(document,'script');</script>
ANALYTICS;

    echo $analytics;
}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */
