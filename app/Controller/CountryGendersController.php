<?php
App::uses('AppController', 'Controller');
/**
 * CountryGenders Controller
 * 
 * Metétodos del controlador CountryGender que se encarga del manejo de los países relacionados con los géneros
 *
 * @property CountryGender $CountryGender
 * @property PaginatorComponent $Paginator
 */
class CountryGendersController extends AppController {

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
	 * Indexa todos los países pertenecientes a los géneros.
	 * 
	 * @param void
	 * @return void
	 */
	public function index() {
		$this->CountryGender->recursive = 0;
		$this->set('countryGenders', $this->Paginator->paginate());
	}

	/**
	 * view method
	 * 
	 *	Muestra una vista por cada tupla en caso de ser necesaria.
	 * 
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		// si el pais no existe retorna error
		if (!$this->CountryGender->exists($id)) {
			throw new NotFoundException(__('Invalid country gender'));
		}
		$options = array('conditions' => array('CountryGender.' . $this->CountryGender->primaryKey => $id));
		$this->set('countryGender', $this->CountryGender->find('first', $options));
	}

	/**
	 * add method
	 * 
	 *	Permite añadir una nueva tupla a la tabla.
	 * 
	 * @param void
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CountryGender->create();
			// agrega un pais del genero
			if ($this->CountryGender->save($this->request->data)) {
				$this->Flash->success(__('The country gender has been saved.'));
				return $this->redirect(array('action' => 'index'));
				//  de no poder gusrdar el dato notifica al usuario
			} else {
				$this->Flash->error(__('The country gender could not be saved. Please, try again.'));
			}
		}
	}

	/**
	 * edit method
	 * 
	 *	Permite editar alguna tupla de la tabla CountryGender.
	 * 
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		// si el pais no existe retorna error
		if (!$this->CountryGender->exists($id)) {
			throw new NotFoundException(__('Invalid country gender'));
		}
		// guarda los cambios de la edicion de un pais de genero
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CountryGender->save($this->request->data)) {
				$this->Flash->success(__('The country gender has been saved.'));
				return $this->redirect(array('action' => 'index'));
				//  de no poder gusrdar el dato notifica al usuario
			} else {
				$this->Flash->error(__('The country gender could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CountryGender.' . $this->CountryGender->primaryKey => $id));
			$this->request->data = $this->CountryGender->find('first', $options);
		}
	}

	/**
	 * delete method
	 * 
	 *	Elimina una tupla de la tabla correspondiente.
	 * 
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->CountryGender->id = $id;
		// si el pais no existe retorna error
		if (!$this->CountryGender->exists()) {
			throw new NotFoundException(__('Invalid country gender'));
		}// elimina los datos de un pais de genero
		$this->request->allowMethod('post', 'delete');
		if ($this->CountryGender->delete()) {
			$this->Flash->success(__('The country gender has been deleted.'));
			//  de no poder gusrdar el dato notifica al usuario
		} else {
			$this->Flash->error(__('The country gender could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
}
