<?php
App::uses('AppController', 'Controller');
/**
 * News Controller
 *
 * Este controllador contiene los metodos y componentes que se utilizaran para crear, editar,ver y eliminar noticias.
 *
 */
class NewsController extends AppController {
/**
 * Componentes
 *
 * Son los complementos que utilizaran los controllers que heredan de appController
 * 
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');
	
	
	/**
	 * beforeFilter method
	 * 
	 * Contiene los métodos a los cuales se permite llamar sin tener una sesión de usuario activa o sin los privilegios requeridos.
	 * 
	 * @param void
	 * @return void
	 */	
	public function beforeFilter() {
        parent::beforeFilter();
        //Métodos a los cuales se permite llamar
        $this->Auth->allow('logout', 'login', 'view','index');
    }

/**
 * index method
 *
 * Permite ingresar a la tabla que contiene a todos las noticias de la pagina web
 * 
 * @throws NotFoundException
 * @param void
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
 * Permite ver la lista completa de las noticias de la página web.
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
 * Permite agregar una nueva noticia a la página web.
 * 
 * @param void
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
 * Permite editar la información de una noticia previamente agregada.
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
 * Elimina una noticia de la página web especificada por $id.
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
