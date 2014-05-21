<?php
/**
 * Sitemap Activation
 *
 * Activation class for Sitemap plugin.
 * This is optional, and is required only if you want to perform tasks when your plugin is activated/deactivated.
 *
 * @package  Croogo
 * @author   Nicolas Traeder <hallo@codebility.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://codebility.com
 */
class SitemapActivation {
/**
 * onActivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeActivation(&$controller) {
        return true;
    }
/**
 * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onActivation(&$controller) {
        // ACL: set ACOs with permissions
        $controller->Croogo->addAco('Sitemap'); // ExampleController
        $controller->Croogo->addAco('Sitemap/index', array('registered', 'public','admin')); // ExampleController::index()
        $controller->Croogo->addAco('Sitemap/xml', array('registered', 'public','admin')); // ExampleController::index()       
        
        $controller->Setting->write('Sitemap.changefreq','weekly',array('description' => 'Default Changefeq of the Sitemap entries','editable' => 1));
        $controller->Setting->write('Sitemap.priority',0.8,array('description' => 'Default Priority of the Sitemap entries','editable' => 1));
        $controller->Setting->write('Sitemap.types','blog,node,page',array('description' => 'Default node types to include in the Sitemap','editable' => 1));
        $controller->Setting->write('Sitemap.order','Node.id',array('description' => 'Default order of nodes in the Sitemap','editable' => 1));

     
    }
/**
 * onDeactivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeDeactivation(&$controller) {
        return true;
    }
/**
 * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onDeactivation(&$controller) {
        // ACL: remove ACOs with permissions
        $controller->Croogo->removeAco('Sitemap'); // ExampleController ACO and it's actions will be removed

        // Routes: remove
        $controller->Croogo->removePluginBootstrap('sitemap');
       
        $controller->Setting->deleteKey('Sitemap.changefreq');
        $controller->Setting->deleteKey('Sitemap.priority');
        $controller->Setting->deleteKey('Sitemap.types');
        $controller->Setting->deleteKey('Sitemap.order');

      
    }
}
?>
