<?php
App::uses('AppModel', 'Model');

/**
 * Administrator Model
 * 
 * Modelo que contiene las validaciones de los campos de Administrator y sus relaciones con los otros modelos.
 *
 * @property User $User
 * @property Aboutus $Aboutus
 * @property Download $Download
 * @property Link $Link
 */

 
class Administrator extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		//Verifica que el campo de especialidad no este vacío.
		'specialty' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'curriculum' => array(
			//Verifica que el campo de curriculum no este vacío.
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * Relación con el modelo de User
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * Otras relaciones con el de modelo de Administrator
 *
 * @var array
 */
	public $hasMany = array(
		/*'Aboutus' => array(
			'className' => 'Aboutus',
			'foreignKey' => 'administrator_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),*/
		'Download' => array(
			'className' => 'Download',
			'foreignKey' => 'administrator_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Link' => array(
			'className' => 'Link',
			'foreignKey' => 'administrator_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
