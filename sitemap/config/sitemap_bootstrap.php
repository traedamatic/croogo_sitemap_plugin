<?php
/**
 * Routes
 *
 * example_routes.php will be loaded in main app/config/routes.php file.
 */
    Croogo::hookRoutes('Sitemap');

/**
 * Component
 *
 * This plugin's Example component will be loaded in ALL controllers.
 */
    Croogo::hookComponent('*', 'Sitemap.Sitemap');

/**
 * Admin menu (navigation)
 *
 * This plugin's admin_menu element will be rendered in admin panel under Extensions menu.
 */
    Croogo::hookAdminMenu('Sitemap');

?>
