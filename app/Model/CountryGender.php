<?php
App::uses('AppModel', 'Model');
/**
 * Administrator Model
 * 
 * Modelo que contiene las validaciones de los campos de CountryGender
 *
 */
class CountryGender extends AppModel {

/**
 * Use table
 * 
 * Este Modelo queriere de la tabla country_gender.
 *
 * @var mixed False or table name
 */
	public $useTable = 'country_gender';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 * 
 * Declaracion de relacion de pertenencia a el modelo de generos
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
