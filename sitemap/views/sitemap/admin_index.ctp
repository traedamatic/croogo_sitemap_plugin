<?php
/**
 *
 *
 * admin index of the sitemap plugin
 *
 */
?>

<h2> <?php echo __('Sitemap - Options',true); ?> </h2>

<?php

echo $form->create('Settings', array('url' => array('plugin' => 'sitemap', 'controller' => 'sitemap', 'action' => 'index', 'admin' => true)));
echo $form->input('Sitemap.changefreq.value', array('default' => $inputs['changefreq']['value'], 'label' => 'Changefreq' ));
echo $form->input('Sitemap.changefreq.id', array('type' => 'hidden', 'default' => $inputs['changefreq']['id'] ));
echo $form->input('Sitemap.priority.value', array('default' => $inputs['priority']['value'], 'label' => 'Priority' ));
echo $form->input('Sitemap.priority.id', array('type' => 'hidden', 'default' => $inputs['priority']['id'] ));
echo $form->input('Sitemap.types.value', array('default' => $inputs['types']['value'], 'label' => 'Priority' ));
echo $form->input('Sitemap.types.id', array('type' => 'hidden', 'default' => $inputs['types']['id'] ));
echo $form->end(__('Submit',true));

?>

