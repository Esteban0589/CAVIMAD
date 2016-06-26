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
 * @var string
 */
	public $displayField = 'image';
	
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
    
    public $validate = array(
		
		  'image' => array(
            'rule' => array(
                'extension',
                array( 'png', 'jpg')
            ),
            'message' => 'Por favor agregue una imagen valida.'
        )
	);

}
