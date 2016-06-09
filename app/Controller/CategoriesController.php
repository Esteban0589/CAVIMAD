<?php
App::uses('TreeMenuAppController', 'TreeMenu.Controller');

/**
 * Categories Controller
 *
 * @property Category $Category
 */
class CategoriesController extends TreeMenuAppController {
    public $helpers = array('Html', 'Form', 'TreeMenu.Menu', 'Js', 'Time');
    public $uses = array('TreeMenu.Category');

    var $categoryAlias = null;
    var $classification = array('Filo' => 'Filo','Subfilo' => 'Subfilo','Clase' => 'Clase','Orden' => 'Orden','Suborden' => 'Suborden','Familia' => 'Familia','Subfamilia' => 'Subfamilia','Genero' => 'Genero');
    
    /**
	 * beforeFilter method
	 * 
	 * Contiene los métodos a los cuales se permite llamar sin tener una sesión de usuario activa.
	 * @param string $alias
	 * @return void
	 */	
    
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('logout', 'login','buscador','buscar','index','view','view2','sort','admin_getnodes','admin_cargar','catalogo');
        /*$this->layout = 'TreeMenu.bootstrap';*/
        $this->layout = 'default';
        
        if(isset($this->params['named']['alias'])){
            $alias = Inflector::slug($this->params['named']['alias']);
            $this->categoryAlias = $alias;
            $humanizeAlias = Inflector::humanize($alias);
            $this->set(compact('alias', 'humanizeAlias'));
        }else{
            $alias = null;
            $humanizeAlias = __('Category');
            $this->set(compact('alias', 'humanizeAlias'));
        }
        
