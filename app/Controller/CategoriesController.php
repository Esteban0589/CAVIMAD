<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class CategoriesController extends AppController {

	var $clasificacion = array('Filo' => 'Filo','Subfilo' => 'Subfilo','Clase' => 'Clase','Orden' => 'Orden','Familia' => 'Familia','Genero' => 'Genero','Especie' => 'Especie');
	var $name = 'Categories';
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');
	
	 public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index','edit','delete','buscar');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
			$d = $this->Category->generateTreeList(null,null,null,'--');
			$this->set('categories', $d);
		// $this->Category->recursive = 0;
		// $this->set('categories', $this->Paginator->paginate());
	}
/*
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('clasificacion', $this->clasificacion);
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				debug($this->request->data);
				$this->Flash->success(__('El nivel topologico fue agregado.'));
				return $this->redirect(array('action' => 'index'));
			}else {
				$this->Flash->error(__('El nivel topologico no pudo ser agregado, intente nuevamente.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
			$d = $this->Category->generateTreeList(null,null,null,'--');
			$this->set('categories', $d);
		}
	
	
		
		
		
		
		// if (!$this->Category->exists($id)) {
		// 	throw new NotFoundException(__('Invalid category'));
		// }
		// if ($this->request->is(array('post', 'put'))) {
		// 	if ($this->Category->save($this->request->data)) {
		// 		$this->Flash->success(__('The category has been saved.'));
		// 		return $this->redirect(array('action' => 'index'));
		// 	} else {
		// 		$this->Flash->error(__('The category could not be saved. Please, try again.'));
		// 	}
		// } else {
		// 	$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		// 	$this->request->data = $this->Category->find('first', $options);
		// }
		// $parentCategories = $this->Category->ParentCategory->find('list');
		// $this->set(compact('parentCategories'));
	}
	
	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Flash->success(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The category could not be saved. Please, try again.'));
			}
		}
		$parentCategories = $this->Category->ParentCategory->find('list');
		$this->set(compact('parentCategories'));
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->allowMethod('post', 'delete');
		$this->Category->removeFromTree($id);
			debug($id);
			$this->Flash->success(__('The category has been deleted.'));
		// } else {
		// 	$this->Flash->error(__('The category could not be deleted. Please, try again.'));
		// }
		return $this->redirect(array('action' => 'index'));
	}
	public function buscador() {
		$this->loadModel('User');
		$term = null;
		if(!empty($this->request->query['term'])){
			$term=$this->request->query['term'];
			$terms=explode(' ', trim($term));
			$terms=array_diff($terms,array(''));
			foreach($terms as $term){	
				$conditions[] = array('User.username LIKE' => '%'. $term . '%');
			}
		
		$usuario = $this->User->find('all', array('recursive'=>-1, 'fields' => array('User.username'), 'conditions'=>$conditions, 'limit' => 10));
		
		}
		echo json_encode($usuario);
		$this->autoRender=false;
	
		
		// $term = null;
		// if(!empty($this->request->query['term'])){
		// 	$term=$this->request->query['term'];
		// 	$terms=explode(' ', trim($term));
		// 	$terms=array_diff($terms,array(''));
		// 	foreach($terms as $term){
		// 		//	$conditions[] = array('Users.username LIKE' => '%' .$term. '%');
		// 		$conditions[] = array(
		// 			"OR" => array(
		// 				array('Users.username LIKE '=>'%'.$term.'%'),
		// 				array('Users.id LIKE '=>'%'.$term.'%')));
		// 	}
		// 	$this->loadModel('User');
		// 	$usuario = $this->User->find('all', array('recursive'=>-1, 'fields' => array('Users.username'), 'conditions'=>$conditions, 'limit' => 10));
		// }
		// echo json_encode($usuario);
		// $this->autoRender=false;
	}
	
	public function buscar() {
		$datos=($this->request->query['Buscar']);
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
}
