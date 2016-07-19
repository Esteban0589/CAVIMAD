<?php
App::uses('AppModel', 'Model');
/**
 * HomePicture Model
 * 
 * Modelo que contiene las validaciones de los campos de HomePicture y sus relaciones con los otros modelos.
 *
 */
class HomePicture extends AppModel {

    /*
     * Display field
     * 
     * Campo a mostrar para cuando se llame a HomePicture mediante relaciones.
     *
     * @var string
     */
	public $displayField = 'title';
	
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
                // valida el tamaño de la iamgen
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
     * Validation rules
     * 
     * Contiene las validaciones de los campos para el modelo HomePicture
     *
     * @var array
     */
	public $validate = array(
	    // valida que el titulo no sea vacio
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
		// valida que la imagen sea png o jpg
		  'image' => array(
            'rule' => array(
                'extension',
                array( 'png', 'jpg')
            ),
            'message' => 'Por favor agregue una imagen valida.'
        )
	);
}