        if(isset($this->Auth)){
            $this->Auth->allow('*');
        }
    }
    
    /*public function debugController($id) {
			$this->request->data = $id;
	}*/
        /**
     * Get_menu_Categories method
     *  
     * método encargado de traer todas las categorías en el menú
     * 
     * @param string $alias
     * @return $categories
     */

    public function get_menu_categories(){
        $this->autoRender  = false;
        // lee al caché para un fácil acceso en todo caso las carga
        $alias = $this->categoryAlias;
        $categories = Cache::read('get_menu_categories_'.$alias);
        // si las condición de categorías es publicada y cumple el alias retorna la categoría
        if(empty($categories)){
            $conditions = array('Category.published'=>1);
            if($alias){
                $conditions['Category.alias'] = $alias;
            }else{
                $conditions[] = 'Category.alias IS NULL';
            }
            $categories = $this->Category->find('threaded', array('order'=>array('Category.lft'=>'ASC'),'conditions'=>$conditions));
            Cache::write('get_menu_categories', $categories);
        }

        return $categories;
    }

    /**
     * admin_index method
     * 
     * Metodo encargado de la generación del index de categorías
     *
     * @return void
     */
    public function index() {
        $alias = $this->categoryAlias;
        //Limpia el cache.
        clearCache();
        if($alias){
            $alias = Inflector::slug($alias);
            $this->set('title', Inflector::humanize($alias));
            $this->set('description', __('Manage').' '.Inflector::humanize($alias));
        }else{
            $this->set('title', __('Categoria'));
            $this->set('description', __('Manejar categoria'));
        }
        // busca todas las categorías
        $categoriesfind = $this->Category->find('all');
        $this->set('allCategories', $categoriesfind);
        
      /*  $this->Category->recursive = 0;
        $categories = $this->Category->getAllCategory($alias);
        $this->set('categories', $categories);*/
    }

    /**
     * admin_add method
     *
     * método para agregar una nueva categoría
     * 
     * @return void
     */
    public function add() {
        $this->loadModel('Family');
        $this->loadModel('Gender');
        $alias = $this->categoryAlias;
        if ($this->request->is('post')) {
            // se crea una categoría
            $this->Category->create();
            // en base a eso se le asigna un alias
            if($alias) $this->request->data['Category']['alias'] = $alias;
            //Si los datos son creados correctamente se notifica mediante un mensaje
            if ($this->Category->save($this->request->data)) {
                //Este bloque se encarga de cargar el modelo Logbook, crea los datos necesarios dentro del arreglo al que Lookgbook 
                //le realizará un save en la base de datos
                //return $this->debugController('salvo en modelo normal');
                if($this->request->data['Category']['classification'] == 'Familia'){
                    $this->request->data['Family']['0']['category_id']= $this->Category->id;
                //	return $this->debugController($this->request->data);
                	$this->Family->saveAll($this->request->data['Family']['0']);
                	

                }
                if($this->request->data['Category']['classification'] == 'Genero'){
                    $this->request->data['Gender']['0']['category_id']= $this->Category->id;
                	$this->Gender->saveAll($this->request->data['Gender']['0']);
                	//return $this->debugController($this->request->data);
                }
                
                $this->loadModel('Logbook');
                $dateNow = new DateTime('now', new DateTimeZone('America/Costa_Rica'));
				$invDate = $dateNow->format('Y-m-d H:i:s');
				$data = array('Logbook' => array('user_id' => $_SESSION['Auth']['User']['id'] ,
				'category_id' =>  $this->Category->findByName($this->request->data['Category']['name'])['Category']['id'] ,
				'description' => "El usuario ".$_SESSION['Auth']['User']['username']." agregó la categoría ".$this->request->data['Category']['name']."." ,
				'modified'=> $invDate));
				$this->Logbook->create();
				$this->Logbook->save($data);
				
                $this->Session->setFlash(__('Datos ingresados correctamente'), 'TreeMenu.success');
                $alias = ($alias) ? array('action' => 'sort', 'alias'=>$alias) : array('action' => 'sort');
                $this->redirect($alias);
            } else {
                //Si los datos no se guadados correctamente se notifica mediante un mensaje de error
                $this->Session->setFlash(__('Los datos no se guardaron. Intente nuevamente.'), 'TreeMenu.error');
            }
        }
            // busca el padre de las categorías y genera el arbol
            $parentCategories = $this->Category->_generateTreeList($alias);
            $this->set(compact('parentCategories'));
            $this->set('classification', $this->classification);
    }
    
    /**
     * view method
     *
     * metodo de visualización de cada categoría 
     * 
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->loadModel('Family');
        $this->loadModel('Gender');
        $this->loadModel('CountryGender');
        //Si el taxón buscado no existe se notifica mediante un mensaje de error
        if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Taxón no valido'));
		}
	    // despliega las categorías según lo primero que encuentre en la base y que cumplan la condion del id solicitado.
	    $taxon = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
		$this->set('category', $taxon);
		
		if ($taxon['Category']['classification'] == 'Familia'){
		    $familiaDatos = $this->Family->find('first', array('conditions' => array('Family.category_id' => $taxon['Category']['id'])));
		    $this->set('datosFamilia', $familiaDatos['Family']);
		    
		     //Recibe el id de la tabla categoría de un género.
    	    $id_category = $taxon['Category']['id'];
    	    
    	    //Este arreglo contendrá los id's de cada país en el cuál hay especies del género.
            $countries = [];
    	    //Obtiene el id del género según su id de categoría.
    	    $id_gender = $this->Category->find('all', array('recursive' => -1,'conditions' => array('Category.parent_id' => $id_category)));
    	    //debug($id_gender[0]['Category']['id']);
    	    
    	    for ($j = 0; $j<count($id_gender); $j++)
            {
                $id_tabgen = $this->Gender->find('first',array('recursive'=>-1,'conditions'=>array('Gender.category_id'=>$id_gender[$j]['Category']['id'])));
                  //debug($id_tabgen['Gender']['id']);
                  //Obtiene la lista de países en donde hay especies del género. 
                $info_countries = $this->CountryGender->find('first',array('recursive'=>-1, 'conditions'=>array('CountryGender.gender_id '=>$id_tabgen['Gender']['id'])));
                    //debug($info_countries);
                 //Si se encuentra en el país, se añade el id al arreglo.
            
                 if($info_countries["CountryGender"]["belize"] && !in_array(1,$countries))
                    array_push($countries,1);
                if($info_countries["CountryGender"]["costa_rica"] && !in_array(2,$countries))
                    array_push($countries,2);
                if($info_countries["CountryGender"]["el_salvador"] && !in_array(3,$countries))
                    array_push($countries,3);
                if($info_countries["CountryGender"]["guatemala"] && !in_array(4,$countries))
                    array_push($countries,4);
                if($info_countries["CountryGender"]["honduras"] && !in_array(5,$countries))
                    array_push($countries,5);
                if($info_countries["CountryGender"]["mexico"] && !in_array(6,$countries))
                    array_push($countries,6);
                if($info_countries["CountryGender"]["nicaragua"] && !in_array(7,$countries))
                    array_push($countries,7);
                if($info_countries["CountryGender"]["panama"] && !in_array(8,$countries))
                    array_push($countries,8);

            }
		    $this->set('countries',$countries);
		}
		if ($taxon['Category']['classification'] == 'Genero'){
		    
		    $generoDatos = $this->Gender->find('first', array('conditions' => array('Gender.category_id' => $taxon['Category']['id'])));
		    $this->set('datosGenero', $generoDatos['Gender']);
		    
		    //Recibe el id de la tabla categoría de un género.
    	    $id_category = $taxon['Category']['id'];
    	    
    	    //Obtiene el id del género según su id de categoría.
    	    $id_gender = $this->Gender->find('first', array('recursive' => -1,'conditions' => array('Gender.category_id' => $id_category)));
             
            //Obtiene la lista de países en donde hay especies del género.    
            $info_countries = $this->CountryGender->find('first',array('recursive'=>-1, 'conditions'=>array('CountryGender.gender_id '=>$id_gender['Gender']['id'])));
            //Este arreglo contendrá los id's de cada país en el cuál hay especies del género.
            $countries = [];
            //Si se encuentra en el país, se añade el id al arreglo.
            if($info_countries["CountryGender"]["belize"])
                array_push($countries,1);
            if($info_countries["CountryGender"]["costa_rica"])
                array_push($countries,2);
            if($info_countries["CountryGender"]["el_salvador"])
                array_push($countries,3);
            if($info_countries["CountryGender"]["guatemala"])
                array_push($countries,4);
            if($info_countries["CountryGender"]["honduras"])
                array_push($countries,5);
            if($info_countries["CountryGender"]["mexico"])
                array_push($countries,6);
            if($info_countries["CountryGender"]["nicaragua"])
                array_push($countries,7);
            if($info_countries["CountryGender"]["panama"])
                array_push($countries,8);
    		//debug($countries);
		    $this->set('countries',$countries);
		    
		}
		//$pic=$this->set('category', $this->Picture->find('all', array('conditions' => array('Picture.category_id' => $id))));
		
		$this->layout = 'ajax';


	}
	
	/**
     * view2 method
     *
     * metodo de visualización en una pantalla individual
     * 
     * @param string $id : taxon  a visualizar
     * 
     * @return void
     */
    public function view2($id = null) {
        $this->loadModel('Family');
        $this->loadModel('Gender');
        $this->loadModel('CountryGender');
        //Si el taxón buscado no existe se notifica mediante un mensaje de error
        if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Taxón no valido'));
		}
	    // despliega las categorías según lo primero que encuentre en la base y que cumplan la condion del id solicitado.
	    $taxon = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
	    //debug($taxon);
		$this->set('category', $taxon);
		if ($taxon['Category']['classification'] == 'Familia'){
		    $familiaDatos = $this->Family->find('first', array('conditions' => array('Family.category_id' => $taxon['Category']['id'])));
		    $this->set('datosFamilia', $familiaDatos['Family']);
		    
		    //Recibe el id de la tabla categoría de un género.
    	    $id_category = $taxon['Category']['id'];
    	    
    	    //Este arreglo contendrá los id's de cada país en el cuál hay especies del género.
            $countries = [];
    	    //Obtiene el id del género según su id de categoría.
    	    $id_gender = $this->Category->find('all', array('recursive' => -1,'conditions' => array('Category.parent_id' => $id_category)));
    	    //debug($id_gender[0]['Category']['id']);
    	    
    	    for ($j = 0; $j<count($id_gender); $j++)
            {
                $id_tabgen = $this->Gender->find('first',array('recursive'=>-1,'conditions'=>array('Gender.category_id'=>$id_gender[$j]['Category']['id'])));
                  //debug($id_tabgen['Gender']['id']);
                  //Obtiene la lista de países en donde hay especies del género. 
                $info_countries = $this->CountryGender->find('first',array('recursive'=>-1, 'conditions'=>array('CountryGender.gender_id '=>$id_tabgen['Gender']['id'])));
                    //debug($info_countries);
                 //Si se encuentra en el país, se añade el id al arreglo.
            
                 if($info_countries["CountryGender"]["belize"] && !in_array(1,$countries))
                    array_push($countries,1);
                if($info_countries["CountryGender"]["costa_rica"] && !in_array(2,$countries))
                    array_push($countries,2);
                if($info_countries["CountryGender"]["el_salvador"] && !in_array(3,$countries))
                    array_push($countries,3);
                if($info_countries["CountryGender"]["guatemala"] && !in_array(4,$countries))
                    array_push($countries,4);
                if($info_countries["CountryGender"]["honduras"] && !in_array(5,$countries))
                    array_push($countries,5);
                if($info_countries["CountryGender"]["mexico"] && !in_array(6,$countries))
                    array_push($countries,6);
                if($info_countries["CountryGender"]["nicaragua"] && !in_array(7,$countries))
                    array_push($countries,7);
                if($info_countries["CountryGender"]["panama"] && !in_array(8,$countries))
                    array_push($countries,8);

            }
		    $this->set('countries',$countries);
		    
		}
		if ($taxon['Category']['classification'] == 'Genero'){
		    
		    $generoDatos = $this->Gender->find('first', array('conditions' => array('Gender.category_id' => $taxon['Category']['id'])));
		    $this->set('datosGenero', $generoDatos['Gender']);
		    
		  //Recibe el id de la tabla categoría de un género.
    	    $id_category = $taxon['Category']['id'];
    	    
    	    //Obtiene el id del género según su id de categoría.
    	    $id_gender = $this->Gender->find('first', array('recursive' => -1,'conditions' => array('Gender.category_id' => $id_category)));
             
            //Obtiene la lista de países en donde hay especies del género.    
            $info_countries = $this->CountryGender->find('first',array('recursive'=>-1, 'conditions'=>array('CountryGender.gender_id '=>$id_gender['Gender']['id'])));
            //Este arreglo contendrá los id's de cada país en el cuál hay especies del género.
            $countries = [];
            //Si se encuentra en el país, se añade el id al arreglo.
            if($info_countries["CountryGender"]["belize"])
                array_push($countries,1);
            if($info_countries["CountryGender"]["costa_rica"])
                array_push($countries,2);
            if($info_countries["CountryGender"]["el_salvador"])
                array_push($countries,3);
            if($info_countries["CountryGender"]["guatemala"])
                array_push($countries,4);
            if($info_countries["CountryGender"]["honduras"])
                array_push($countries,5);
            if($info_countries["CountryGender"]["mexico"])
                array_push($countries,6);
            if($info_countries["CountryGender"]["nicaragua"])
                array_push($countries,7);
            if($info_countries["CountryGender"]["panama"])
                array_push($countries,8);
    		//debug($countries);
		    $this->set('countries',$countries);
		}
	
	}
	
	
	
	
    /**
     * edit method
     *
     * método para la edición de cada categoría
     * 
     * @param string $id
     * @return void
     */
     
    public function edit($id = null) {
        $this->loadModel('Family');
        $this->loadModel('Gender');
        $this->Category->id = $id;
        //Si la categoría buscada no existe se notifica mediante un mensaje de error
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Taxón no valido'));
        }
        
        $alias = $this->categoryAlias;
        // si el alias es editado correctamente notifica con un mensaje 
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Category->save($this->request->data)) {

                if($this->request->data['Category']['classification']=='Familia'){
                    $this->request->data['Family']['category_id']= $this->Category->id;
                	$this->Family->saveAll($this->request->data['Family']);

                }
                if($this->request->data['Category']['classification'] == 'Genero'){
                    $this->request->data['Gender']['category_id']= $this->Category->id;
                	$this->Gender->saveAll($this->request->data['Gender']);
                }

                $this->loadModel('Logbook');
                $dateNow = new DateTime('now', new DateTimeZone('America/Costa_Rica'));
				$invDate = $dateNow->format('Y-m-d H:i:s');
				$data = array('Logbook' => array('user_id' => $_SESSION['Auth']['User']['id'] ,
				'category_id' =>  $this->Category->findByName($this->request->data['Category']['name'])['Category']['id'] ,
				'description' => "El usuario ".$_SESSION['Auth']['User']['username']." editó ".$this->request->data['Category']['classification']." ".$this->request->data['Category']['name']."." ,
				'modified'=> $invDate));
				$this->Logbook->create();
				$this->Logbook->save($data);
                
                $this->Session->setFlash(__('Datos ingresados correctamente'), 'success');
                //$this->redirect($this->__getPreviousUrl());
                $alias = ($alias) ? array('action' => 'sort', 'alias'=>$alias) : array('action' => 'sort');
                $this->redirect($alias);
            } else {
                //  si los datos no son guardados correctamente notifica con un mensaje de error
                $this->Session->setFlash(__('Los datos no se guardaron. Intente nuevamente.'), 'error');
            }
        } else {
            
            $this->request->data = $this->Category->read(null, $id);
            $genero = $this->Gender->find('first', array('recursive'=>-1,'conditions' => array('Gender.category_id' => $id)));
            $family = $this->Family->find('first', array('recursive'=>-1,'conditions' => array('Family.category_id' => $id)));
            //debug($genero['Gender'] );
            $this->request->data['Family'] = $family['Family'];
            $this->request->data['Gender'] = $genero['Gender'];
            //$this->request->data=$this->Gender->read(null, $genero['Gender']);
            
        }
        // busca el padre de las categorías y genera el árbol
        $parentCategories = $this->Category->_generateTreeList($alias);
        $this->set(compact('parentCategories')); 
        $this->set('classification', $this->classification);
    }

    /**
     * delete method
     *
     * método encargado de eliminar categorías
     * 
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        // se trae el id de la categoría
        $this->Category->id = $id;
        //Si la categoría a buscar no existe se notifica mediante un mensaje de error
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Datos no validos'));
        }
        // segun el alias de las categorias se despliegan segun un orden indexado 
        $alias = $this->categoryAlias;
        $alias = ($alias) ? array('action' => 'sort', 'alias'=>$alias) : array('action' => 'sort');
        // según la categoría seleccionada se eliminan los datos
        //Si se logran eliminar los datos se notifica mediante un mensaje 
        
        $this->loadModel('Logbook');
        $dateNow = new DateTime('now', new DateTimeZone('America/Costa_Rica'));
		$invDate = $dateNow->format('Y-m-d H:i:s');
		$data = array('Logbook' => array('user_id' => $_SESSION['Auth']['User']['id'] ,
		'category_id' =>  $id ,
		'description' => "El usuario ".$_SESSION['Auth']['User']['username']." elimino la categoría ".$this->Category->findById($id)['Category']['name']."." ,
		'modified'=> $invDate));
		
		if ($this->Category->delete()) {
		    $this->Logbook->create();
		    $this->Logbook->save($data);
            $this->Session->setFlash(__('Datos eliminados'), 'success');            
            $this->redirect($alias);
        }
        else{
            //Si no se logran borar los datos  se notifica mediante un mensaje de error
            $this->Session->setFlash(__('Datos no eliminados'), 'error');
            $this->redirect($alias);
        }
    }
    /**
     *  Active/Inactive
     *
     * método encargado de el depliegue de las imágenes
     * 
     * @param int $id
     * @param int $status
     * 
     */
     
    public function admin_toggle($id, $status, $field = 'published') {
        $this->autoRender = false;

        if ($id) {
            
            $status = ($status) ? 0 : 1;
            $data['Category'] = array('id' => $id, $field => $status);
            // si todas las categoías estan correctamente guardadas y validadas les asigna la imágen
            if ($this->Category->saveAll($data['Category'], array('validate' => false))) {
                $link = ($this->base) ? FULL_BASE_URL .$this->base.'/' : '/';
                $plugin = Inflector::underscore($this->plugin);
                $url = $link.'/admin/'. $plugin . '/' . Inflector::tableize($this->name) . '/toggle/' . $id . '/' . $status . '/' . $field;
                $src = $link.$plugin. '/img/allow-' . $status . '.png';

                return "<img id=\"status-{$id}\" onclick=\"published.toggle('status-{$id}', '{$url}');\" src=\"{$src}\">";
            }
        }

        return false;
    }

    /**
     * Tree EXTJS
     *
     */
    public function sort() {
        $this->set('title', __('Category'));
        $this->set('description', __('Sort Categories'));
    }
    
    
     /**
     *  Buscar
     *
     * método encargado de la busque (query)
     * 
     * @return void
     * 
     */
    public function buscar() {
		$datos=($this->request->query['Buscar']);
		if(($datos)){
		    // carga la imágen del modelo
			$this->loadModel('Picture');
			$condition=explode(' ', trim($datos));					
			$condition=array_diff($condition,array(''));
			if($condition){
				foreach($condition as $tconditions){
					$conditions[] = array(
						"OR" => array(
						    array('Category.name LIKE '=>'%'.$tconditions.'%')
						)
						    
					);
				}
				// de  los resultado de la búsqueda, busque recursivamente todos que cumplan las condiciones
				$resultado=$this->Category->find('all', array('recursive'=>0, 'conditions'=>$conditions, 'limit' => 10));
				$i = 0;
				// para cada resultado encontrado por categoría según el id regrese la categoría y la imagen
				foreach($resultado as $resultados){
				    $catId = $resultado[$i]['Category']['id'];
				    $idConditions[] = array(
                        "OR" => array(
            				array('Picture.phylo_id'    => $catId),
            				array('Picture.subphylo_id' => $catId),
            				array('Picture.class_id'    => $catId),
            				array('Picture.subclass_id' => $catId),
            				array('Picture.subclass_id' => $catId),
            				array('Picture.order_id'    => $catId),
            				array('Picture.suborder_id' => $catId),
            				array('Picture.family_id'   => $catId),
            				array('Picture.subfamily_id'=> $catId),
            				array('Picture.genre_id'    => $catId),
            				array('Picture.subgenre_id' => $catId)
            			)
                    );
					if($this->Picture->find('all',array('recursive'=>0, 'conditions'=>$idConditions))){
					    $pics = $this->Picture->find('all',array('recursive'=>0, 'conditions'=>$idConditions));
						if(count($pics)==1){
						    //debug($resultado);
							$myRandomNumber=0;	
						}
						else{
						    // sino realizar un número aleatorio para encontrar lo solicitado
							$myRandomNumber = rand(0,count($pics)-1);
						}
						$pics = $pics[$myRandomNumber];
						$resultado[$i]=$resultado[$i]+$pics;
					}
					$i++;
					unset($idConditions);
				}
				//debug(count($resultado[1]['Picture']['id']));
				// si el conteo del resultado es mayor a 0, coloque el resultado
				if(count($resultado)>0){
					$this->set('resultados',$resultado);
				}
				else{
				    // sino que regrese mensaje que error a no encotrar elemntos de búsqueda
					return $this->Flash->error(__('No hay resultados para este criterio de búsqueda.'));
				}
			}
		}
		else{
		    // sino que mensaje por un critorio inválido
			return $this->Flash->error(__('Criterio de búsqueda no válido.'));
		}
	}
	
	/**
     * admin_getnodes method
     *
     * método encargado de cargar los nodos en el arbol conforme se despliegan
     * 
     * @param  $alias
     * @return void
     */
    public function admin_getnodes($alias=null) {
        $this->layout = 'ajax';
        // retrieve the node id that Ext JS posts via ajax
        $parent = isset($this->request->data['node']) ? intval($this->request->data['node']) : 0;

        // find all the nodes underneath the parent node defined above
        // the second parameter (true) means we only want direct children
        if ($parent) {
            $nodes = $this->Category->children($parent, true);
        } else {
            $conditions = array('Category.parent_id' => $parent);
            if($alias) {
                $conditions['Category.alias'] = $alias;
            }else{
                $conditions[] = 'Category.alias IS NULL';
            }
            $nodes = $this->Category->find('all', array(
                'conditions' => $conditions,
                'order' => array('Category.lft' => 'ASC')));
        }

        // send the nodes to our view
        $this->set(compact('nodes'));
    }


    /**
     * admin_cargar method
     *
     * método que devuelve el código HTML de secciones
     * 
     * @param  $id
     * @return void
     */
    public function admin_cargar($id) {

        // send the nodes to our view
    	$this->set('category', $this->Category->find('first', array('conditions' => array('Category.id' => $id))));
		$this->set('sons', $this->Category->find('all', array('conditions' => array('Category.parent_id' => $id))));
        $this->layout = 'ajax';

    }
    
    /**
     * catalogo method
     *
     * método que devuelve el código HTML original de secciones(como de primer entrada(shortcuts)) 
     * 
     * @param  $id
     * @return void
     */
    public function catalogo($id=null) {
        $this->layout = 'ajax';

        // send the nodes to our view
    }
    
    /**
     * admin_reorder method
     * 
     * método encargado de reordenar el árbol cuando se utiliza el drag and drop
     *
     * @param  $node
     * @return void
     */
    function admin_reorder() {
        $this->autoRender = false;
        // retrieve the node instructions from javascript
        // delta is the difference in position (1 = next node, -1 = previous node)

        $node = intval($this->request->data['node']);
        $delta = intval($this->request->data['delta']);
        
        // si eel nodo el movido hacia arriba/abajo reacomode nodo
        if ($delta > 0) {
            $this->Category->moveDown($node, abs($delta));
        } elseif ($delta < 0) {
            $this->Category->moveUp($node, abs($delta));
        }

        // send success response
        Cache::clear();
        clearCache();
        exit('1');
    }

    /**
     *  Admin_reparent 
     *
     * método encargado el reacomodo del nodo del padre cuando este es movido
     * 
     * @param int $noto
     * @param int $parent
     * @param int $position
     * 
     */
    function admin_reparent() {
        $this->autoRender = false;

        $node = intval($this->request->data['node']);
        $parent = intval($this->request->data['parent']);
        $position = intval($this->request->data['position']);

        // save the employee node with the new parent id
        // this will move the employee node to the bottom of the parent list

        $this->Category->id = $node;
        $property['Category']['parent_id'] = $parent;
        $this->Category->save($property);

        // If position == 0, then we move it straight to the top
        // otherwise we calculate the distance to move ($delta).
        // We have to check if $delta > 0 before moving due to a bug
        // in the tree behavior (https://trac.cakephp.org/ticket/4037)

        if ($position == 0) {
            $this->Category->moveUp($node, true);
        } else {
            $count = $this->Category->childCount($parent, true);
            $delta = $count - $position - 1;
            if ($delta > 0) {
                $this->Category->moveUp($node, $delta);
            }
        }

        // send success response
        Cache::clear();
        clearCache();
        exit('1');
    }
    
    /**
      * advanced_search2 method
      *
      * Método que carga la busqueda avanzada.
      * 
      *
      * @return void
      */
    public function advanced_search2(){
		    
		    $this->loadModel('Administrator');
		    $this->loadModel('Pictures');
		    //Carga todos los órdenes para en la varible $order.
		    $order = $this->Category->find('list', array(
          'conditions' => array('Category.classification' => 'Orden'),
          'recursive' => -1));
          //Estas variables se declaran en null pues se proceden a llenar con los métodos getDataFamily y getDataGenre.
          $family=array(null);
          $genre=array(null);
          //Envía las variables a a la vista.
         $this-> set (compact('categories', 'order'));
         $this-> set (compact('categories', 'family'));
         $this-> set (compact('categories', 'genre'));
         $this-> set (compact('categories', 'colaborator'));
    	}
    	
    /**
      * getDataFamily method
      *
      * Método utilizado para refrescar las familias según el orden seleccionado. La actualización se realiza via javascript.
      * 
      *
      * @return void
      */
	public function getDataFamily(){
	    //Permite desplegar los resultados de ajax.
	    $this->layout = 'ajax';
	    //Si se trata de actualizar a través de get.
	    if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        //Recupera el orden seleccionado enviado por el método de javascript  y realiza la consulta para obtener todas las familias de ese orden en específico.
        else{
            $order=$this->request->data['order'];
	        $family = $this->Category->find('list', array(
            'conditions' => array('Category.parent_id' => $order),
            'recursive' => -1));
		    $this->set('family', $family);

        } 
    
	}
	
	/**
      * getDataGenre method
      *
      * Método utilizado para refrescar los géneros según el orden seleccionado. La actualización se realiza via javascript.
      * 
      *
      * @return void
      */
	public function getDataGenre(){
	     //Permite desplegar los resultados de ajax.
	    $this->layout = 'ajax';
	     //Si se trata de actualizar a través de get.
	    if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        //Recupera el género seleccionado enviado por el método de javascript  y realiza la consulta para obtener todos los géneros de esa familia en específico.
        else{
            $family=$this->request->data['family'];
	        $genre = $this->Category->find('list', array(
            'conditions' => array('Category.parent_id' => $family),
            'recursive' => -1));
		    $this->set('genre', $genre);
        } 
    
	}
	
	/**
      * search_colaborator method
      *
      * Busca un colaborador según el nombre, apellido o usuario.
      * 
      *
      * @return void
      */
	public function search_colaborator($id=null) {
	      //Obtiene los datos de la búsqueda.
		$data=($this->request->pass[0]);
		//Sí no es nulo.
		if($data){
		    //Carga el modelo de usuarios.
			$this->loadModel('User');
			//Separa la string que se manda por espacios y se guarda en un array, elimina espacios sobrantes.
			$condition=explode(' ', trim($data));					
			$condition=array_diff($condition,array(''));
			if($condition){
			    //Crea un array con las condiciones para buscar por colaborador.
			    $conditions[]=array("AND"=> array(
						    array('User.role '=>'Colaborador')
						));
				foreach($condition as $tconditions){
					$conditions[] = array(
						"OR" => array(
						    array('User.name LIKE '=>'%'.$tconditions.'%'),
						    array('User.lastname1 LIKE'=>'%'.$tconditions.'%'),
						    array('User.username LIKE'=>'%'.$tconditions.'%')
						)
					);
				}
				//Busca en la base según el array anteriormente creado.
				$result=$this->User->find('all', array('recursive'=>0, 'conditions'=>$conditions));
				if(count($result)>0){
					$this->set('resultados',$result);
				}
				else{
				    //En caso de que no existan resultados, se le comunica al usuario.
					return $this->Flash->error(__('No hay resultados para este criterio de búsqueda.'));
				}
			}
		}
		else{
			return $this->Flash->error(__('Criterio de búsqueda no válido.'));
		}
	}
	
	/**
      * search_document method
      *
      * Busca un documento.
      * 
      * @param int $id
      * @return void
      */
    public function search_document($id=null) {
        //Obtiene los datos de la búsqueda.
		$doc=($this->request->pass['0']);//tipo de documento
		$search=$this->request->pass[1];//nombre del documento
		//Sí no es nulo.
		if(($data)){
		    //Carga el modelo de usuarios.
			$this->loadModel('User');
			//Separa la string que se manda por espacios y se guarda en un array, elimina espacios sobrantes.
			$condition=explode(' ', trim($data));					
			$condition=array_diff($condition,array(''));
			if($condition){
			    //Crea un array con las condiciones para buscar por documento.
				foreach($condition as $tconditions){
					$conditions[] = array(
						"OR" => array(
						    array('User.name LIKE '=>'%'.$tconditions.'%'),
						    array('User.lastname1 LIKE'=>'%'.$tconditions.'%'),
						    array('User.username LIKE'=>'%'.$tconditions.'%')
						)
					);
				}
				//Busca en la base según el array anteriormente creado.
				$result=$this->User->find('all', array('recursive'=>0, 'conditions'=>$conditions));
				if(count($result)>0){
					$this->set('resultados',$result);
				}
				else{
					return $this->Flash->error(__('No hay resultados para este criterio de búsqueda.'));
				}
			}
		}
		else{
			return $this->Flash->error(__('Criterio de búsqueda no válido.'));
		}
	}
	
	
	/**
      * redirect_to_methods method
      *
      * Redirecciona datos especificos de un solo form segun el tipo de búsqueda
      * que quiera, sea por colaboradores, docomentos o el nombre de algún taxon.
      * 
      * @return void
      */
	public function redirect_to_methods() {
	    $asd=$this->request->data;
	    //Si selecciono buscar colaboradores que mande unicamente el input search1(nombre).
	    if($this->request->data['Category']['drop1'] == 'colaboradores') {
	        $this->redirect(array('controller' => 'categories','action' => 'search_colaborator',$asd['Category']['search1']));
	        
	    } else if ($this->request->data['Category']['drop1'] == 'documentos') {
	        //Si selecciono buscar documentos que mande unicamente el input search2(nombre) y el tipo de documento.
	        $this->redirect(array('controller' => 'categories','action' => 'search_document',$asd['documento'],$asd['search2']));
	    } else if ($this->request->data['Category']['drop1'] == 'nivel') {
	        //Si selecciono buscar por categorias que mande unicamente sus input correspondientes.
	        //en caso de no mandar pertenenciente a este, mandar un -1 para la búsqueda.
	       if($asd['order']==null||$asd['order']=='Seleccione un orden'){
	           $asd['order']=-1;
	       }
	       if($asd['family']==null||$asd['family']=='Seleccione una familia'){
	           $asd['family']=-1;
	       }
	       if($asd['genre']==null||$asd['genre']=='Seleccione un género'){
	           $asd['genre']=-1;
	       }
	       if($asd['country']==null||$asd['country']=='Seleccione un país'){
	           $asd['country']=-1;
	       }
	       if($asd['search3']==null||$asd['search3']=='Escriba las palabras clave'){
	           $asd['search3']=-1;
	       }
	        $this->redirect(array('controller'=>'categories','action'=>'search_data',$asd['order'],$asd['family'],$asd['genre'],$asd['country'],$asd['search3']));
	    }
	}
	
	/**
      * search_data method
      *
      * Busca un dato en el árbol de taxones según el nombre, orden, familia, género 
      * o familia.
      * 
      * 
      * @return void
      */
	public function search_data(){
	    $this->loadModel('Picture');
	    $this->loadModel('Gender');
	    $this->loadModel('CountryGender');
	    $conditions=array();
	    
	    $order=($this->request->pass[0]);//Nombre de orden.
	    $family=$this->request->pass[1];//Nombre de familia.
	    $genre=($this->request->pass[2]);//Nombre del género.
	    $country=$this->request->pass[3];//Nombre del pais
	    $search3=$this->request->pass[4];//Nombre a buscar.
        
        
        if($search3!=-1){
            $condition=explode(' ', trim($search3));
            $condition=array_diff($condition,array(''));
            if($family!=-1){
                $result3 = $this->Category->children($family);
                
                if($country!=-1){
                        $i = 0;
                        $i2= 0;
                        foreach($result3 as $results){
                            $catId = $result3[$i]['Category']['id'];
                            $var = $this->Gender->find('all',array('recursive'=>0, 'conditions'=>array('Gender.category_id '=> $catId)));
                            if(count($var)>0){
                                $CondPaises[] = array(
                                    "AND" => array(
                                        array('CountryGender.'.$country    => 1),
                                        array('CountryGender.gender_id'    => $var[0]['Gender']['id']),
                                    )
                                );
                                if(count($this->CountryGender->find('all',array('recursive'=>0, 'conditions'=>$CondPaises)))>0){
                                    $result2[$i2] = $result3[$i] + $this->CountryGender->find('all',array('recursive'=>0, 'conditions'=>$CondPaises))[0];
                                    $i2++;
                                    
                                }
                            }
        			        unset($catId);
        			        unset($CondPaises);
        			        unset($var);
        			        $i++;
        			    }
                    }
                    else{
                        $result2=$result3;
                    }
                
                
                
                
            }
            else{
                if($order!=-1){
                   $result2 = $this->Category->children($order);
                }
            }
            $i=0;
            if(count($result2)>0){
                foreach($result2 as $result1){  
                    foreach($condition as $tconditions){
                        if((stripos(" ".$result1['Category']['name'],$tconditions))!=false  && $result2[$i]['Category']['name']!=-1){
                              $result[]=$result1;
                            $result2[$i]['name']=-1;
                        }
                        $i++;
                    }
                }
            }
            else{
                foreach($condition as $tconditions){
    					$conditions[] = array(
    						"OR" => array(
    						    array('Category.name LIKE '=>'%'.$tconditions.'%')
    						)
    						    
    					);
    				}
                    $result = $this->Category->find('all', array('recursive'=>0, 'conditions'=>$conditions));
            }
        }
        else{
            if($genre!=-1){
                $result = $this->Gender->find('all',array('recursive'=>0, 'conditions'=>array('Gender.category_id '=>$genre)));
				if($country=!-1){
    				$CondPaises[] = array(
                        "AND" => array(
                			array('CountryGender.'.$country    => 1),
                			array('CountryGender.gender_id'    => $result[0]['Gender']['id']),
                		)
                    );
                    $result[0] = $result[0]+ $this->CountryGender->find('all',array('recursive'=>0, 'conditions'=>$CondPaises))[0];
				}
				    
			}
            else{
                if($family!=-1){
                    
                    $result2 = $this->Category->find('all',array('recursive'=>0, 'conditions'=>array('Category.id '=>$family)));
                    $result2 = $result2 + $this->Category->children($family);
                    if($country!=-1){
                        $i = 0;
                        $i2= 0;
                        foreach($result2 as $results){
                            $catId = $result2[$i]['Category']['id'];
                            $var = $this->Gender->find('all',array('recursive'=>0, 'conditions'=>array('Gender.category_id '=> $catId)));
                            if(count($var)>0){
                                $CondPaises[] = array(
                                    "AND" => array(
                                        array('CountryGender.'.$country    => 1),
                                        array('CountryGender.gender_id'    => $var[0]['Gender']['id']),
                                    )
                                );
                                if(count($this->CountryGender->find('all',array('recursive'=>0, 'conditions'=>$CondPaises)))>0){
                                    $result[$i2] = $result2[$i] + $this->CountryGender->find('all',array('recursive'=>0, 'conditions'=>$CondPaises))[0];
                                    $i2++;
                                    
                                }
                            }
        			        unset($catId);
        			        unset($CondPaises);
        			        unset($var);
        			        $i++;
        			    }
        			    debug($result);
        			//    debug($result2);
                    }
                    else{
                        $result=$result2;
                    }
                }
                else{
                    if($order!=-1){
                        $result = $this->Category->find('all',array('recursive'=>0, 'conditions'=>array('Category.id '=>$order)));
                        $result = $result + $this->Category->children($order);
                    }
                }
            }
        }
		if($order!=-1||$family!=-1||$genre!=-1||$country!=-1||$search3!=-1){
		//	$result=$this->Category->find('all', array('recursive'=>0, 'conditions'=>$conditions));
			if(count($result)>0){
			    $i = 0;
			    $this->loadModel('Picture');
			    //debug($result);
			    foreach($result as $results){
				    $catId = $result[$i]['Category']['id'];
				    $idConditions[] = array(
                        "OR" => array(
            				array('Picture.phylo_id'    => $catId),
            				array('Picture.subphylo_id' => $catId),
            				array('Picture.class_id'    => $catId),
            				array('Picture.subclass_id' => $catId),
            				array('Picture.subclass_id' => $catId),
            				array('Picture.order_id'    => $catId),
            				array('Picture.suborder_id' => $catId),
            				array('Picture.family_id'   => $catId),
            				array('Picture.subfamily_id'=> $catId),
            				array('Picture.genre_id'    => $catId),
            				array('Picture.subgenre_id' => $catId)
            			)
                    );
					if($this->Picture->find('all',array('recursive'=>0, 'conditions'=>$idConditions))){
					    $pics = $this->Picture->find('all',array('recursive'=>0, 'conditions'=>$idConditions));
					    //debug($pics);
						if(count($pics)==1){
						    //debug($resultado);
							$myRandomNumber=0;	
						}
						else{
						    // sino realizar un número aleatorio para encontrar lo solicitado
							$myRandomNumber = rand(0,count($pics)-1);
						}
						$pics = $pics[$myRandomNumber];
						$result[$i]=$result[$i]+$pics;
					}
					$i++;
					unset($idConditions);
				}
				//debug($result);
				$this->set('resultados',$result);
			}
			else{
				return $this->Flash->error(__('No hay resultados para este criterio de búsqueda.'));
			}
		}
		else{
			return $this->Flash->error(__('Criterio de búsqueda no válido.'));
		}
	}
	
}
