<?php
App::uses('AppModel', 'Model');
/**
 * Event Model
 * 
 * Modelo de verificacion de eventos
 *
 */
class Event extends AppModel {

/**
 * Display field
 * 
 * Campo a mostrar para cuando se llame eventos mediante relaciones.
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 * 
 * Reglas de validacion 
 *
 * @var array
 */
	public $validate = array(
		// valida que el titulo no sea vacio
		'title' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		// valida la fecha de creacion
		'created' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		// valida la fecha de modificacion
		'modified' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		// valida que la imagen sea png o jpg
		'image' => array(
             'rule' => array(
                 'extension',
                 array( 'png', 'jpg')
             ),
             'message' => 'Por favor agregue una imagen valida.'
        ),
	);
}
