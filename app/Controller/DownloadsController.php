<?php 
class DownloadsController extends AppController{
    /**
 * Downloads Controller
 *
 * @property Helper $Html
 * @property Helper $Form
 */
    
  public $helpers=array('Html','Form');


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
      $this->loadModel('Category');
      //Carga el modelo de Category
    if ($this->request->is('post')) {
        $this->Download->create();
        //Revisa si el archivo ya fue creado, elimina los datos que hay para despues volverlo a crear
    if(empty($this->data['Download']['report']['name'])){
        unset($this->request->data['Download']['report']);
    }
    //Revisa si el archivo exite y lo crea
    if(!empty($this->data['Download']['report']['name'])){
       $file=$this->data['Download']['report'];
       $file['name']=$this->sanitize($file['name']);
       $this->request->data['Download']['report'] = time().$file['name'];
      
        if($this->Download->save($this->request->data)) {
            //Guarda el archivo en la ruta indicada
            move_uploaded_file($file['tmp_name'], APP . 'webroot/files/download' .DS. time().$file['name']);  
            return $this->redirect(array('controller'=>'Categories','action' => 'edit', $this->request->data['Download']['category_id']));
        
         }
     }
    $this->Session->setFlash(__('Unable to add your Report.'));
    }
 }
 
     /**
    * add2 method
    *Funcion que agregar un nuevo archivo a las base de datos
    * @return void
     */
      public function add2() {
          //La diferencia con el add anterior es la manera de hacer la redireccion
      $this->loadModel('Category');
         if ($this->request->is('post')) {
            $this->Download->create();
        //Revisa si el archivo ya fue creado, elimina los datos que hay para despues volverlo a crear
        if(empty($this->data['Download']['report']['name'])){
            unset($this->request->data['Download']['report']);
        }
        //Revisa si el archivo exite y lo crea
        if(!empty($this->data['Download']['report']['name'])){
           $file=$this->data['Download']['report'];
           $file['name']=$this->sanitize($file['name']);
           $this->request->data['Download']['report'] = time().$file['name'];
          
            if($this->Download->save($this->request->data)) {
                //Guarda el archivo en la ruta indicada
                move_uploaded_file($file['tmp_name'], APP . 'webroot/files/download' .DS. time().$file['name']);  
                return $this->redirect(array('controller'=>'Categories','action' => 'add'));
            
             }
         }
        $this->Session->setFlash(__('Unable to add your Report.'));
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
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Report'));
        }

        $Report = $this->Download->findById($id);
        if (!$Report) {
            throw new NotFoundException(__('Invalid Report'));
        }
        $this->set('Download', $Report);
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
    
    
 
} 
?>