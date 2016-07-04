<?php
App::uses('AppModel', 'Model');
/**
 * Picture Model
 *
 */
class Picture extends AppModel {

/**
 * Display field
 * 
 * Campo a mostrar para cuando se llame eventos mediante relaciones.
 *
 * @var string
 */
	public $displayField = 'image';
	
	/**
	 * actsAs
	 * 
	 * Verificación de datos al momento de guardar imagenes de taxones
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
 * Validation rules
 * 
 * Reglas de validacion para las imagenes de taxones
 *
 * @var array
 */
     public $validate = array(
 		// verifica que la imagen solo sea jpg y png
 		  'image' => array(
             'rule' => array(
                 'extension',
                 array( 'png', 'jpg')
             ),
             'message' => 'Por favor agregue una imagen valida.'
        )
 	);

}
