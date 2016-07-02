<?php
App::uses('AppController', 'Controller');
/**
 * News Controller
 *
 * @property News $News
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class NewsController extends AppController {

/**
 * Components
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
 * index method
 *
 * @return void
 */
	public function index() {
		// $this->loadModel('NewsEventsPicture');
		// $this->set('pictures', $this->NewsEventsPicture->find('all'));
		 $this->News->recursive = 1;
		 $this->set('news', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		// si la iamgen no existe retorna error
		$this->loadModel('NewsEventsPicture');
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Noticia no valida'));
		}
		// carga las imagenes segun el id
		$picsNews2=[];
		$picsNews2rand=[];
		$picsNewsFinal=[];
		$picsNews=$this->NewsEventsPicture->find('all', array('conditions'=>array('NewsEventsPicture.news_id'=>$id)));
		
	
		for($i=0; $i<count($picsNews); $i++){
			array_push($picsNews2, $picsNews[$i]['NewsEventsPicture']);
		}
		
		if(count($picsNews2)>5){
			$picsNews2rand=array_rand($picsNews2, 5);
			for($i=0; $i<count($picsNews2rand); $i++){
				array_push($picsNewsFinal, $picsNews2[$picsNews2rand[$i]]);
			}
		}
		else{
			$picsNewsFinal=$picsNews2;
		}
		// return debug($picsNewsFinal);
		$this->set('picsNewsFinal', $picsNewsFinal);

		$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
		$this->set('news', $this->News->find('first', $options));
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
			$this->News->create();
			// guarla la nueva noticia agrega y notifica al usuario
			if ($this->News->save($this->request->data)) {
				$this->request->data['NewsEventsPicture']['0']['news_id']= $this->News->id;
				//return debug($this->request->data['NewsEventsPicture']['0']);
				if($this->NewsEventsPicture->saveAll($this->request->data['NewsEventsPicture']['0'])){
					$this->Flash->success(__('La noticia fue guardada correctamente.'));
				}
				// sino puede guardar la noticia notifica al usuario
				else{
				$this->Flash->error(__('La noticia no pudo ser agregada, intente nuevamente.'));
				}
				
				
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('La noticia no pudo ser agregada, intente nuevamente.'));
			}
		}
		else{
			$position = array(0 => 'Omitir comentario de imagen',1 => 'Abajo a la derecha',2 => 'Abajo a la izquierda');
			$this->set('position',$position);
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
		// si la iamgen no existe retorna error
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Noticia no valida'));
		}
		if ($this->request->is(array('post', 'put'))) {
			//se guarda la noticia actualizada y notifica al usuario
			if ($this->News->save($this->request->data)) {
				$this->Flash->success(__('La noticia fue actualizada correctamente.'));
				return $this->redirect(array('action' => 'index'));
				// de no poder guardarse notifica al usuario
			} else {
				$this->Flash->error(__('La noticia no pudo ser actualizada, intente nuevamente.'));
			}
		} else {
			
			
			$this->loadModel('NewsEventsPicture');
			// carga las imagenes de eventos y noticias
			$picsNews2=[];
			$picsNews2rand=[];
			$picsNewsFinal=[];
			$picsNews=$this->NewsEventsPicture->find('all', array('conditions'=>array('NewsEventsPicture.news_id'=>$id)));
			
		
			for($i=0; $i<count($picsNews); $i++){
				array_push($picsNews2, $picsNews[$i]['NewsEventsPicture']);
			}
			
			if(count($picsNews2)>5){
				$picsNews2rand=array_rand($picsNews2, 5);
				for($i=0; $i<count($picsNews2rand); $i++){
					array_push($picsNewsFinal, $picsNews2[$picsNews2rand[$i]]);
				}
			}
			else{
				$picsNewsFinal=$picsNews2;
			}
			// return debug($picsNewsFinal);
			$this->set('picsNewsFinal', $picsNewsFinal);
			
			
			$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
			$this->request->data = $this->News->find('first', $options);
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
		$this->News->id = $id;
		// si la noticia no existe retorna error
		if (!$this->News->exists()) {
			throw new NotFoundException(__('Noticia no valida'));
		}
		$this->request->allowMethod('post', 'delete');
		// elimina la noticia y notifica al usuario
		if ($this->News->delete()) {
			$this->Flash->success(__('La noticia fue eliminada.'));
			// si no puede ser eliminada retorna error y notifica al usuario
		} else {
			$this->Flash->error(__('La noticia no pudo ser eliminada, intente nuevamente.'));
		}// redirige al index
		return $this->redirect(array('action' => 'index'));
	}
}
