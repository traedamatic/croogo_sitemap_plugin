<?php
    CroogoRouter::connect('/sitemap', array('plugin' => 'sitemap', 'controller' => 'sitemap', 'action' => 'index'));
    CroogoRouter::connect('/sitemap/*', array('plugin' => 'sitemap', 'controller' => 'sitemap', 'action' => 'index'));
    CroogoRouter::connect('/sitemap.xml', array('plugin' => 'sitemap', 'controller' => 'sitemap', 'action' => 'xml'));
    
    Router::parseExtensions();
    
?>