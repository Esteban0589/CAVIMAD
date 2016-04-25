<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var $roles = array('Administrador' => 'Administrador','Colaborador' => 'Colaborador','Usuario' => 'Usuario','Editor' => 'Editor');
		
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('role', $this->roles);
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}


/**
 * viewManagers method
 * 
 * Devuelve la lista de colaboradores de la página
 *
 * @return void
 */
	public function viewManagers() {
		$this->loadModel('Administrator');
		$this->User->recursive = 0;
		$this->set('users', $users = $this->User->find('all', array('conditions' => array('User.role' => 'Colaboradores'))));
		$this->set('colaboradores', $colaboradores = $this->Administrator->find('all'));
	}
	


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','logout', 'login', 'viewManagers');
    }


    public function login() {
        if( !(empty($this->data))){
            if($this->Auth->login() ){
            	$_SESSION['role'] = $this->Session->read("Auth.User.role") ;
	            $_SESSION['username'] = $this->Session->read("Auth.User.username") ;
	            return $this->redirect(array('controller' => 'pages','action' => 'display'));
            }
        $this->Flash->error(__('Invalid username or password, try again'));
        }
    }
    
    public function logout() {
	    $this->Session->destroy();
        return $this->redirect($this->Auth->logout());
    }
    

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->loadModel('Administrator');
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				if($_SESSION['role']=='admin'){
					if($this->Administrator->save($this->request->data)){
						$this->Flash->success(__('The user has been saved.'));
						return $this->redirect(array('action' => 'index'));
					}else {
						$this->Flash->error(__('The user could not be saved. Please, try again.'));
					}
				}
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			//$options2 = array('conditions' => array('Administrator.' . $this->Administrator->foreingKey => $user_id));
			$this->request->data = $this->User->find('first', $options);
			if($this->request->data['User']['role']=='admin'):
				$this->request->data = $this->Administrator->find('first', array('conditions' => array('Administrator.user_id' => $id)));
			 endif;
		
		}
	
	}
	
	
		public function editrol($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);

		}
	
	}

	
	
	
	// public function editrol($id = null) {
	// 	if (!$this->User->exists($id)) {
	// 		throw new NotFoundException(__('Invalid user'));
	// 	}
	// 	$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
	// 	$this->set('user', $this->User->find('first', $options));
	// }
	
	
	/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('role', $this->roles);
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('controller'=>'pages','action' => 'display'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}
	

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
