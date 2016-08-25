<?php			

App::uses('AppController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * Users Controller
 * 
 * Esta clase contiene los métodos para la crear, editar, ver y eliminar usuarios.
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	/**
	 * Components
	 * 
	 * Contine los componentes del controlador, en este caso el paginador, flash para mensajes y el de sesión para el manejo de usuarios.
	 *
	 * @var array
	 */
	public $components = array('Paginator', 'Session','Flash');
	
	/**
	 * Roles
	 * 
	 * Arreglo con los tipos de rol que se manejarán para los usuarios
	 * @var array
	 */
	var $roles = array('Administrador' => 'Administrador','Colaborador' => 'Colaborador','Usuario' => 'Usuario','Editor' => 'Editor');
	
	/**
	 * beforeFilter method
	 * 
	 * Contiene los métodos a los cuales se permite llamar sin tener una sesión de usuario activa.
	 *
	 * @return void
	 */	
    public function beforeFilter() {
        parent::beforeFilter();
        //Métodos a los cuales se permite llamar
        $this->Auth->allow('add','userdesha','logout', 'login', 'view_colaboradores','forgot_password', 'reset','activate','buscador','about','contact','form_contact');
    }
    
    
    /**
	 * userdesha method
	 * 
	 * Función que maneja el control usuarios recien deshabilitados, pero conectados.
	 *
	 * @return void
	 */
    public function userdesha() {
	   	// Borra la cookie en caso de que exista
        $this->Cookie->delete('remember_me_cookie');
        // Borra las variables de sesion
	    $this->Session->destroy();
        $this->Flash->error(__('Usuario deshabilitado. Por favor contactar al administrador.'));;
    }
    
    
    
	/**
	 * index method
	 * 
	 * Devuelve todos los usuarios que existen en la base de datos.
	 *
	 * @throws NotFoundException
	 * @return void
	 */
	public function index() {
		//Se revisa si existe una sesión activa, y si el usuario es administrador
		if ( (!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role'] != 'Administrador' ) ) {
			//Si el usuario no es un administrador no se le permite el acceso
			throw new NotFoundException(__('Usuario inválido.'));
		}
		// Controla el acceso de los usuarios habilitados o deshabilitados.
		// En caso de usuarios deshabilitados, los deslogea y los redirige a otra pagina.
		if($this->User->findById($_SESSION['Auth']['User']['id'])['User']['activated']!=1){
			return $this->redirect(array('controller' => 'users','action' => 'userdesha'));
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
	 * controlPanel
	 * 
	 * Obtiene toda la informacion requerida para que el administrador pueda administrar la pagina web
	 *
	 * @throws NotFoundException
	 * @return void
	 */
	public function controlpanel() {
		if ( (!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role'] != 'Administrador' ) ) {
			//Si el usuario no es un administrador no se le permite el acceso
			throw new NotFoundException(__('Usuario inválido.'));
		}
		// Controla el acceso de los usuarios habilitados o deshabilitados.
		// En caso de usuarios deshabilitados, los deslogea y los redirige a otra pagina.
		if($this->User->findById($_SESSION['Auth']['User']['id'])['User']['activated']!=1){
			return $this->redirect(array('controller' => 'users','action' => 'userdesha'));
		}
	}


	/**
	 * viewColaboradores method
	 * 
	 * Devuelve la lista de colaboradores de la página.
	 *
	 * @return void
	 */
	public function view_colaboradores() {
		// Controla el acceso de los usuarios habilitados o deshabilitados.
		
		//se carga el modelo Administrator para manipular el arreglo correspondiente
		$this->loadModel('Administrator');
		clearCache();
		//$this->User->recursive = 0;
		//Se guarda en $users la búsqueda de los usuarios que tienen role = 'Colaborador', y se envían a la vista lo susuarios encontrados dentro de 'users'
		$this->set('users', $users = $this->User->find('all', array('conditions' => array('User.role' => 'Colaborador'))));
		//Se buscan los datos correspondientes al modelo Administrator que le corresponden a los colaboradores, y se envían a la vista a través de 'colaboradores'
		$this->set('colaboradores', $colaboradores = $this->Administrator->find('all'));
	}
	
	/**
	 * view method
	 * 
	 * Permite recuperar los datos de un usuario en específico.
	 *
	 * @throws NotFoundException
	 * @param string $id - Contiene el id del usuario que se va a desplegar.
	 * @return void
	 */
	public function view($id = null) {
		//Se revisa primero si hay una sesión activa
		if ( (!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role'] == null)  ) {
			//Si no hay una sesión activa, no se le permite continuar a ver los datos de algún usuario
			throw new NotFoundException(__('Para esta sección es necesario estar registrado.'));
		}
		// Controla el acceso de los usuarios habilitados o deshabilitados.
		// En caso de usuarios deshabilitados, los deslogea y los redirige a otra pagina.
		if($this->User->findById($_SESSION['Auth']['User']['id'])['User']['activated']!=1){
			return $this->redirect(array('controller' => 'users','action' => 'userdesha'));
		}
		//Si el usuario a buscar no existe se notifica mediante un mensaje de error
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuario no válido'));
		}
		//Se busca el usuario mediante el $id recibido
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		//Se envían a la vista los datos correspondientes al usuario buscado
		$this->set('user', $this->User->find('first', $options));
	}


	/**
	 * login method
	 * 
	 * Función que maneja el control de inicio de sesión
	 *
	 * @return void
	 */
    public function login() {
    	//Se revisa primero en la variable $_SESSION si ya hay una sesión activa
    	if ( (!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role'] != null  )) {
    		//Si ya hay una sesión activa, se le notifica al usuario que ya ha iniciado sesión
			$this->Flash->error(__('Su sesión ya está activa.'));
			//Se le redirige al home de la página
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		//Primero se chequea que 'data' no esté vacío
        if( !(empty($this->data))){
        	//Se guarda en $var el usuario recuperado a partir del 'username' solicitado en 'data'
        	$var=$this->User->findByUsername($this->request->data['User']['username']);
        	//Se revisa si el usuario buscado ya ha sido debidamente activado
        	if($var['User']['activated']==1){
 
  	        	//Se procede a realizar el login mediante Auth
    	        if($this->Auth->login() ){
    	            // Si se selecciona la opción para recordar
    	            if ($this->request->data['User']['remember_me'] == 1) {
    	                unset($this->request->data['User']['remember_me']);
    	                //Le hace un Hash al usuario y password
    	                $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
    	                //Escribe la cookie
    	                $this->Cookie->write('remember_me_cookie', $this->request->data['User'], true, '1 weeks'); //if user select remember me, the cookie will be saved in his browser for 1 week.
					}
					//Se guarda en $_SESSION el rol del usuario que ha iniciado sesión
    	        	//$this->Session->read('Auth')['User']['role'] = $this->Session->read("Auth.User.role") ;
    	        	//Se guarda en $_SESSION el username del usuario que ha iniciado sesión
		            $_SESSION['username'] = $this->Session->read("Auth.User.username") ;
		            //Se procede a redirigir al home de la página
		            return $this->redirect(array('controller' => 'pages','action' => 'display'));
				}
				//Si el login falla se le notifica al usuario que algún dato es inválido
    	    	return $this->Flash->error(__('Usuario o contraseña inválida.'));
    	    }
    	    //Si el usuario no ha sido acivado previo al login, se le notifica mediante un error
    	    return $this->Flash->error(__('Usuario no activado o deshabilitado. Si el problema persiste, contactar al administrador.'));
        }
    }
    
    /**
	 * logout method
	 * 
	 * Función que maneja el control de cierre de sesión
	 *
	 * @return void
	 */
    public function logout() {
	   	// Borra la cookie en caso de que exista
        $this->Cookie->delete('remember_me_cookie');
        // Borra las variables de sesion
	    $this->Session->destroy();
        return $this->redirect($this->Auth->logout());
    }
 
	public function debugController($id) {
			$this->request->data = $id;
	}
	
  /**
      * edit method
      * Este método modifica el perfil de usuario.
      *
      * @throws NotFoundException
      * @param string $id Recibe el $id del usuario.
      *
      * @return void
      */
	public function edit($id = null) {
		//Se carga el modelo Administrator
		$this->loadModel('Administrator');
		//Se verifica si el usuario ha ingresado sesión
		if ( (!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role'] == null)  ) {
			//Si no hay una sesión activa, no se le permite continuar
			throw new NotFoundException(__('Es necesario estar registrado para esta seccion.'));
			//Se le redirige al home de la página
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		
		//Si revis si el usuario a buscar existe
		if (!$this->User->exists($id)) {
			//Si el usuario no existe se tira la siguiente excepción
			throw new NotFoundException(__('Usuario no válido'));
		}
		// Controla el acceso de los usuarios habilitados o deshabilitados.
		// En caso de usuarios deshabilitados, los deslogea y los redirige a otra pagina.
		if($this->User->findById($this->Session->read('Auth')['User']['id'])['User']['activated']!=1){
			return $this->redirect(array('controller' => 'users','action' => 'userdesha'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			
			
			$email = $this->User->findById($this->request->data['User']['id']);
			//Si el correo a guardar no se modifica
			if($this->request->data['User']['email'] == $email['User']['email'])
			{
				unset($this->request->data['User']['email']);
			}
			//unset($this->request->data['Administrator'][0]['id']);
				//Se guardan los datos correspondientes al usuario
				if ($this->User->saveAll($this->request->data['User'])) {
					//Se chequea si el usuario es un administrador o un colaborador
					if($this->Session->read('Auth')['User']['role'] == 'Administrador' || $this->Session->read('Auth')['User']['role'] == 'Colaborador') {
						$prueba = $this->request->data['Administrator'][0];
						//debug($prueba);
						//En este caso se guardan también los datos correspondientes al modelo Administrator
						$this->Administrator->saveAll($prueba);
						// $this->Administrator->updateAll(array('Administrator.specialty' => $this->request->data['Administrator'][0]['specialty']),
						// 								array('Administrator.publication' => $this->request->data['Administrator'][0]['publication']),
						// 								array('Administrator.curriculum' => $this->request->data['Administrator'][0]['curriculum'])
						// 							);
					}
					//Se notifica que los cambios han sido realizados
					$this->Flash->success(__('Los detalles de usuario han sido actualizados.'));
					//Se redirige a la vista view del usuario en la sesión activa
					return $this->redirect(array('action' => 'view',$id));
				} else {
					//En el caso de que no se puedan guardar los datos, se notifica mediante un error
					$this->Flash->error(__('El usuario no pudo ser actualizado, intente de nuevo'));
				}
			
			

			

		} else {
			//Vuelve a cargar el usuario.
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	
	}
	
	/**
	 * editrol method
	 *
	 * Función para realizar el cambio de rol de un usuario registrado.
	 * 
	 * @throws NotFoundException
	 * @param string $id - Contiene el id del usuario que se le va a editar el rol.
	 * @return void
	 */
	public function editrol($id = null) {
		//Se verifica que exista una sesión activa
		if ( (!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role'] == null ) ) {
			//Se maneja la excepción en caso de que no haya un usuario en la sesión
			throw new NotFoundException(__('Es necesario estar registrado para esta sección.'));
			//Se redirige al home de la página
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		//Se chequea que el usuario a buscar existe
		if (!$this->User->exists($id)) {
			//Caso contrario se llama a la excepción
			throw new NotFoundException(__('Usuario no válido'));
		}
		// Controla el acceso de los usuarios habilitados o deshabilitados.
		// En caso de usuarios deshabilitados, los deslogea y los redirige a otra pagina.
		if($this->User->findById($_SESSION['Auth']['User']['id'])['User']['activated']!=1){
			return $this->redirect(array('controller' => 'users','action' => 'userdesha'));
		}
		
		//Primero se verigica que el usuario en la sesión activa tenga un rol de administrador
		if((!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role']=='Administrador')){
			if ($this->request->is(array('post', 'put'))) {
				if($this->User->findById($this->request->data['User']['id'])['User']['activated']==2){
					//Se notifica que se han realizado los cambios
					$this->Flash->error(__('El rol no ha sido actualizado ya que el usuario está deshabilitado.'));
					return $this->redirect(array('action' => 'index', $id));
				}
				//Se guardan los datos del usuario
				$this->loadModel('Logbook');
				$dateNow = new DateTime('now', new DateTimeZone('America/Costa_Rica'));
				$invDate = $dateNow->format('Y-m-d H:i:s');
				$data = array('Logbook' => array('user_id' => $_SESSION['Auth']['User']['id'] ,
				'cat_user_id' => $this->request->data['User']['id'] ,
				'description' => "El usuario ".$_SESSION['Auth']['User']['username']." edito el rol de ".$this->User->findById($this->request->data['User']['id'])['User']['username']."." ,
				'modified'=> $invDate));
				if ($this->User->saveAll($this->request->data)) {
					$this->Logbook->create();
					$this->Logbook->save($data);
					//Se busca si el usuario al cual se le modificará el rol es un posible administrador o colaborador
					if(empty($this->User->Administrator->find('first',array('conditions' => array('Administrator.user_id' => $this->request->data['User']['id']))))){
						$this->request->data['Administrator']['user_id'] = $this->request->data['User']['id'];
						//Se guardan los datos correspondientes el modelo Administrator en el caso de que el usuario editado sea un administrador o colaborador
						if ($this->User->Administrator->save($this->request->data)){
							//Se notifica que se han realizado los cambios correctamente al modificar el rol
							$this->Flash->success(__('El rol ha sido actualizado correctamente.'));
							//Se redirige al index de usuarios, mostrando todos los usuarios de la página
							return $this->redirect(array('action' => 'index', $id));
						}
						else {
							//Se notifica al usuario en caso de que no se logre guardar los cambios
							$this->Flash->success(__('El rol no se puedo actualizar.'));
							//Se redirige al index de usuarios, mostrando todos los usuarios de la página
							return $this->redirect(array('action' => 'index', $id));
						}
					}
					else{
						//Se notifica que se han realizado los cambios
						$this->Flash->success(__('El rol ha sido actualizado.'));
						return $this->redirect(array('action' => 'index', $id));
					}
				} else {
					//Se notifica que  no se han realizado los cambios
					$this->Flash->error(__('El rol no se ha podido actualizar.'));
				}
			} else {
				//Vuelve a cargar el usuario.
				$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
				$this->request->data = $this->User->find('first', $options);
			}
		}
	}
	
	public function habdes($id = null) {
		//Se verifica que exista una sesión activa
		if ( (!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role'] == null ) ) {
			//Se maneja la excepción en caso de que no haya un usuario en la sesión
			throw new NotFoundException(__('Es necesario estar registrado para esta sección.'));
			//Se redirige al home de la página
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		//Se chequea que el usuario a buscar existe
		if (!$this->User->exists($id)) {
			//Caso contrario se llama a la excepción
			throw new NotFoundException(__('Usuario no válido'));
		}
		// Controla el acceso de los usuarios habilitados o deshabilitados.
		// En caso de usuarios deshabilitados, los deslogea y los redirige a otra pagina.
		if($this->User->findById($_SESSION['Auth']['User']['id'])['User']['activated']!=1){
			return $this->redirect(array('controller' => 'users','action' => 'userdesha'));
		}
		//Primero se verigica que el usuario en la sesión activa tenga un rol de administrador
		if((!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role']=='Administrador') && ($this->request->is(array('post', 'put')))){
			$conditions = array(
						"AND" => array(
						    array('User.id '=>$id),
						    array('User.role '=>'Administrador')
						)
					);
			
			if(empty($this->User->find('first',array('conditions' =>$conditions )))) {
				//Se guardan los cambios al usuario
				$this->loadModel('Logbook');
				$dateNow = new DateTime('now', new DateTimeZone('America/Costa_Rica'));
				$invDate = $dateNow->format('Y-m-d H:i:s');
				if($this->request->data['User']['activated']==1)
				{
					$varr=" habilitó ";
				}
				else{
					$varr=" deshabilitó ";
				}
				$data = array('Logbook' => array('user_id' => $_SESSION['Auth']['User']['id'] ,
				'cat_user_id' => $this->request->data['User']['id'] ,
				'description' => "El usuario ".$_SESSION['Auth']['User']['username'].$varr."a ".$this->User->findById($this->request->data['User']['id'])['User']['username']."." ,
				'modified'=> $invDate));
				if ($this->User->save($this->request->data)) {
					$this->Logbook->create();
					$this->Logbook->save($data);
					//Se notifica que el estado de la cuenta se modificó correctamente
					$this->Flash->success(__('Se cambio correctamente el estado de la cuenta.'));
					//Se redirige al index de usuarios
				//	debug($this->User->save($this->request->data));
					return $this->redirect(array('action' => 'index'));
				} else {
					//En el caso contrario, se notifica al usuario que los cambios no se pudieron realizar
					$this->Flash->error(__('El cambio no se realizó correctamente.'));
				}
			}
			else{
				$this->Flash->success(__('Un administrador no puede habilitar o deshabilitar a otro administrador.'));
				//Se redirige al index de usuarios
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			//Vuelve a cargar el usuario.
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	/**
	 * editactivated method
	 *
	 * Función para realizar el cambio de un usuario, ya sea para habilitar o deshabilitar la cuenta.
	 * 
	 * @throws NotFoundException
	 * @param string $id - Contiene el id del usuario que se va a modificar.
	 * @return void
	 */
	public function editactivated($id = null) {
		//Se revisa si el usuario existe
		if (!$this->User->exists($id)) {
			//Caso contrario se llama a la excepción
			throw new NotFoundException(__('Usuario no válido'));
		}
		// Controla el acceso de los usuarios habilitados o deshabilitados.
		// En caso de usuarios deshabilitados, los deslogea y los redirige a otra pagina.
		if($this->User->findById($_SESSION['Auth']['User']['id'])['User']['activated']!=1){
			return $this->redirect(array('controller' => 'users','action' => 'userdesha'));
		}
		if ($this->request->is(array('post', 'put'))) {
			//Se guardan los cambios al usuario
			if ($this->User->save($this->request->data)) {
				//Se notifica que el estado de la cuenta se modificó correctamente
				$this->Flash->success(__('Se cambio correctamente el estado de la cuenta.'));
				//Se redirige al index de usuarios
				return $this->redirect(array('action' => 'index'));
			} else {
				//En el caso contrario, se notifica al usuario que los cambios no se pudieron realizar
				$this->Flash->error(__('El cambio no se realizó correctamente.'));
			}
		} else {
			//Vuelve a cargar el usuario.
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	
	}
	

	/**
	 * add method
	 *
	 * Función que maneja la insersión de un nuevo usuario.
	 * 
	 * @throws NotFoundException
	 * @return void
	 */
	public function add() {
	//Se revisa primero en la variable $_SESSION si ya hay una sesión activa
    	if ( (!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role'] != null  )) {
    		//Si ya hay una sesión activa, se le notifica al usuario que ya ha iniciado sesión
			$this->Flash->error(__('Su sesión ya está activa.'));
			//Se le redirige al home de la página
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		//Guarda en role la variable $this->roles
		$this->set('role', $this->roles);
		if ($this->request->is('post')) {
			if ($this->User->validates(array('fieldList' => array('password')))) {
                     	//Si los passwords ingresados son iguales
	                     if($this->data['User']['password'] ==$this->data['User']['repeat_password'])
	                     {
							//Se crea un nuevo usuario
							$this->User->create();
							//Se guardan los datos del nuevo usuario
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
					                            	//Se notifica al usuario que la cuenta fue creada con éxito
					                                $this->Flash->success(__('El usuario ha sido creado. Por favor verifique su correo electrónico para activar su cuenta.'));
					                          		return $this->redirect(array('controller'=>'pages','action' => 'display'));
					                            }
					                            else {
					                            	//Se le notifica el usuario en el caso de que un error el intentar enviar el correo de activación
					                            	$this->Flash->set('Hubo un error al enviar el correo electrónico. Por favor intente nuevamente en unos minutos.');
					                            	delete_without_flash($this->request->data['User']['id']);
					                            }
								}
							}					
	                     }
	                    else{
	                     	//Si el error se da al no ser las contraseñas iguales se le notifica al usuario
	                         $this->Flash->set('Las contraseñas ingresadas no son iguales.',$this->User->invalidFields());
	                    }
				}
			
			 else {
			 	//Se le notifica al usuario que verifique que los datos sean correctos en el caso de que no se pueda agregar el usuario
				$this->Flash->error(__('El usuario no pudo ser registrado. Por favor confirmar que los datos sean válidos.'));
			}
		}
	}
	
	/**
	 * activate method
	 *
	 * Permite activar un usuario en la base de datos a través de un link generado automáticamente.
	 * 
	 * @throws NotFoundException
	 * @params $token
	 * @return void
	 */
	public function activate($token=null)
	{
		//Se verifica si ya hay una sesión activa
		if ( (!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role'] != null  )) {
			//Se le notifica al usuario que ya se encuentra registrado
			throw new NotFoundException(__('Sesión activa.'));
			//Se procede a redirgir al home de la página
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		//Se declara que la busqueda no se debe de realizar recursivamente.
		$this->User->recursive=-1;
		//Pregunta si recibe algun token.
        if(!empty($token))
        {
            $u=$this->User->findBytokenhash($token);
            //Verifica si existe dicho token en la base.
           if(!empty($u))
            {
                $this->User->data=$u;   
                //Carga los datos del usuario dueño de dicho token.
                if(!empty($this->User->data))
                {    
                	//Crea un nuevo token.
                    $new_hash=sha1($u['User']['username'].rand(0,100));		
                    $this->User->data['User']['tokenhash']=$new_hash;
                    //Si no se ha activado el usuario en cuestión.
                    if($this->User->data['User']['activated'] == (false)) 
                    {
                    	//Modifica la tupla 'activated' correspondiente al estado de activacion del usuario.
                        $this->User->data['User']['activated'] = (true);   
                        if($this->User->data['User']['activated'] == (true))
                        {
                        	//Actualiza el usuario para que su estado sea activo.	
                           	if ($this->User->updateAll(array('User.activated' => 1), array('User.username' => $u['User']['username']))){
                           		$this->Flash->success(__('Se activó su cuenta correctamente.'));
                           		$this->User->updateAll(array('User.tokenhash' => NULL), array('User.username' => $u['User']['username']));
								return $this->redirect(array('controller' => 'pages','action' => 'display'));
                           	} else {
                           		//En caso de error, avisa que no se pudo activar.
								$this->Flash->error(__('El usuario no pudo ser activado, intente de nuevo'));
							}
                        }
                    }
                    else{
                    	//Existe una incoherencia en la base o esta activado, se redirige a 'login'
                        $this->Flash->set('errors',$this->User->invalidFields());
                        return $this->redirect(array('action'=>'login'));
                        }
                }
            }
            else
            {
            	//En de intentar acceder varias veces con un mismo token, se le notifica que no es posible.
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
	 * send_mail method
	 *
	 * Envía un correo eléctronico según la plantilla deseada.
	 * 
	 * @throws NotFoundException
	 * @param $email_data
	 * @return void
	 */
	public function send_mail($email_data = null)
	{
		$Email = new CakeEmail();
        $Email->config('gmail');
        
		if(empty($email_data['name']))
		{
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
		}
		else
		{
			//En caso de que sea un correo hacia los administradores del sitio.
			$Email->to($email_data['to']);
			$Email->subject($email_data['subject']);
			$Email->template('$Email_template');
			$Email->from($email_data['from']);
			$Email->template($email_data['template']);
			$Email->viewVars (array('user_data' => $email_data['body']['user_data']));
		}
		$Email-> emailFormat ('html');
		if ($Email->send())   
            {
            return true;
            } else {
            echo $this->Email->smtpError;
            }
	}
	
	/**
	 * forgot_password method
	 *
	 * Genera un token y envía un correo electrónico para reiniciar la contraseña.
	 * 
	 * @throws NotFoundException
	 * @return void
	 */
	public function forgot_password()
	{
		//Verifica si hay una sesión activa primero
		if ( (!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role'] != null)  ) {
			//Si la sesión se encuentra activa se maneja la expeción
			throw new NotFoundException(__('Sesión activa.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
        $this->User->recursive=-1;
        //Si los datos ingresados no son vacíos.
        if(!empty($this->data))
        {
        	//Verifica que ingresara el email.
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
                            	//Se notifica al usuario si el correo fue enviado correctamente
                                $this->Flash->success(__('Correo electrónico enviado correctamente.'));
                                $this->redirect(array('controller'=>'users','action'=>'login'));
                            }
                            else {
                            	//En el caso de algún error, se le notifica al usuario que el correo no pudo ser enviado
                            	$this->Flash->set('Hubo un error al enviar el correo electrónico. Por favor intente nuevamente en unos minutos.');
                            }
                        }
                        else{
                        	//Si el error se da al generar el enlace, se le notifica al usuario
                            $this->Flash->set("Error al generar enlace para reinicio de contraseña.");
                        }
                    }
                    else
                    {
                    	//Se le notifica al usuario que la cuenta todavía no ha sido activada en el respectivo caso
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

	/**
	 * form_contact method
	 *
	 * Permite al usuario enviar un correo electronico a los administradores del sitio.
	 * 
	 * @throws NotFoundException
	 * @params $token
	 * @return void
	 */
	public function contact()
	{
		
	}
	public function form_contact(){
		
		//$User = $this->User->read(null,$id);
		$data = array();
		$user_data = array();
		$data['to'] = 'cavimad.cr@gmail.com';
		$data['subject'] = $this->request->data['contactSubject'];
		$user_data['from'] = $this->request->data['email'];
		$user_data['phone'] = $this->request->data['contactPhone'];
		$user_data['body'] = $this->request->data['comments'];
		$user_data['name'] = $this->request->data['name'];
		$this->set('user_data', $user_data);  
		$data['body'] = array('user_data' => $user_data);
		$data['template'] = 'contact';  
		//debug($this->request->data);
		$output =$this->send_mail($data);

        if($output){
          	//Se notifica al usuario si el correo fue enviado correctamente
              $this->Flash->success(__('Muchas gracias, su comentario se envío correctamente.'));
              $this->redirect(array('controller' => 'pages','action' => 'display'));
        }
        else {
          	//En el caso de algún error, se le notifica al usuario que el correo no pudo ser enviado
          $this->Flash->set('Hubo un error al procesar su comentario. Por favor intente nuevamente en unos minutos.');
          $this->redirect(array('controller'=>'users','action'=>'contact'));
        	
        }
		

	}
	
	/**
	 * reset method
	 *
	 * Reinicia la contraseña según un hash agregado anteriormente.
	 * 
	 * @throws NotFoundException
	 * @param $token
	 * @return void
	 */
 	public function reset($token=null)
 	{
 		 //Se verifica si ya existe una sesión activa
         if ( (!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role'] != null ) ) {
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
                     
                     //Si los passwords ingresados son iguales
                     
                     if($this->data['User']['password'] ==$this->data['User']['repeat_password'])
                     {
                         //Actualiza el usuario con la nueva contraseña.                   
                         if($this->User->savefield('password',$this->request->data['User']['password']))
                         {
                             $this->Flash->success(__('La contraseña ha sido actualizada.'));
                             $this->User->updateAll(array('User.tokenhash' => NULL), array('User.username' => $u['User']['username']));
                             $this->redirect(array('controller'=>'users','action'=>'login'));
                         }
                     }
                     else{
                     	//Si el error se da al no ser las contraseñas iguales se le notifica al usuario
                         $this->Flash->set('Las contraseñas ingresadas no son iguales.',$this->User->invalidFields());
                         }
                 }
             }
             else
             {
             	//Si se trata de acceder con un enlace ya usado o expirado notifica al usuario y redirige al login
                  $this->Flash->set('Token corrupto. Por favor revise su enlace autogenerado. El enlace solo funciona una única vez.');
                  $this->redirect(array('controller'=>'users','action'=>'login'));
             }
         }
         else
         {	
         	//Si el uruario trata de acceder a con un token invalido se lo notifica y redirige al login
             $this->Flash->set('Token inválido, intente de nuevo.');
             $this->redirect(array('controller'=>'users','action'=>'login'));
         }
     
 	}
 	
 	/**
	 * new_password method
	 *
	 * Método que permite a un usuario cambiar su contraseña.
	 * 
	 * @throws NotFoundException
	 * @return void
	 */
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
 					//En caso de que lograra modificar la contraseña, se devuelve a su perfil.
                    $this->Flash->success(__('La contraseña ha sido actualizada.'));
					return $this->redirect(array('action' => 'edit',$pass['User']['id']));
 				}
 				 else 
 				 {
 				 	//En caso de que no lograra moficar su contraseña, se le notifica.
					$this->Flash->error(__('Imposible actualizar la contraseña. Contacte al administrador del sitio.'));
					return $this->redirect(array('action' => 'edit',$pass['User']['id']));
 				 }
 			}
 			else
 			{
 				//Si las contraseñas ingresadas no son iguales notifica al usuario
 				$this->Flash->error(__('Las contraseñas ingresadas no son iguales.'));
				return $this->redirect(array('action' => 'edit',$pass['User']['id']));
 			}
 		}
 		else
 		{ 
 				//Si la contraseña no corresponde a la contraseña gusrdada notifica al usuario con un mensaje de error
 				$this->Flash->error(__('La contraseña ingresada no es igual a la almacenada en el sistema.'));
 				return $this->redirect(array('action' => 'edit',$pass['User']['id']));
 		}
 		
 	}
}
