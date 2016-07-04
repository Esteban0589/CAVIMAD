<?php
App::uses('AppController', 'Controller');
/**
 * Administrators Controller
 * 
 * Este controllador contiene los metodos y componentes que se utilizaran en todos los controllers hijos.
 * Es un controlador donde se manejan las fuciones de los administradores.
 *
 * @property Administrator $Administrator
 * @property PaginatorComponent $Paginator
 */
class AdministratorsController extends AppController {

/**
 * Components
 * 
 * Contine los componentes del controlador, en este caso el paginador.
 * 
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * Permite ingresar a la tabla que contiene a todos los administradores del página web
 * 
 * @throws NotFoundException
 * @param void
 * @return void
 */
	public function index() {
		if ( $this->Session->read('Auth')['User']['role'] != 'Administrador'  ) {
			throw new NotFoundException(__('Usuario no valido.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		$this->Administrator->recursive = 0;
		$this->set('administrators', $this->Paginator->paginate());
	}

/**
 * view method
 * 
 * Permite ver la lista completa de los administradores de la página web.
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if ( $this->Session->read('Auth')['User']['role'] != 'Administrador'  ) {
			throw new NotFoundException(__('Usuario no valido.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		//Si el administrador a buscar no existe se notifica mediante un mensaje de error
		if (!$this->Administrator->exists($id)) {
			throw new NotFoundException(__('Invalid administrator'));
		}
		$options = array('conditions' => array('Administrator.' . $this->Administrator->primaryKey => $id));
		$this->set('administrator', $this->Administrator->find('first', $options));
	}


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
        $this->Auth->allow('add','logout', 'login', 'index', 'edit', 'view', 'delete');
    }


/**
 * add method
 *
 * Permite agregar un nuevo administrador a la página web y de una vez lo indexa en la tabla de administradores.
 * 
 * @param void
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Administrator->create();
			// si los datos son agregados correctamente crea un nuevo admisnitrador
			if ($this->Administrator->save($this->request->data)) {
				$this->Flash->success(__('The administrator has been saved.'));
				return $this->redirect(array('action' => 'index'));
				// si los datos no pueden ser guardados notifica al usuario
			} else {
				$this->Flash->error(__('The administrator could not be saved. Please, try again.'));
			}
		}
		$users = $this->Administrator->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 * 
 * Permite editar la información de un administrador previamente agregado.
 *
 * @throws NotFoundException
 * @param string $id
 * @return array
 */
	public function edit($id = null) {
		if ( $this->Session->read('Auth')['User']['role'] != 'Administrador'  ) {
			throw new NotFoundException(__('Usuario no valido.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		//Si el administrador a buscar no existe se notifica mediante un mensaje de error
		if (!$this->Administrator->exists($id)) {
			throw new NotFoundException(__('Invalid administrator'));
		}
		// si los datos del admisnitrador son agregados correcttamente este guarda y redirige al index
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Administrator->save($this->request->data)) {
				$this->Flash->success(__('The administrator has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				// si los datos no puden sr guardados notifica al usuario
				$this->Flash->error(__('The administrator could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Administrator.' . $this->Administrator->primaryKey => $id));
			$this->request->data = $this->Administrator->find('first', $options);
		}
		$users = $this->Administrator->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * Elimina un administrador de la página web, deshabilitando el usuario.
 * 
 * @throws NotFoundException
 * @param string $id
 * @return array
 */
	public function delete($id = null) {
		$this->Administrator->id = $id;
		//Si el administrador a buscar no existe se notifica mediante un mensaje de error
		if (!$this->Administrator->exists()) {
			throw new NotFoundException(__('Invalid administrator'));
		}
		$this->request->allowMethod('post', 'delete');
		//Si el adminstrador se pudo borrar se notifica mediante un mensaje
			$this->Flash->success(__('The administrator has been deleted.'));
		} else {
			//Si administrador no se pudo eliminra se notifica mediante un mensaje de error
			$this->Flash->error(__('The administrator could not be deleted. Please, try again.'));
		}
		// si la accion es completada redirecciona al index de administradores
		return $this->redirect(array('action' => 'index'));
	}
}
