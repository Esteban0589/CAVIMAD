<?php
App::uses('TreeMenuAppController', 'TreeMenu.Controller');

/**
 * Categories Controller
 *
 * @property Category $Category
 */
class CategoriesController extends TreeMenuAppController {
    public $helpers = array('Html', 'Form', 'TreeMenu.Menu', 'Js');
    public $uses = array('TreeMenu.Category');

    var $categoryAlias = null;
    var $classification = array('Filo' => 'Filo','Subfilo' => 'Subfilo','Clase' => 'Clase','Orden' => 'Orden','Suborden' => 'Suborden','Familia' => 'Familia','Subfamilia' => 'Subfamilia','Género' => 'Género');

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('logout', 'login','buscador','buscar','index','view','sort');
        /*$this->layout = 'TreeMenu.bootstrap';*/
        $this->layout = 'default';
        
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
    public function indexNormal(){
       
    }
    
    /**
     * admin_index method
     *
     * @return void
     */
    public function index() {
        $alias = $this->categoryAlias;
        clearCache();
        if($alias){
            $alias = Inflector::slug($alias);
            $this->set('title', Inflector::humanize($alias));
            $this->set('description', __('Manage').' '.Inflector::humanize($alias));
        }else{
            $this->set('title', __('Categoria'));
            $this->set('description', __('Manejar categoria'));
        }
        
        $categoriesfind = $this->Category->find('all');
        $this->set('allCategories', $categoriesfind);
        
      /*  $this->Category->recursive = 0;
        $categories = $this->Category->getAllCategory($alias);
        $this->set('categories', $categories);*/
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function add() {
        $alias = $this->categoryAlias;
        if ($this->request->is('post')) {
            $this->Category->create();
            if($alias) $this->request->data['Category']['alias'] = $alias;
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Datos ingresados correctamente'), 'TreeMenu.success');
                $alias = ($alias) ? array('action' => 'index', 'alias'=>$alias) : array('action' => 'index');
                $this->redirect($alias);
            } else {
                $this->Session->setFlash(__('Los datos no se guardaron. Intente nuevamente.'), 'TreeMenu.error');
            }
        }

        $parentCategories = $this->Category->_generateTreeList($alias);
        $this->set(compact('parentCategories'));
        $this->set('classification', $this->classification);
    }

