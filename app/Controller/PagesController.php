<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('display');
    }

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->loadModel('HomePicture');
		$this->loadModel('News');
		$this->loadModel('Event');
		$this->loadModel('NewsEventsPicture');
		$imgnsPortada = $this->HomePicture->find('all');

		$pics=[];
		$pics2=[];
		if(count($imgnsPortada)>5){
			$pics=array_rand($imgnsPortada, 5);
			for($i=0; $i<count($pics); $i++){
				array_push($pics2, $imgnsPortada[$pics[$i]]);
			}
		}else{
			$pics2=$imgnsPortada;
		}
		
		$this->set('imagenesPortada', $pics2);
	
		$picsNews2=[];
		$picsNews2rand=[];
		$picsNewsFinal=[];
		$lastNewsCreated = $this->News->find('first', array('order' => array('News.created' => 'desc')));
		$picsNews=$this->NewsEventsPicture->find('all', array('conditions'=>array('NewsEventsPicture.news_id'=>$lastNewsCreated['News']['id'])));
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
		$this->set('picsNewsFinal', $picsNewsFinal);
		$this->set('lastNewsCreated', $lastNewsCreated);
		
		
		$picsEvents=[];
		$picsEvenrsrand=[];
		$picsEventsFinal=[];
		$lastEventCreated =  $this->Event->find('first', array('order' => array('Event.created' => 'desc')));
		$picsEvents2=$this->NewsEventsPicture->find('all', array('conditions'=>array('NewsEventsPicture.event_id'=>$lastEventCreated['Event']['id'])));

		for($i=0; $i<count($picsEvents2); $i++){
			array_push($picsEvents, $picsEvents2[$i]['NewsEventsPicture']);
		}
		if(count($picsEvents)>5){
			$picsEvenrsrand=array_rand($picsEvents, 5);
			for($i=0; $i<count($picsEvenrsrand); $i++){
				array_push($picsEventsFinal, $picsEvents[$picsEvenrsrand[$i]]);
			}
		}
		else{
			$picsEventsFinal=$picsEvents;
		}
		
		$this->set('picsEventsFinal', $picsEventsFinal);
		$this->set('lastEventCreated', $lastEventCreated);

		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
	
	  /**
      * autocompletebuscar method
      * 
      * Método no implementado para usar el autocompletar de js.
      * 
      * @return void
      */
	public function autocomplebuscar()
		{
			//Permite desplegar los resultados de ajax.
			$this->layout = 'ajax';
			//Carga la tabla de categorias.
		    $this->loadModel('Category');
		    //Carga todos los órdenes para en la varible $order.
		    $Buscar = $this->Category->find('list', array(
          'conditions' => array('Category.classification LIKE '=>'%Buscar%'),
          'recursive' => -1));
          //Estas variables se declaran en null pues se proceden a llenar con los métodos getDataFamily y getDataGenre.
          //Envía las variables a a la vista.
         $this-> set (compact('PagesController', 'Buscar'));
		}
	
}
