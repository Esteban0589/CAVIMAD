<?php
App::uses('AppController', 'Controller');
/**
 * Events Controller
 *
 * Este controllador contiene los metodos y componentes que se utilizaran para agregar, editar, ver y eliminar evento.
 *
 */
class EventsController extends AppController {

/**
 * Componentes
 *
 * Son los complementos que utilizaran los controllers que heredan de appController
 * 
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');
	
	public function beforeFilter() {
        parent::beforeFilter();
        //Métodos a los cuales se permite llamar
        $this->Auth->allow('logout', 'login', 'view','index');
    }

/**
 * view method
 * 
 * Metodo que permite ver una lista de todos los eventos
 *
 * @throws NotFoundException
 * @return void
 */
	public function index() {
		// $this->loadModel('NewsEventsPicture');
		// $this->set('pictures', $this->NewsEventsPicture->find('all'));
		 $this->Event->recursive = 1;
		 $this->set('events', $this->Paginator->paginate());
	}

/**
 * view method
 * 
 * Metodo para poder ver detalles de un evento específicado por $id
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->loadModel('NewsEventsPicture');
		//si el evento no existe retorna error
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Evento no valido'));
		}
		$picsEvents2=[];
		$picsEvents2rand=[];
		$picsEventsFinal=[];
		$picsEvents=$this->NewsEventsPicture->find('all', array('conditions'=>array('NewsEventsPicture.event_id'=>$id)));
		
		for($i=0; $i<count($picsEvents); $i++){
			array_push($picsEvents2, $picsEvents[$i]['NewsEventsPicture']);
		}
		
		if(count($picsEvents2)>5){
			$picsEvents2rand=array_rand($picsEvents2, 5);
			for($i=0; $i<count($picsEvents2rand); $i++){
				array_push($picsEventsFinal, $picsEvents2[$picsEvents2rand[$i]]);
			}
		}
		else{
			$picsEventsFinal=$picsEvents2;
		}
		// return debug($picsNewsFinal);
		$this->set('picsEventsFinal', $picsEventsFinal);

		$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
		$this->set('events', $this->Event->find('first', $options));
	}

/**
 * view method
 * 
 * Metodo que permite agregar eventos a la pagina web
 *
 * @return void
 */
	public function add() {
		$this->loadModel('NewsEventsPicture');

		if ($this->request->is('post')) {
			//return
			//debug($this->request->data);	
			$this->Event->create();
			if ($this->Event->save($this->request->data)) {
				$this->request->data['NewsEventsPicture']['0']['event_id']= $this->Event->id;
				//return debug($this->request->data['NewsEventsPicture']['0']);
				// guarda el nuevo  evento y notifica al usuario
				if($this->NewsEventsPicture->saveAll($this->request->data['NewsEventsPicture']['0'])){
					$this->Flash->success(__('El evento fue guardada correctamente.'));
				}
				// retorna error si no se puedo guardar y nofica al usuario
				else{
				$this->Flash->error(__('El evento no pudo ser agregado, intente nuevamente.'));
				}
				
				//redireciona al index
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('El evento no pudo ser agregado, intente nuevamente.'));
			}
		}
		
	}

/**
 * edit method
 * 
 * Metodo para editar la información interna de cada evento.
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		//si el evento no existe retorna error
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Evento no valido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			// guarda la edicion de evento y notifica al usuario
			if ($this->Event->save($this->request->data)) {
				$this->Flash->success(__('El evento fue actualizado correctamente.'));
				return $this->redirect(array('action' => 'index'));
				// retorna error si no se puedo guardar y nofica al usuario
			} else {
				$this->Flash->error(__('El evento no pudo ser actualizado, intente nuevamente.'));
			}
		} else {
			// carga las fotos de eventos y noticias de la base
			$this->loadModel('NewsEventsPicture');
			//si el evento no existe retorna error
			if (!$this->Event->exists($id)) {
				throw new NotFoundException(__('Evento no valido'));
			}
			$picsEvents2=[];
			$picsEvents2rand=[];
			$picsEventsFinal=[];
			$picsEvents=$this->NewsEventsPicture->find('all', array('conditions'=>array('NewsEventsPicture.event_id'=>$id)));
			
			for($i=0; $i<count($picsEvents); $i++){
				array_push($picsEvents2, $picsEvents[$i]['NewsEventsPicture']);
			}
			
			if(count($picsEvents2)>5){
				$picsEvents2rand=array_rand($picsEvents2, 5);
				for($i=0; $i<count($picsEvents2rand); $i++){
					array_push($picsEventsFinal, $picsEvents2[$picsEvents2rand[$i]]);
				}
			}
			else{
				$picsEventsFinal=$picsEvents2;
			}
			// return debug($picsNewsFinal);
			$this->set('picsEventsFinal', $picsEventsFinal);
			
			
			
			$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
			$this->request->data = $this->Event->find('first', $options);
		}
	}

/**
 * delete method
 * 
 * Metodo para eliminar evento especificado mediante $id
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Event->id = $id;
		//si el evento no existe retorna error
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->request->allowMethod('post', 'delete');
		// elimina de evento y notifica al usuario
		if ($this->Event->delete()) {
			$this->Flash->success(__('The event has been deleted.'));
			// retorna error si no se puedo eliminar y nofica al usuario
		} else {
			$this->Flash->error(__('The event could not be deleted. Please, try again.'));
		}
		//redireciona al index
		return $this->redirect(array('action' => 'index'));
	}
}
