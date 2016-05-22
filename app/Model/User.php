<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 * 
 * Modelo que contiene las validaciones de los campos de User y las relaciones que existan con otros modelos.
 *
 * @property Administrator $Administrator
 * @property Picture $Picture
 */
class User extends AppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'name';

	/**
	 * actsAs
	 * 
	 * Manejo de las imágenes de los usuarios
	 * @var array
	 */
 	public $actsAs = array(
        'Upload.Upload' => array(
            'image' => array(
                'fields' => array(
                    'dir' => 'image_dir'
                ),
                'thumbnailMethod'  => 'php',
                'thumbnailSizes' => array(
                	'vga' => '640x480',
                	'thumb' => '150x150'
                ),
                'deleteOnUpdate' => true,
                'deleteFolderOnDelete' => true
            )
        )
    );


	/**
	 * Reglas para la validación de los campos del modelo
	 *
	 * @var array
	 */
	public $validate = array(
		'name' => array(
			//Verifica que el nombre del usuario no sea vacío
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'El nombre no debe estar vacío.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que el tamaño del nombre no supere el máximo de caracteres establecido
			'maxLength' => array(
				'rule' => array('maxLength', 20),
				'message' => 'El nombre debe tener más de 20 caracteres.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lastname1' => array(
			//Verifica que el primer apellido del usuario no sea vacío
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'El primer apellido no debe ser vacío.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que el tamaño del primer apellido no supere el máximo de caracteres establecido
			'maxLength' => array(
				'rule' => array('maxLength', 30),
				'message' => 'El primer apellido no debe tener más de 30 caracteres.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lastname2' => array(
			/*'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
			//Verifica que el tamaño del primer apellido no supere el máximo de caracteres establecido
			'maxLength' => array(
				'rule' => array('maxLength', 30),
				'message' => 'El segundo apellido no debe tener más de 30 caracteres.',
				// 'allowEmpty' => true,
				// 'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			//Verifica que el email corresponda al formato de un correo electrónico válido
			'email' => array(
				'rule' => array('email'),
				'message' => 'Por favor ingresar un correo electrónico válido.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que el email del usuario no sea vacío
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'El email no debe estar vacío.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que el email del usuario no supere el máximo de caracteres establecido
			'maxLength' => array(
				'rule' => array('maxLength', 50),
				'message' => 'El email no debe tener más de 50 caracteres.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que el email del usuario no haya sido ingresado anteriomente
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'El correo electrónico ya ha sido registrado.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'country' => array(
			//Verifica que el país no sea vacío
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo no debe estar vacío.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que el país ingresado no supere el máximo de caracteres establecido
			'maxLength' => array(
				'rule' => array('maxLength', 20),
				'message' => 'Este campo no debe contener más de 20 caracteres.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'state' => array(
			//Verifica que el estado no sea vacío
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo no debe estar vacío.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que el estado no supere el máximo de caracteres establecido
			'maxLength' => array(
				'rule' => array('maxLength', 60),
				'message' => 'Este campo no debe contener más de 60 caracteres.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city' => array(
			//Verifica que la ciudad no sea vacía
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo no debe estar vacío.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que la ciudad no supere el máximo establecido de caracteres
			'maxLength' => array(
				'rule' => array('maxLength', 60),
				'message' => 'Este campo no debe contener más de 60 caracteres.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			//Verifica que el nombre de usuario no sea vacío
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'El nombre de usuario no debe estar vacío.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que el nombre de usuario sea alfanumérico
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'El nombre de usuario debe ser alfanumérico.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que el nombre de usuario no supere el máximo de caracteres establecido
			'maxLength' => array(
				'rule' => array('maxLength', 20),
				'message' => 'El nombre de usuario no debe contener más de 20 caracteres.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que le nombre de usuario no haya sido ingresado anteriormente
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'El nombre de usuario elegido ya está siendo utilizado.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			//Verifica que la contraseña no sea vacía
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Contraseña no debe ser vacía.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que la contraseña sea aceptada por la expresión regular definida
			'regex' => array(
				//Restringe que la contraseña contenga al menos una letra mayúscula, una letra minúscula, un número y un caracter especial.
				'rule' => '(^[a-zA-Z0-9_]+[\.\!\"\#\$\%\&\/\(\)\=\:\,\;\@\[a-zA-Z0-9]*]*)',
				//'rule' => array('alphaNumeric'),
				'message' => 'Su contraseña debe contener al menos una mayúscula, una minúscula y un número.',
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que la contraseña no supere el máximo de caracteres establecido
			'maxLength' => array(
				'rule' => array('maxLength', 16),
				'message' => 'La contraseña no debe contener más de 16 caracteres.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//Verifica que la contraseña no sea menor al mínimo de caracteres establecido
			'minLength' => array(
				'rule' => array('minLength', 6),
				'message' => 'La contraseña no debe contener menos de 6 caracteres.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'role' => array(
			/*'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
			'inList' => array(
				'rule' => array('inList'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
		),/*
		'image_dir' => array(
			'url' => array(
				'rule' => array('url'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
		'institution' => array(
			/*'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
		),
	
		'occupation' => array(
			/*'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
		),
	
	
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * Relación con el modelo de Administrator.
 *
 * @var array
 */
	public $hasMany = array(
		'Administrator' => array(
			'className' => 'Administrator',
			'foreignKey' => 'user_id',
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


/**
 * Relación con el modelo Picture
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Picture' => array(
			'className' => 'Picture',
			'joinTable' => 'pictures_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'picture_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);
	
	/**
	 * beforeSave method
	 * 
	 * Realiza la encriptación de la contraseña antes de guardar los datos en la base de datos.
	 *
	 * @param array $options
	 * @return void
	 */
	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}

}
