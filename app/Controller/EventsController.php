<?php
App::uses('AppController', 'Controller');
/**
 * Events Controller
 *
 * @property Event $Event
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class EventsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

/**
 * index method
 *
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
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->loadModel('NewsEventsPicture');
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
 * add method
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
				$this->request->data['NewsEventsPicture']['0']['envent_id']= $this->Event->id;
				//return debug($this->request->data['NewsEventsPicture']['0']);
				if($this->NewsEventsPicture->saveAll($this->request->data['NewsEventsPicture']['0'])){
					$this->Flash->success(__('El evento fue guardada correctamente.'));
				}
				else{
				$this->Flash->error(__('El evento no pudo ser agregado, intente nuevamente.'));
				}
				
				
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('El evento no pudo ser agregado, intente nuevamente.'));
			}
		}
		
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Evento no valido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Event->save($this->request->data)) {
				$this->Flash->success(__('El evento fue actualizado correctamente.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('El evento no pudo ser actualizado, intente nuevamente.'));
			}
		} else {
			$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
			$this->request->data = $this->Event->find('first', $options);
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
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Event->delete()) {
			$this->Flash->success(__('The event has been deleted.'));
		} else {
			$this->Flash->error(__('The event could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
