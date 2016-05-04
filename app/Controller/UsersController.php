<?php			
//return $this->debugController($this->request->data);

App::uses('AppController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
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
	public $components = array('Paginator', 'Session','Flash');
	var $roles = array('Administrador' => 'Administrador','Colaborador' => 'Colaborador','Usuario' => 'Usuario','Editor' => 'Editor');
		
/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ( $_SESSION['role'] != 'Administrador'  ) {
			throw new NotFoundException(__('Usuario invalido.'));
		}
		$this->set('role', $this->roles);
		$this->User->recursive = 0;
		if($this->User->activated==0){	
			// $this->User=$this->User->FindByActivated(1);
			// $this->User->FindByActivated(1);
			// $this->set('users', $users = $this->User->find('all', array('conditions' => array('User.activated' => '1'))));
			$this->set('users', $this->Paginator->paginate());
		}
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
		$this->set('users', $users = $this->User->find('all', array('conditions' => array('User.role' => 'Colaborador'))));
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
		if ( $_SESSION['role'] == null  ) {
			throw new NotFoundException(__('Para esta sección es necesario estar registrado.'));
		}
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','logout', 'login', 'viewManagers','forgot_password', 'reset','activate');
    }


    public function login() {
    	if ( $_SESSION['role'] != null  ) {
			 $this->Flash->error(__('Su sesión ya esta activa.'));
			//throw new NotFoundException(__('Sesión activa.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
        if( !(empty($this->data))){
        	$var=$this->User->findByUsername($this->request->data['User']['username']);
        	
        	if($var['User']['activated']==true){
    	        // if($this->Auth->login() ){
    	        // 	$_SESSION['role'] = $this->Session->read("Auth.User.role") ;
		           // $_SESSION['username'] = $this->Session->read("Auth.User.username") ;
		           // return $this->redirect(array('controller' => 'pages','action' => 'display'));
    	        // }
    	        
    	        if($this->Auth->login() ){
    	            // Si se selecciona la opción para recordar
    	            if ($this->request->data['User']['remember_me'] == 1) {
    	                unset($this->request->data['User']['remember_me']);
    	                //Le hace un Hash al usuario y password
    	                $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
    	                //Escribe la cookie
    	                $this->Cookie->write('remember_me_cookie', $this->request->data['User'], true, '1 weeks'); //if user select remember me, the cookie will be saved in his browser for 1 week.
					}
    	        	$_SESSION['role'] = $this->Session->read("Auth.User.role") ;
		            $_SESSION['username'] = $this->Session->read("Auth.User.username") ;
		            return $this->redirect(array('controller' => 'pages','action' => 'display'));
				}
    	    	return $this->Flash->error(__('Usuario o contraseña invalida.'));
    	    }
    	    return $this->Flash->error(__('Usuario no activado.'));
        }
    }
    
    public function logout() {
	   	// Borra la cookie en caso de que exista
        $this->Cookie->delete('remember_me_cookie');
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
 
 public function debugController($id) {
		$this->request->data = $id;
	}
	
	public function edit($id = null) {
		$this->loadModel('Administrator');
		if ( $_SESSION['role'] == null  ) {
			throw new NotFoundException(__('Es necesario estar registrado para esta seccion.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		
		
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuario no valido'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			debug($this->request->data['User']);
			if ($this->User->saveAll($this->request->data['User'])) {
				if($_SESSION['role'] == 'Administrador' || $_SESSION['role'] == 'Colaborador') {
					$this->Administrator->saveAll($this->request->data['Administrator']);
				}
				$this->Flash->success(__('Los detalles de usuario han sido actualizados.'));
				return $this->redirect(array('action' => 'view',$id));
			} else {
				$this->Flash->error(__('El usuario no pudo ser actualizado, intente de nuevo'));
			}

		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			//$options2 = array('conditions' => array('Administrator.' . $this->Administrator->foreingKey => $user_id));
			$this->request->data = $this->User->find('first', $options);
		}
	
	}
	
	
		public function editrol($id = null) {

		if ( $_SESSION['role'] == null  ) {
			throw new NotFoundException(__('Es necesario estar registrado para esta seccion.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if($_SESSION['role']=='Administrador'){
			if ($this->request->is(array('post', 'put'))) {
				if ($this->User->saveAll($this->request->data)) {
					$this->Flash->success(__('El rol ha sido actualizado.'));
					return $this->redirect(array('action' => 'index', $id));
				} else {
					$this->Flash->error(__('El rol no se ha podido actualizar.'));
				}
	
			} else {
				$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
				//$options2 = array('conditions' => array('Administrator.' . $this->Administrator->foreingKey => $user_id));
				$this->request->data = $this->User->find('first', $options);
			}
			
		}
	
	}

	public function editactivated($id = null) {
		
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('Se cambio correctamente el estado de la cuenta.'));
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
		if ( $_SESSION['role'] != null  ) {
			throw new NotFoundException(__('Ya estás registrado.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		$this->set('role', $this->roles);
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				//Si el usuario creado no está activado.
				if ($this->User->activaded == 0){
					//Genera el link para activar cuenta.
					$key = Security::hash(CakeText::uuid(),'sha512',true);
					$hash=sha1(['User']['username'].rand(0,100));
	                $url = Router::url( array('action'=>'activate'), true ).'/'.$key.'#'.$hash;
	               	$this->User->saveField('tokenhash',$key);
	                $ms=$url;
	                $ms=wordwrap($ms,1000);
					//Envía el correo de activación de cuenta.
					 $data = array();
					 $user_data = array();
	                 $user_data['name'] = $this->request->data['User']['name'];
	                 $user_data['ms'] = $ms;
	                 $this->set('user_data', $user_data);  
	                        $data['to'] = $this->request->data['User']['email'];
	                        $data['subject'] = 'Activación de cuenta';
	                        $data['body'] = array('user_data' => $user_data);
	                        $data['template'] = 'activate_account';
	                        $output =$this->send_mail($data);
	
	                            if($output){
	                                $this->Flash->success(__('El usuario ha sido creado. Por favor verifique su correo electrónico para activar su cuenta.'));
	                          		return $this->redirect(array('controller'=>'pages','action' => 'display'));
	                            }
	                            else {
	                            	$this->Flash->set('Hubo un error al enviar el correo electrónico. Por favor intente nuevamente en unos minutos.');
	                            	delete_without_flash($this->request->data['User']['id']);
	                            	
	                            }
				}
			} 
			 else {
				$this->Flash->error(__('El usuario no pudo ser registrado. Por favor confirmar que los datos sean válidos.'));
			}
		}
	}
	
	//Permite activar un usuario en la base de datos a través de un link generado automáticamente.
	public function activate($token=null)
	{
		if ( $_SESSION['role'] != null  ) {
			throw new NotFoundException(__('Sesión activa.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		$this->User->recursive=-1;
        if(!empty($token))
        {
            $u=$this->User->findBytokenhash($token);
           if(!empty($u))
            {
                $this->User->data=$u;        
                if(!empty($this->User->data))
                {    
                	//Crea un nuevo token.
                    $new_hash=sha1($u['User']['username'].rand(0,100));					
                        
                    $this->User->data['User']['tokenhash']=$new_hash;
                    //Si no se ha activado el usuario en cuestión.
                    if($this->User->data['User']['activated'] == (false)) 
                    {
                    	
                        $this->User->data['User']['activated'] = (true);   
                        if($this->User->data['User']['activated'] == (true))
                        {
                        	//Actualiza el usuario para que su estado sea activo.	
                           	if ($this->User->updateAll(array('User.activated' => 1), array('User.username' => $u['User']['username']))){
                           		$this->Flash->success(__('Se activó su cuenta correctamente.'));
                           		$this->User->updateAll(array('User.tokenhash' => NULL), array('User.username' => $u['User']['username']));
								return $this->redirect(array('controller' => 'pages','action' => 'display'));
                           	} else {
								$this->Flash->error(__('El usuario no pudo ser activado, intente de nuevo'));
							}
                            // $this->Flash->set('Se activó su cuenta correctamente.');
                            // return $this->redirect(array('action'=>'login'));
                        }
                    }
                    else{
                        $this->Flash->set('errors',$this->User->invalidFields());
                        return $this->redirect(array('action'=>'login'));
                        }
                }
            }
            else
            {
                 $this->Flash->set('Token corrupto. Por favor revise su enlace autogenerado. El enlace solo funciona una única vez.');
                 return $this->redirect(array('action'=>'login'));
            }
        }
        else
        {
            $this->Flash->set('Token inválido, intente de nuevo.');
            $this->redirect(array('action'=>'login'));
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
		if ( $_SESSION['role'] != 'Administrador'  ) {
			throw new NotFoundException(__('Sesión activa.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Usuario inválido.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('El usuario fue eliminado.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	//Envía un correo eléctronico según la plantilla deseada.
	
	public function send_mail($email_data = null)
	{
		$Email = new CakeEmail();
        $Email->config('gmail');
        $Email_to = $email_data['to'];
		$Email_subject = $email_data['subject'];
		$Email_template = $email_data['template'];
		
		$Email->to($email_data['to']);
		$Email->subject($email_data['subject']);
		$Email->template('$Email_template');
		$Email->from('cavimad@noreply.com');
		$Email->template($email_data['template']);
		//Los parámetros para envíos pueden ser un arreglo o parámetro simple. En caso de querer actualizar los datos enviados (variables), actualizar este 
		//código.
		if (!empty($email_data['body']['user_data']))
		{
			$Email->viewVars (array('user_data' => $email_data['body']['user_data']));
		}
		else
		{
			$Email->viewVars (array('ms' => $email_data['body']['ms']));
		}
		$Email-> emailFormat ('html');
		if ($Email->send())   
            {
            return true;
            } else {
            echo $this->Email->smtpError;
            }
	}
	
	
	//Genera un token y envía un correo electrónico para reiniciar la contraseña.
	public function forgot_password()
	{
		if ( $_SESSION['role'] != null  ) {
			throw new NotFoundException(__('Sesión activa.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
        $this->User->recursive=-1;
        //Si los datos ingresados no son vacíos.
        if(!empty($this->data))
        {
            if(empty($this->data['User']['email']))
            {
                 $this->Flash->set('Por favor ingrese su dirección de correo electrónico con la cual se registró.');
            }
            else
            {
                $email=$this->data['User']['email'];
                //Busca el correo en la tabla de usuarios.
                $fu = $this->User->find('first', array('conditions' => array('User.email' => $email)));
                //Si existe el usuario                        
                if($fu)
                {
                    //Y está activo.
                    if($fu['User']['activated']=='1')
                    {
                    	//Genera un hash para concatenarselo a un link.
                        $key = Security::hash(CakeText::uuid(),'sha512',true);
                        $hash=sha1($fu['User']['username'].rand(0,100));
                        $url = Router::url( array('controller'=>'Users','action'=>'reset'), true ).'/'.$key.'#'.$hash;
                        $ms=$url;
                        
                        
                        
                        $ms=wordwrap($ms,1000);
                        
                        $fu['User']['tokenhash']=$key;
                        $this->User->id=$fu['User']['id'];
                
                        //Guarda el hash en la base de datos.
                        if($this->User->saveField('tokenhash',$fu['User']['tokenhash']))
                        {                        
                        //Parámetros para enviar el correo eletrónico.
                        $this->set('ms', $ms);    
                                                                    
                        $data = array();
                        $data = array();
                        $user_data = array();
		                $user_data['name'] = $fu['User']['name'];
		                $user_data['ms'] = $ms;
                        $this->set('user_data', $user_data);  
	                        
            
                        $data['to'] = $fu['User']['email'];
                        $data['subject'] = 'Reinicio de contraseña';
                        $data['body'] = array('user_data' => $user_data);
                        $data['template'] = 'reset_password';
                        $output =$this->send_mail($data);

                            if($output){
                                $this->Flash->set('Correo electrónico enviado correctamente.');
                                $this->redirect(array('controller'=>'users','action'=>'login'));
                            }
                            else {
                            	$this->Flash->set('Hubo un error al enviar el correo electrónico. Por favor intente nuevamente en unos minutos.');
                            }
                        }
                        else{
                             $this->Flash->set("Error al generar enlace para reinicio de contraseña.");
                        }
                    }
                    else
                    {
                         $this->Flash->set('La cuenta aún no está activada, por favor proceda a activar su cuenta.');
                    }
                }
                else
                {
                     $this->Flash->set('Correo electrónico no encontrado.');
                }
            }
        }    
	}
	
 	//Reinicia la contraseña según un hash agregado anteriormente.
 	public function reset($token=null)
 	{
         if ( $_SESSION['role'] != null  ) {
			throw new NotFoundException(__('Sesión activa.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}    
         $this->User->recursive=-1;
         //Si existe el token.
         if(!empty($token))
         {
         	 //Busque el usuario según el token obtenido a través del link.
             $u=$this->User->findBytokenhash($token);
             //Si el usuario existe.
             if(!empty($u))
             {
                 $this->User->id=$u['User']['id'];        
                 
                 if(!empty($this->data))
                 {    
                     $this->User->data=$this->data;
                     $this->User->data['User']['username']=$u['User']['username'];
                     $new_hash=sha1($u['User']['username'].rand(0,100));					//Crea un nuevo token
                         
                     $this->User->data['User']['tokenhash']=$new_hash;
                     
                     //Si los passwords ingresados son iguales.
                     if($this->User->validates(array('fieldList' => array('password', 'password_confirm'))))
                     {
                         //Actualiza el usuario con la nueva contraseña.                   
                         if($this->User->save($this->User->data))
                         {
                             $this->Flash->set('La contraseña ha sido actualizada.');
                             $this->User->updateAll(array('User.tokenhash' => NULL), array('User.username' => $u['User']['username']));
                             $this->redirect(array('controller'=>'users','action'=>'login'));
                         }
                     }
                     else{
                         $this->Flash->set('errors',$this->User->invalidFields());
                         }
                 }
             }
             else
             {
                  $this->Flash->set('Token corrupto. Por favor revise su enlace autogenerado. El enlace solo funciona una única vez.');
                  $this->redirect(array('controller'=>'users','action'=>'login'));
             }
         }
         else
         {
             $this->Flash->set('Token inválido, intente de nuevo.');
             $this->redirect(array('controller'=>'users','action'=>'login'));
         }
     
 	}
 	
 	//Método que permite a un usuario cambiar su contraseña.
 	public function new_password()
 	{
 		$this->User->recursive=-1;
        $passwordHasher = new BlowfishPasswordHasher();
        //Hashea la nueva contraseña.
	   	$pass1 = $passwordHasher->hash(
	            $this->request->data['User']['new_password']);
	    //Crea una contraseña hasheada con respecto al key utilizado en la nueva contraseña ($pass1).
	    $pass2 = Security::hash($this->request->data['User']['repeat_password'],'blowfish',$pass1);
 		//Compara que las contraseña ingresada por el usuario sea igual a la almacenada por la base de datos.
 		$pass=$this->User->find('first', array('conditions' => array('User.username' => $_SESSION['username'])));
 		
 		//Contraseña ya hasheada para comparar por la existente en la base de datos.
 		$pass40=Security::hash($this->request->data['User']['actual_password'],'blowfish',$pass['User']['password']);
 		//Compara la cotraseña ingresada con la que se encuentra almacenada en la base de datos.
 		if($pass40 == $pass['User']['password'])
 		{
 			//Compara que las contraseñas ingresadas por el usuario sean iguales.
 			if($pass1 == $pass2)
 			{

 				$this->User->id = $pass['User']['id'];
 				if($this->User->savefield('password',$this->request->data['User']['repeat_password']))
 				{
                    $this->Flash->success(__('La contraseña ha sido actualizada.'));
					return $this->redirect(array('action' => 'edit',$pass['User']['id']));
 				}
 				 else 
 				 {
					$this->Flash->error(__('Imposible actualizar la contraseña. Contacte al administrador del sitio.'));
					return $this->redirect(array('action' => 'edit',$pass['User']['id']));
 				 }
 			}
 			else
 			{
 				$this->Flash->error(__('Las contraseñas ingresadas no son iguales.'));
				return $this->redirect(array('action' => 'edit',$pass['User']['id']));
 			}
 		}
 		else
 		{
 				$this->Flash->error(__('La contraseña ingresada no es igual a la almacenada en el sistema.'));
 				return $this->redirect(array('action' => 'edit',$pass['User']['id']));
 		}
 		
 	}
 	
	
}
