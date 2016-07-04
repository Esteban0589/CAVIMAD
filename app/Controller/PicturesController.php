<?php
App::uses('AppController', 'Controller');
/**
 * Pictures Controller
 * 
 * Este controlador tiene los métodos para el manejo de las fotos de los taxones
 *
 * @property Picture $Picture
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class PicturesController extends AppController {

	/**
	 * Components
	 * 
	 * Contine los componentes del controlador, en este caso el paginador, flash para mensajes y el de sesión para el manejo de usuarios.
	 *
	 * @var array
	 */
	public $components = array('Paginator', 'Flash', 'Session');

	/**
	 * beforeFilter method
	 * 
	 * Contiene los métodos a los cuales se permite llamar sin tener una sesión de usuario activa o sin los privilegios requeridos.
	 * 
	 *
	 * @param void
	 * @return void
	 */
	public function beforeFilter() {
        parent::beforeFilter();
        //Métodos a los cuales se permite llamar
        $this->Auth->allow('logout', 'login', 'view');
    }

	/**
	 * view method
	 * 
	 * Método para visualizar las fotos asociadas a un taxón específico
	 *
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->loadModel('Gender');
		// $this->loadModel('Family');
		// $this->loadModel('Category');
		//$cat = $this->Category->find(array('conditions' => array('Category.id' => $id)));
		//$this->set('category', $cat);

		$idCategoriaenGender = $this->Gender->find('first',array('conditions' => array('Gender.category_id' => $id)));
		/*if($idCategoriaenGender == null) {
			$idCategoriaenFamily = $this->Family->find('first',array('conditions' => array('Gender.category_id' => $id)));
		}*/
		
		
		$id = $idCategoriaenGender['Gender']['id'];
		$fotosGenero = $this->Picture->find('all', array('conditions' => array('Picture.genre_id' => $id)));
		// return debug($fotosGenero);
		//debug($fotosGenero);
		$this->set('pictures', $fotosGenero);
		$this->set('id', $id);
		
	}

	/**
	 * debugController method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function debugController($id) {
			$this->request->data = $id;
	}
	
	
	/**
	 * add method
	 * 
	 * Método para agregar una foto a un taxón del catálogo
	 *
	 * @param void
	 * @return void
	 */
	public function add() {
		// Controla el acceso de los usuarios habilitados o deshabilitados.
		// En caso de usuarios deshabilitados, los deslogea y los redirige a otra pagina.
		$this->loadModel('User');
		if($this->Session->read('Auth')['User']['activated'] !=1){
			return $this->redirect(array('controller' => 'users','action' => 'userdesha'));
		}

		$this->loadModel('Gender');
		if (($this->request->is('post')) && ($this->request->data['Picture']['image']['name'] != '')) { 
			$this->loadModel('Category');
			
			 //debug($this->request->data);
			 //debug($this->request->data['Picture']['genre_id']);
			
			
			
			$categoryId = $this->Gender->find('first', array('conditions' => array('Gender.id' => $this->request->data['Picture']['genre_id'])));
			$phylo = null;
			$subphylo = null;
			$class = null;
			$subclass = null;
			$order = null;
			$suborder = null;
			$family = null;
			$subfamily = null;
			$genre = null;
			$subgenre = null;
			
			$parents = $this->Category->getPath($categoryId['Gender']['category_id']);
			 
			 //debug($parents['1']);
			 //debug($parents);
			// $i=0;
			// debug($parents[$i]['Category']['id']);

			for($i=0 ;$parents[$i]['Category']['id'] !=  $categoryId['Gender']['category_id']; $i++){
				$clasificacion = $parents[$i]['Category']['classification'];
				switch ($clasificacion) {
				    case "Filo":
				    	$phylo = $parents[$i]['Category']['id'];
				        break;
				    case "Subfilo":
				        $subphylo=$parents[$i]['Category']['id'];
				        break;
				    case "Clase":
				        $class=$parents[$i]['Category']['id'];
				        break;
				    case "Subclase":
				        $subclass=$parents[$i]['Category']['id'];
				        break;
				    case "Orden":
				        $order=$parents[$i]['Category']['id'];
				        break;  
				    case "Suborden":
				        $suborder = $parents[$i]['Category']['id'];
				        break;
				    case "Familia":
				        $family = $parents[$i]['Category']['id'];
				        break;
				    case "Subfamilia":
				        $subfamily = $parents[$i]['Category']['id'];
				        break;
				    case "Genero":
				        $genre = $parents[$i]['Category']['id'];
				        break;
				    case "Subgenero":
				        $subgenre = $parents[$i]['Category']['id'];
				        break;
				    default:
				        // no haga nada
				} //Cierra switch
			} //Cierra for
			$this->request->data['Picture']['phylo_id']=$phylo;
			$this->request->data['Picture']['subphylo_id']=$subphylo;
			$this->request->data['Picture']['class_id']=$class;
			$this->request->data['Picture']['subclass_id']=$subclass;
			$this->request->data['Picture']['order_id'] = $order;
			$this->request->data['Picture']['suborder_id'] = $suborder;
			$this->request->data['Picture']['family_id'] = $family;
			$this->request->data['Picture']['subfamily_id'] = $subfamily;
			//$this->request->data['Picture']['genre_id'] = $categoryId['Gender']['category_id'];
			$this->request->data['Picture']['subgenre_id'] = $subgenre;
			

			 //debug($this->request->data);

			$this->Picture->create();
			// si los datos pudieron ser guardados notifica al usuario y redireciona a la vista
			if ($this->Picture->save($this->request->data)) {
				
			$this->Flash->success(__('La imagen a sido guardada.'));
				$idCategoriaenGender = $this->Gender->find('first', array('conditions' => array('Gender.id' => $this->request->data['Picture']['genre_id'])));
				$id = $idCategoriaenGender['Gender']['category_id'];
				return $this->redirect(array('action' => 'view',$id));
			} else {
				// de no poder ser guardada la imagen notifica al usuario
			$this->Flash->error(__('La imagen no pudo ser guardada. Intentelo nuevamente.'));
			}
		} else {
			$this->Flash->error(__('La imagen no pudo ser guardada. Intentelo nuevamente.'));
				$idCategoriaenGender = $this->Gender->find('first', array('conditions' => array('Gender.id' => $this->request->data['Picture']['genre_id'])));
				$id = $idCategoriaenGender['Gender']['category_id'];
				return $this->redirect(array('action' => 'view',$id));
		}
	}

	/**
	 * delete method
	 * 
	 * Método para eliminar alguna de las fotos asociadas a un taxón
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		// Controla el acceso de los usuarios habilitados o deshabilitados.
		// En caso de usuarios deshabilitados, los deslogea y los redirige a otra pagina.
		$this->loadModel('User');
		if($this->User->findById($_SESSION['Auth']['User']['id'])['User']['activated']!=1){
			return $this->redirect(array('controller' => 'users','action' => 'userdesha'));
		}
		$this->Picture->id = $id;
		// si la imagen ya existe regresa un error
		if (!$this->Picture->exists()) {
			throw new NotFoundException(__('Invalid picture'));
		}
		$this->loadModel('Gender');
				$categoryId = $this->Picture->find('first', array('conditions' => array('Picture.id' => $id)));

		$categoryId = $this->Gender->find('first', array('conditions' => array('Gender.id' => $categoryId['Picture']['genre_id'])));
		$this->request->allowMethod('post', 'delete');
		// si los datos de la imagen lograron ser eliminados notifica al usuario 
		if ($this->Picture->delete()) {
			$this->Flash->success(__('La imagen a sido eliminiada.'));
			// sino notifica del error
		} else {
			$this->Flash->error(__('La imagen no pudo ser eliminada. Intentelo nuevamente.'));
		}
			
		return $this->redirect(array('action' => 'view',$categoryId['Category']['id']));
	}
}
