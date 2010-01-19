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
class SitemapHookComponent extends Object {
    
    
/**
 * Called after activating the hook in ExtensionsHooksController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    function onActivate(&$controller) {
        // ACL: set ACOs with permissions
        $controller->Croogo->addAco('Sitemap'); // ExampleController
        $controller->Croogo->addAco('Sitemap/index', array('registered', 'public','admin')); // ExampleController::index()
        $controller->Croogo->addAco('Sitemap/xml', array('registered', 'public','admin')); // ExampleController::index()

        // Routes: app/plugins/example/config/routes.php will be loaded in app/config/routes.php
        $controller->Croogo->addPluginRoutes('sitemap');
        
        $controller->Setting->write('Sitemap.changefreq','weekly',array('description' => 'Default Changefeq of the Sitemap entries','editable' => 1));
        $controller->Setting->write('Sitemap.priority',0.8,array('description' => 'Default Priority of the Sitemap entries','editable' => 1));
        
        
    }
/**
 * Called after deactivating the hook in ExtensionsHooksController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    function onDeactivate(&$controller) {
        // ACL: remove ACOs with permissions
        $controller->Croogo->removeAco('Sitemap'); // ExampleController ACO and it's actions will be removed

        // Routes: remove
        $controller->Croogo->removePluginRoutes('sitemap');
       
        $controller->Setting->deleteKey('Sitemap.changefreq');
        $controller->Setting->deleteKey('Sitemap.priority');
        
    }
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
        Configure::write('Admin.menus.sitemap', 1);

        $controller->set('sitemapHookBeforeRender', 'SitemapHook beforeRender');
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
