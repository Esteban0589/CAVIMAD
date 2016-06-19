<?php
App::uses('AppModel', 'Model');
/**
 * Link Model
 *
 * @property Administrator $Administrator
 */
class Link extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

}
