<?php
App::uses('AppModel', 'Model');
/**
 * Link Model
 * 
 * Modelo de valicion de datos para los enlaces de  la pagina web
 *
 * @property Administrator $Administrator
 */
class Link extends AppModel {

/**
 * Display field
 * 
 * Campo a mostrar para cuando se llame eventos mediante relaciones.
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 * 
 * Reglas de validacion para los enlaces
 *
 * @var array
 */
/*	public $validate = array(
		'url' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'administrator_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);*/

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * Relación con el modelo de administrador
 *
 * @var array
 */
	public $belongsTo = array(
		'Administrator' => array(
			'className' => 'Administrator',
			'foreignKey' => 'administrator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
