<?php 
App::uses('AppController', 'Controller');
class DownloadsController extends AppController{
/**
 * Downloads Controller
 *
 * @property Download $Download
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
  public $helpers=array('Html','Form');
  public $components = array('Paginator', 'Flash', 'Session');


    public function beforeFilter() {
        parent::beforeFilter();
        //Métodos a los cuales se permite llamar
        $this->Auth->allow('index','logout', 'login');
    }

/**
 * index method
 *
 * @return void
 */
  /*function to display all files details*/
  public function index() {
      //Carga los datos desde la base da datos 
   $this->set('Downloads', $this->Download->find('all'));
        }
  
 /**
 * add method
 *Funcion que agregar un nuevo archivo a las base de datos
 * @return void
 */
     public function add() {
      //Carga el modelo de Category
       $this->loadModel('User');
      	$this->loadModel('Administrator');
      	$adm_id=$this->Administrator->find('first',array('conditions' => array('Administrator.user_id'=>$_SESSION['Auth']['User']['id'])));
		//return debug($adm_id);
        if ($this->request->is('post')) {
             //return debug($this->request->data);
            $this->Download->create();
            //Revisa si el archivo ya fue creado, elimina los datos que hay para despues volverlo a crear
        if(empty($this->data['Download']['report']['name'])){
            unset($this->request->data['Download']['report']);
        }
        //Revisa si el archivo exite y lo crea
        if(!empty($this->data['Download']['report']['name'])){
           
           $data =array('Download'=>array('title'=>$this->request->data['Download']['title'],
                                          'description'=>$this->request->data['Download']['description'],
                                          'abstract'=>$this->request->data['Download']['abstract'], 
                                          'report'=>$this->request->data['Download']['report'], 
                                          'administrator_id'=> $adm_id['Administrator']['id'],
                                          'name'=>$this->request->data['Download']['report']['name']));
            //return debug($this->request->data);

              $file=$this->request->data['Download']['report'];
                $file['name']=$this->sanitize($file['name']);
                $data['Download']['report'] = time().$file['name'];
                
               
                
                
            if($this->Download->save($data)) {
                //Guarda el archivo en la ruta indicada
                move_uploaded_file($file['tmp_name'], APP . 'webroot/files/download' .DS. $data['Download']['report']); 
                $this->Flash->success(__('El documento se guardo correctamente.'));
                return $this->redirect(array('controller'=>'downloads','action' => 'index'));
            
             }
         }else{
            $this->Flash->error(__('El documento no se pudo guardar. Intentelo nuevamente.'));
        }
            
        }
     }
     
 
    /**
    * sanitize method
    *
    * Restringe el acceso al documento
    * @throws NotFoundException
    * @param string $string
    * @param string $force_lowercase
    * @param string $anal
    * @return void
    */
    
    function sanitize($string, $force_lowercase = true, $anal = false) {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]","}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;","â€”", "â€“", ",", "<",">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
    
    /**
     * view method
     *
     * @throws NotFoundException
     * Funcion que descarga los archivos ya creados en la base de datos
     * @param string $id
     * @param string $download
     * @return void
     */
    public function viewdown($id=null,$download=false) {
     if($download){
      $download=true;
     }
      $files=$this->Download->findById($id);
      $filename=$files['Download']['report'];
      $name=explode('.',$filename);
      $this->viewClass = 'Media';
     
      // path will be app/outsidefiles/yourfilename.pdf
      $params = array(
            'id'        => $filename,
            'name'      => $name[0],
            'download'  => $download,
            'extension' => 'pdf',
            'path'      => APP . 'webroot/files/download' . DS
        );
        
     $this->set($params);
    }
    
    
        
    /**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function edit($id = null) {
		if (!$this->Download->exists($id)) {
			throw new NotFoundException(__('Invalid download'));
		}
		if ($this->request->is(array('post', 'put'))) {
		   // return debug($this->request->data);
           $data =array('Download'=>array('id'=>$id,
               'title'=>$this->request->data['Download']['title'],
                                          'description'=>$this->request->data['Download']['description'],
                                          'abstract'=>$this->request->data['Download']['abstract'],
                                          'name'=>$this->request->data['Download']['report']['name'],
                                          'report'=>$this->request->data['Download']['report']
                                          ));
            $file=$this->data['Download']['report'];
            $file['name']=$this->sanitize($file['name']);
            $data['Download']['report']=time().$file['name'];
			if ($this->Download->save($data)) {

			    move_uploaded_file($file['tmp_name'], APP . 'webroot/files/download' .DS. $data['Download']['report']); 
				$this->Flash->success(__('El documento se guardo correctamente.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				 $this->Flash->error(__('El documento no se pudo guardar. Intentelo nuevamente.'));
			}
		} else {
			$options = array('conditions' => array('Download.' . $this->Download->primaryKey => $id));
			$this->request->data = $this->Download->find('first', $options);
		}
	}
	
//}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Download->id = $id;
		if (!$this->Download->exists()) {
			throw new NotFoundException(__('Invalid download'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Download->delete()) {
			$this->Flash->success(__('El documento se elimino correctamente.'));
		} else {
			$this->Flash->error(__('El documento no se pudo eliminar. Intentelo de nuevo'));
		}
		return $this->redirect(array('action' => 'index'));
	}
    
 
} 
?>