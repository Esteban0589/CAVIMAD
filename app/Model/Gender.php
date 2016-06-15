<?php
App::uses('AppModel', 'Model');
/**
 * Gender Model
 *
 * @property Familie $Familie
 * @property Species $Species
 */
class Gender extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */

	public $validate = array(
		'report' => array(
        'rule1' => array(
            'rule'    => array(
            'extension',array('pdf')),
            'message' => 'Please upload pdf file only'
         ),
        'rule2' => array(
            'rule'    => array('fileSize', '<=', '4MB'),
            'message' => 'File must be less than 4MB'
        )
    ),
		
		
		
		// 'characteristic' => array(
		// 	//Verifica que en el campo de características se puedan agregar caracteres alfanuméricos. 
		// 	'alphaNumeric' => array(
		// 		'rule' => array('alphaNumeric'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'bibliography' => array(
		// 	//Verifica que en el campo de características se puedan agregar caracteres alfanuméricos. 
		// 	'alphaNumeric' => array(
		// 		'rule' => array('alphaNumeric'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'author' => array(
		// 	//Verifica que en el campo de características se puedan agregar caracteres alfanuméricos. 
		// 	'alphaNumeric' => array(
		// 		'rule' => array('alphaNumeric'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		'globaldistribution' => array(
			//Verifica que la distribución global no sea vacía
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'habitat' => array(
			//Verifica que el hábitat no sea vacía
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),

		'biologyandecology' => array(
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
 * belongsTo associations
 *
 * @var array
 */
		public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * Relación del modelo de género con el modelo de categorías.
 *
 * @var array
 */
	public $hasMany = array(
		'Species' => array(
			'className' => 'Species',
			'foreignKey' => 'gender_id',
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
		'CountryGender' => array(
			'className' => 'CountryGender',
			'foreignKey' => 'gender_id',
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