    /**
     * admin_edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Categoria no valida'));
        }
        
        $alias = $this->categoryAlias;
        if ($this->request->is('post') || $this->request->is('put')) {
            debug($this->request->data);
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Datos ingresados correctamente'), 'success');
                //$this->redirect($this->__getPreviousUrl());
                $alias = ($alias) ? array('action' => 'index', 'alias'=>$alias) : array('action' => 'index');
                // $this->redirect($alias);
            } else {
                $this->Session->setFlash(__('Los datos no se guardaron. Intente nuevamente.'), 'error');
            }
        } else {
            $this->request->data = $this->Category->read(null, $id);
        }
        $parentCategories = $this->Category->_generateTreeList($alias);
        $this->set(compact('parentCategories')); 
        $this->set('classification', $this->classification);
    }

    /**
     * admin_delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Datos no validos'));
        }
        
        $alias = $this->categoryAlias;
        $alias = ($alias) ? array('action' => 'index', 'alias'=>$alias) : array('action' => 'index');
        
        if ($this->Category->delete()) {
            $this->Session->setFlash(__('Datos eliminados'), 'success');            
            $this->redirect($alias);
        }
        $this->Session->setFlash(__('Datos no eliminados'), 'error');
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
    public function sort() {
        $this->set('title', __('Category'));
        $this->set('description', __('Sort Categories'));
    }
    
    public function buscar() {
		$datos=($this->request->query['Buscar']);
		debug($this->request->query['Buscar']);
		if(($datos)){
			$this->loadModel('Picture');
			$condition=explode(' ', trim($datos));					
			$condition=array_diff($condition,array(''));
			if($condition){
				foreach($condition as $tconditions){
					$conditions[] = array(
						"OR" => array(
						    array('Category.name LIKE '=>'%'.$tconditions.'%')
						)
						    
					);
				}
				$resultado=$this->Category->find('all', array('recursive'=>0, 'conditions'=>$conditions, 'limit' => 10));
				$i = 0;
				foreach($resultado as $resultados){
					if($this->Picture->findByCategorie_id($resultado[$i]['Category']['id'])){
						if(count($this->Picture->findByCategorie_id($resultado[$i]['Category']['id'])['Picture']['id'])==1){
							$myRandomNumber[]=0;	
						}
						else{
							$myRandomNumber[] = rand(0,count($this->Picture->findByCategorie_id($resultado[$i]['Category']['id'])['Picture']['id']));
						}
						$resultado[$i]=$resultado[$i]+$myRandomNumber+$this->Picture->findByCategorie_id($resultado[$i]['Category']['id']);
					}
					$i++;
				}
				if(count($resultado)>0){
					$this->set('resultados',$resultado);
				}
				else{
					return $this->Flash->error(__('No hay resultados para este criterio de búsqueda.'));
				}
			}
		}
		else{
			return $this->Flash->error(__('Criterio de búsqueda no válido.'));
		}
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
    
        ///Método de carga de la búsqueda avanzada.
        public function advanced_search2()
		{
		    $this->loadModel('Administrator');
		    //Carga todos los órdenes para en la varible $order.
		    $order = $this->Category->find('list', array(
          'conditions' => array('Category.classification' => 'Orden'),
          'recursive' => -1));
          //Estas variables se declaran en null pues se proceden a llenar con los métodos getDataFamily y getDataGenre.
          $family=array(null);
          $genre=array(null);
          //Envía las variables a a la vista.
         $this-> set (compact('categories', 'order'));
         $this-> set (compact('categories', 'family'));
         $this-> set (compact('categories', 'genre'));
         $this-> set (compact('categories', 'colaborator'));
	
	
    	}
    	
	///Método utilizado para refrescar las familias según el orden seleccionado. La actualización se realiza via javascript.
	public function getDataFamily(){
	    //Permite desplegar los resultados de ajax.
	    $this->layout = 'ajax';
	    //Si se trata de actualizar a través de get...
	    if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        //Recupera el orden seleccionado enviado por el método de javascript  y realiza la consulta para obtener todas las familias de ese orden en específico.
        else{
            $order=$this->request->data['order'];
	        $family = $this->Category->find('list', array(
            'conditions' => array('Category.parent_id' => $order),
            'recursive' => -1));

		    $this->set('family', $family);

        } 
    
	}
	
	///Método utilizado para refrescar los géneros según el orden seleccionado. La actualización se realiza via javascript.
	public function getDataGenre(){
	     //Permite desplegar los resultados de ajax.
	    $this->layout = 'ajax';
	     //Si se trata de actualizar a través de get...
	    if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        //Recupera el género seleccionado enviado por el método de javascript  y realiza la consulta para obtener todos los géneros de esa familia en específico.
        else{
            $family=$this->request->data['family'];
	        $genre = $this->Category->find('list', array(
            'conditions' => array('Category.parent_id' => $family),
            'recursive' => -1));

		    $this->set('genre', $genre);

        } 
    
	}
	
	///Busca un colaborador según el nombre, apellido o usuario.
	  public function searchColaborator() {
	      //Obtiene los datos de la búsqueda.
		$data=($this->request->query['colaborator']);
		//Sí no es nulo.
		if(($data)){
		    //Carga el modelo de usuarios.
			$this->loadModel('User');
			$condition=explode(' ', trim($data));					
			$condition=array_diff($condition,array(''));
			if($condition){
				foreach($condition as $tconditions){
					$conditions[] = array(
						"OR" => array(
						    array('User.name LIKE '=>'%'.$tconditions.'%'),
						    array('User.lastname1 LIKE'=>'%'.$tconditions.'%'),
						    array('User.username LIKE'=>'%'.$tconditions.'%')
						)
					);
				}
				$result=$this->User->find('all', array('recursive'=>0, 'conditions'=>$conditions));

				if(count($result)>0){
					$this->set('resultados',$result);
				}
				else{
					return $this->Flash->error(__('No hay resultados para este criterio de búsqueda.'));
				}
			}
		}
		else{
			return $this->Flash->error(__('Criterio de búsqueda no válido.'));
		}
	}
	
	
    
}
