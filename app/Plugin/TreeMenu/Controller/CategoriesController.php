<?php
App::uses('TreeMenuAppController', 'TreeMenu.Controller');

/**
 * Categories Controller
 *
 * @property Category $Category
 */
class CategoriesController extends TreeMenuAppController {
    var $helpers = array('Html', 'Form', 'TreeMenu.Menu');
    public $uses = array('TreeMenu.Category');

    var $categoryAlias = null;
    public function beforeFilter(){
        parent::beforeFilter();

        $this->layout = 'TreeMenu.bootstrap';
        
        if(isset($this->params['named']['alias'])){
            $alias = Inflector::slug($this->params['named']['alias']);
            $this->categoryAlias = $alias;
            $humanizeAlias = Inflector::humanize($alias);
            $this->set(compact('alias', 'humanizeAlias'));
        }else{
            $alias = null;
            $humanizeAlias = __('Category');
            $this->set(compact('alias', 'humanizeAlias'));
        }
        
        if(isset($this->Auth)){
            $this->Auth->allow('*');
        }
    }

    public function get_menu_categories(){
        $this->autoRender  = false;
        
        $alias = $this->categoryAlias;
        $categories = Cache::read('get_menu_categories_'.$alias);
        if(empty($categories)){
            $conditions = array('Category.published'=>1);
            if($alias){
                $conditions['Category.alias'] = $alias;
            }else{
                $conditions[] = 'Category.alias IS NULL';
            }
            $categories = $this->Category->find('threaded', array('order'=>array('Category.lft'=>'ASC'),'conditions'=>$conditions));
            Cache::write('get_menu_categories', $categories);
        }

        return $categories;
    }
    
    /**
     * index method
     */
    public function index(){
       
    }
    
    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $alias = $this->categoryAlias;
        if($alias){
            $alias = Inflector::slug($alias);
            $this->set('title', Inflector::humanize($alias));
            $this->set('description', __('Manage').' '.Inflector::humanize($alias));
        }else{
            $this->set('title', __('Category'));
            $this->set('description', __('Manage Category'));
        }

        $this->Category->recursive = 0;
        $categories = $this->Category->getAllCategory($alias);
        $this->set('categories', $categories);
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        $alias = $this->categoryAlias;
        if ($this->request->is('post')) {
            $this->Category->create();
            if($alias) $this->request->data['Category']['alias'] = $alias;
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Data has been saved'), 'TreeMenu.success');
                $alias = ($alias) ? array('action' => 'index', 'alias'=>$alias) : array('action' => 'index');
                $this->redirect($alias);
            } else {
                $this->Session->setFlash(__('Data could not be saved. Please, try again.'), 'TreeMenu.error');
            }
        }

        $parentCategories = $this->Category->_generateTreeList($alias);
        $this->set(compact('parentCategories'));
    }

    /**
     * admin_edit method
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        
        $alias = $this->categoryAlias;
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Data has been saved'), 'success');
                //$this->redirect($this->__getPreviousUrl());
                $alias = ($alias) ? array('action' => 'index', 'alias'=>$alias) : array('action' => 'index');
                $this->redirect($alias);
            } else {
                $this->Session->setFlash(__('Data could not be saved. Please, try again.'), 'error');
            }
        } else {
            $this->request->data = $this->Category->read(null, $id);
        }
        $parentCategories = $this->Category->_generateTreeList($alias);
        $this->set(compact('parentCategories'));
    }

    /**
     * admin_delete method
     *
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid Data'));
        }
        
        $alias = $this->categoryAlias;
        $alias = ($alias) ? array('action' => 'index', 'alias'=>$alias) : array('action' => 'index');
        
        if ($this->Category->delete()) {
            $this->Session->setFlash(__('Data deleted'), 'success');            
            $this->redirect($alias);
        }
        $this->Session->setFlash(__('Data was not deleted'), 'error');
        $this->redirect($alias);
    }

    /**
     *  Active/Inactive
     *
     * @param int $id
     * @param int $status
     */
    public function admin_toggle($id, $status, $field = 'published') {
        $this->autoRender = false;

        if ($id) {
            $status = ($status) ? 0 : 1;
            $data['Category'] = array('id' => $id, $field => $status);
            if ($this->Category->saveAll($data['Category'], array('validate' => false))) {
                $link = ($this->base) ? FULL_BASE_URL .$this->base.'/' : '/';
                $plugin = Inflector::underscore($this->plugin);
                $url = $link.'/admin/'. $plugin . '/' . Inflector::tableize($this->name) . '/toggle/' . $id . '/' . $status . '/' . $field;
                $src = $link.$plugin. '/img/allow-' . $status . '.png';

                return "<img id=\"status-{$id}\" onclick=\"published.toggle('status-{$id}', '{$url}');\" src=\"{$src}\">";
            }
        }

        return false;
    }

    /**
     * Tree EXTJS
     *
     */
    public function admin_sort() {
        $this->set('title', __('Category'));
        $this->set('description', __('Sort Categories'));
    }

    public function admin_getnodes($alias=null) {
        $this->layout = 'ajax';
        // retrieve the node id that Ext JS posts via ajax
        $parent = isset($this->request->data['node']) ? intval($this->request->data['node']) : 0;

        // find all the nodes underneath the parent node defined above
        // the second parameter (true) means we only want direct children
        if ($parent) {
            $nodes = $this->Category->children($parent, true);
        } else {
            $conditions = array('Category.parent_id' => $parent);
            if($alias) {
                $conditions['Category.alias'] = $alias;
            }else{
                $conditions[] = 'Category.alias IS NULL';
            }
            $nodes = $this->Category->find('all', array(
                'conditions' => $conditions,
                'order' => array('Category.lft' => 'ASC')));
        }

        // send the nodes to our view
        $this->set(compact('nodes'));
    }

    function admin_reorder() {
        $this->autoRender = false;
        // retrieve the node instructions from javascript
        // delta is the difference in position (1 = next node, -1 = previous node)

        $node = intval($this->request->data['node']);
        $delta = intval($this->request->data['delta']);

        if ($delta > 0) {
            $this->Category->moveDown($node, abs($delta));
        } elseif ($delta < 0) {
            $this->Category->moveUp($node, abs($delta));
        }

        // send success response
        Cache::clear();
        clearCache();
        exit('1');
    }

    function admin_reparent() {
        $this->autoRender = false;

        $node = intval($this->request->data['node']);
        $parent = intval($this->request->data['parent']);
        $position = intval($this->request->data['position']);

        // save the employee node with the new parent id
        // this will move the employee node to the bottom of the parent list

        $this->Category->id = $node;
        $property['Category']['parent_id'] = $parent;
        $this->Category->save($property);

        // If position == 0, then we move it straight to the top
        // otherwise we calculate the distance to move ($delta).
        // We have to check if $delta > 0 before moving due to a bug
        // in the tree behavior (https://trac.cakephp.org/ticket/4037)

        if ($position == 0) {
            $this->Category->moveUp($node, true);
        } else {
            $count = $this->Category->childCount($parent, true);
            $delta = $count - $position - 1;
            if ($delta > 0) {
                $this->Category->moveUp($node, $delta);
            }
        }

        // send success response
        Cache::clear();
        clearCache();
        exit('1');
    }
}
