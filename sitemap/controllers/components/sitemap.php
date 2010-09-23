<?php
/**
 * ExampleHook Component
 *
 * An example hook component for demonstrating hook system.
 *
 * @category Component
 * @package  Croogo
 * @version  1.0
 * @author   Nicolas Traeder <traedamatic@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class SitemapComponent extends Object {
    
/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param object $controller Controller with components to startup
 * @return void
 */
    function startup(&$controller) {
        $controller->set('sitemapHookStartup', 'SitemapHook startup');
    }
/**
 * Called after the Controller::beforeRender(), after the view class is loaded, and before the
 * Controller::render()
 *
 * @param object $controller Controller with components to beforeRender
 * @return void
 */
    function beforeRender(&$controller) {
        // Admin menu: admin_menu element of Example plugin will be shown in admin panel's navigation      
        
    }
/**
 * Called after Controller::render() and before the output is printed to the browser.
 *
 * @param object $controller Controller with components to shutdown
 * @return void
 */
    function shutdown(&$controller) {
    }
    
}
?>
