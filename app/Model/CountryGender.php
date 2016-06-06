<?php
App::uses('AppModel', 'Model');
/**
 * CountryGender Model
 *
 * @property Gender $Gender
 */
class CountryGender extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'country_gender';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Gender' => array(
			'className' => 'Gender',
			'foreignKey' => 'gender_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
