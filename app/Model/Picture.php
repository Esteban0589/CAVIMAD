<?php
App::uses('AppModel', 'Model');
/**
 * Picture Model
 * 
 * Modelo que contiene las validaciones de los campos de Pictures y sus relaciones con los otros modelos.
 *
 * @property Categorie $Categorie
 * @property User $User
 */
 
class Picture extends AppModel {
	
	/**
	 * actsAs
	 * 
	 * Manejo de las imágenes de las categorías
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

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * Relación del modelo de pictures con el modelo de categorías.
 *
 * @var array
 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'categorie_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * Relación del modelo de pictures con el modelo de usuarios.
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'pictures_users',
			'foreignKey' => 'picture_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
