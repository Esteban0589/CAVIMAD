<?php
App::uses('AppController', 'Controller');
/**
 * Links Controller
 * 
 * Este conrtolador tiene los métodos para manejar los links de referencias a otras páginas.
 * Maneja tanto la sección de referencias, como la sección de biomonitoreo.
 *
 * @property Link $Link
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class LinksController extends AppController {

	/**
	 * Components
	 * 
	 * Contine los componentes del controlador, en este caso el paginador, flash para mensajes y el de sesión para el manejo de usuarios.
	 *
	 * @var array
	 */
	public $components = array('Paginator', 'Flash', 'Session');

	/**
	 * index method
	 * 
	 * Método que devuelve todas los links de referencia que han sido agregados
	 * 
	 * @param void
	 * @return void
	 */
	public function index() {
		$link=$this->Link->find('all', array('conditions'=>array('Link.relatedpage'=>!'Biomonitoreo')));
    	$this->set('Links', $link);
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
        //Métodos a los cuales se permite llamar
        $this->Auth->allow('index','logout', 'login');
    }

	/**
	 * add method
	 * 
	 * Método para agregar un nuevo link de referencia a la página
	 * 
	 * @param void
	 * @return void
	 */
	public function add() {
		if(!($this->Session->read('Auth')['User']['role'] == 'Administrador' || $this->Session->read('Auth')['User']['role'] == 'Colaborador')) {
			$this->Flash->error(__('No puede acceder a esta sección.'));
            return $this->redirect(array('controller'=>'pages','action' => 'display'));
		}
		$this->loadModel('User');
		$this->loadModel('Administrator');
		$adm_id=$this->Administrator->find('first',array('conditions' => array($this->Session->read('Auth')['User']['id'])));
		//return debug($adm_id);
		// llena el formulario y se guardan los datos, luego se notifica al usuario
		if ($this->request->is('post')) {
			$data=array('Link' =>array('title'=>$this->request->data['Link']['title'], 
										'url'=>$this->request->data['Link']['url'],
										'description'=>$this->request->data['Link']['description'],
										'relatedpage'=>$this->request->data['Link']['relatedpage'],
										'administrator_id'=>$adm_id['Administrator']['id']));
			$link = $data['Link']['url'];
			$rest = substr($link, 0, 4);  // returns los primeros 4 caracteres del link
			// return debug($data);
			if ($rest != "http"){
				$data['Link']['url'] = "http://".$link;
			}
			$this->Link->create();
			if ($this->Link->save($data)) {
				$this->Flash->success(__('El enlace se guardo correctamente.'));
				return $this->redirect(array('action' => 'index'));
				//sino se pudieron agregar los datos se notifica al usuario
			} else {
				$this->Flash->error(__('El enlace no se pudo guardar. Intentelo nuevamente.'));
			}
		}
	//	debug($user);
	}
	
	/**
	 * add_bio method
	 * 
	 * Método para agregar un nuevo link de referencia en la sección de biomonitoreo
	 * 
	 * @param void
	 * @return void
	 */
	public function add_bio() {
		if(!($this->Session->read('Auth')['User']['role'] == 'Administrador' || $this->Session->read('Auth')['User']['role'] == 'Colaborador')) {
			$this->Flash->error(__('No puede acceder a esta sección.'));
            return $this->redirect(array('controller'=>'pages','action' => 'display'));
		}
		$this->loadModel('User');
		$this->loadModel('Administrator');
		$adm_id=$this->Administrator->find('first',array('conditions' => array('Administrator.user_id'=>$_SESSION['Auth']['User']['id'])));
		//return debug($adm_id);
		$bio='Biomonitoreo';
		// llena el formulario y se guardan los datos, luego se notifica al usuario
		if ($this->request->is('post')) {
			$data=array('Link' =>array('title'=>$this->request->data['Link']['title'], 
										'url'=>$this->request->data['Link']['url'],
										'description'=>$this->request->data['Link']['description'],
										'relatedpage'=>$bio,
										'administrator_id'=>$adm_id['Administrator']['id']));
			$this->Link->create();
			if ($this->Link->save($data)) {
				$this->Flash->success(__('El enlace se guardo correctamente.'));
				return $this->redirect(array('controller'=>'downloads','action' => 'index_bio'));
				//sino se pudieron agregar los datos se notifica al usuario
			} else {
				$this->Flash->error(__('El enlace no se pudo guardar. Intentelo nuevamente.'));
			}
		}
	//	debug($user);
	}

	/**
	 * edit method
	 * 
	 * Método para editar un link de referencia
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		//si el enlace no existe retorna error
		if (!$this->Link->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		if ($this->request->is(array('post', 'put'))) {
			// se editan los datos del link y se notifica al usurio
			$link = $this->request->data['Link']['url'];
			$rest = substr($link, 0, 4);  // returns "abcde"
			// return debug($rest);
			if ($rest != "http"){
				$this->request->data['Link']['url'] = "http://".$link;
			}
			if ($this->Link->save($this->request->data)) {
				$this->Flash->success(__('El enlace se guardo correctamente.'));
				return $this->redirect(array('action' => 'index'));
				// sino se logran editar los datos notifica al usuario
			} else {
				$this->Flash->error(__('El enlace no se pudo guardar. Intentelo nuevamente.'));
			}
		} else {
			$options = array('conditions' => array('Link.' . $this->Link->primaryKey => $id));
			$this->request->data = $this->Link->find('first', $options);
		}
	}
	
	/**
	 * edit_bio method
	 * 
	 * Método para editar un link de referencia que esté en la sección de biomonitoreo
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit_bio($id = null) {
		//si el enlace no existe retorna error
		if (!$this->Link->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		if ($this->request->is(array('post', 'put'))) {
			// se editan los datos del link y se notifica al usurio
			if ($this->Link->save($this->request->data)) {
				$this->Flash->success(__('El enlace se guardo correctamente.'));
				return $this->redirect(array('controller'=>'downloads','action' => 'index_bio'));
				// sino se logran editar los datos notifica al usuario
			} else {
				$this->Flash->error(__('El enlace no se pudo guardar. Intentelo nuevamente.'));
			}
		} else {
			$options = array('conditions' => array('Link.' . $this->Link->primaryKey => $id));
			$this->request->data = $this->Link->find('first', $options);
		}
	}
	
	/**
	 * delete method
	 * 
	 * Método para eliminar un link de referencia
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Link->id = $id;
		//si el enlace no existe retorna error
		if (!$this->Link->exists()) {
			throw new NotFoundException(__('Invalid link'));
		}
		$this->request->allowMethod('post', 'delete');
		// se eliminan los datos del link y se notifica al usurio
		if ($this->Link->delete()) {
			$this->Flash->success(__('El enlace se elimino correctamente.'));
			// sino se logran eliminar los datos notifica al usuario
		} else {
			$this->Flash->error(__('El enlace no se pudo eliminar. Intentelo nuevamente'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	
}
