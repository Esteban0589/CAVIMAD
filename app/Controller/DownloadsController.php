<?php 
class DownloadsController extends AppController{
  public $helpers=array('Html','Form');

  /*function to display all files details*/
  public function index() {
   $this->set('Downloads', $this->Download->find('all'));
        }
  
  /*function to add file record into the database */
  public function add() {
      $this->loadModel('Category');
    if ($this->request->is('post')) {
        //return debug($this->request->data);
        $this->Download->create();
    if(empty($this->data['Download']['report']['name'])){
        unset($this->request->data['Download']['report']);
    }
    if(!empty($this->data['Download']['report']['name'])){
       $file=$this->data['Download']['report'];
       $file['name']=$this->sanitize($file['name']);
       $this->request->data['Download']['report'] = time().$file['name'];
      
        if($this->Download->save($this->request->data)) {
            move_uploaded_file($file['tmp_name'], APP . 'webroot/files/download' .DS. time().$file['name']);  
            //$this->Session->setFlash(__('Your Report has been saved.'));
            return $this->redirect(array('controller'=>'Categories','action' => 'edit', $this->request->data['Download']['category_id']));
        
         }
     }
    $this->Session->setFlash(__('Unable to add your Report.'));
    }
 }
    
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