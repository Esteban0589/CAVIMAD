<?php
App::uses('AppModel', 'Model');
/**
 * 
 * NewsEventsPicture Model
 * 
 * Modelo que contiene las validaciones de los campos de NewsEventsPicture y sus relaciones con los otros modelos.
 *
 * @property User $User
 * @property News $News
 * @property Event $Event
 */
class NewsEventsPicture extends AppModel {
	
	/*
     * actAs 
     *
     * Modulo necesario paraagregar fotos
     *
     * @var string
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
	 * belongsTo associations
	 * 
	 * Contiene las relaciones de pertenece con los modelos de User, News y Event
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
		),
		'News' => array(
			'className' => 'News',
			'foreignKey' => 'news_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'event_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/**
	 * validate
	 * 
	 * Contiene las validaciones para las fotos, de manera que tengan el formato .jpg o .png
	 *
	 * @var image
	 */
	public $validate = array(
 		// valida que la imagen sea solamente jpg y png
 		  'image' => array(
             'rule' => array(
                 'extension',
                 array( 'png', 'jpg')
             ),
             'message' => 'Por favor agregue una imagen valida.'
        )
 	);
}
