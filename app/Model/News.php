<?php
App::uses('AppModel', 'Model');
/**
 * News Model
 * 
 * Modelo que contiene las validaciones de los campos de News y sus relaciones con los otros modelos.
 *
 */
class News extends AppModel {

/**
 * Display field
 * 
 * Campo a mostrar para cuando se llame a News mediante relaciones.
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 * 
 * Contiene las reglas de validación para el modelo, campos obligatorios, tamaños máximos, mínimos y no blancos.
 *
 * @var array
 */
	public $validate = array(
		// valida que el titulo no este vacio
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
		//valida la fecha de creacion
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
		// valina la fecha de modificacion
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
		'NewsEventsPicture.0.image' => array(
             'rule' => array(
                 'extension',
                 array( 'png', 'jpg')
             ),
             'message' => 'Por favor agregue una imagen valida.'
        ),
	);
	
}
