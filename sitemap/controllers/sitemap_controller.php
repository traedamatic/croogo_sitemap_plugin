<?php
/**
 * Sitemap Controller
 *
 * PHP version 5
 * @package sitemapplugin
 * @version  1.0
 * @author   Nicolas Traeder <traedamatic@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class SitemapController extends SitemapAppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
    var $name = 'Sitemap';
/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
    var $uses = array('Node');
    
    var $components = array('RequestHandler');
    
    var $helpers = array('Time');
    
    var $defaults = array();
    
    function beforeFilter() {
        parent::beforeFilter();
        
        $settings =& ClassRegistry::init('Setting');
        $this->defaults['changefreq'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Sitemap.changefreq'),'fields' => array('Setting.id','Setting.value')));
        $this->defaults['priority'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Sitemap.priority'), 'fields' => array('Setting.id','Setting.value')));
        $this->defaults['types'] = $settings->find('all', array('conditions' => array('Setting.key =' => 'Sitemap.types'), 'fields' => array('Setting.id','Setting.value')));
        $this->defaults['order'] = $settings->find('all', array('conditions' => array('Setting.key =' => 'Sitemap.order'), 'fields' => array('Setting.id','Setting.value')));
        
        if (!empty($this->defaults['changefreq'])) {
            $this->defaults['changefreq'] =  $this->defaults['changefreq'][0]['Setting'];
            $this->defaults['priority'] =  $this->defaults['priority'][0]['Setting'];        
            $this->defaults['types'] =  $this->defaults['types'][0]['Setting'];        
            $this->defaults['order'] =  $this->defaults['order'][0]['Setting'];        
            $this->set('defaults', $this->defaults);
        }
        
       
    }
    
    
    function admin_index() {
        
        if(!empty($this->data)) {
            $settings =& ClassRegistry::init('Setting');
            foreach ($this->data['Sitemap'] as $key=>$setting) {
                $settings->id = $setting['id'];
                $settings->saveField('value',$setting['value']);
            }            
            $this->Session->setFlash(__('The Sitemap Options has been saved', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->set('inputs', $this->defaults);
    }
    
    function index() {
      
        $this->pageTitle = __('Sitemap', true);
        
        $this->Node->contain('Meta');
        
        $sitemapData = $this->__getSiteMapData($this->Node->find('all',array('conditions' => $this->__getConditions(), 'order' => $this->defaults['order']['value'])));
        
        $this->set(compact('sitemapData'));
        
    }
    
    function xml() {
        Configure::write ('debug', 0);
        
        $this->layout = 'xml/default';        
        
        $this->Node->contain('Meta');
        
        $sitemapData = $this->__getSiteMapData($this->Node->find('all',array('conditions' => $this->__getConditions(), 'order' => $this->defaults['order']['value'])));
        
        $this->set(compact('sitemapData'));
        
        $this->RequestHandler->respondAs('xml');
        
    }
    
    
    function __getSiteMapData ($data) {        
         $sitemapData = array();
        //debug($nodes);
        foreach ($data as $key=>$d) {
            $sitemapData[$key]['Node']['title'] = $d['Node']['title'];
            $sitemapData[$key]['Node']['path'] = $d['Node']['path'];
            $sitemapData[$key]['Node']['type'] = $d['Node']['type'];
            $sitemapData[$key]['Node']['CustomFields'] = $d['CustomFields'];            
        }
        
        return $sitemapData;
    }

    function __getConditions () {
        return array('Node.status =' => 1, 'Node.type' => array_values(preg_split('/,\s*/', $this->defaults['types']['value'])));
        
    }
}
?>
