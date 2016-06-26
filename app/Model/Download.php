<?php 
class Download extends AppModel{
    
    /**
 * Download Model
 * 
 * Modelo que contiene las validaciones de los campos de Download.
 *
 * @property Administrator $Administrator
 * @property Picture $Picture
 */
   
   /**
	 * validate
	 * 
	 * Manejo de los archivos
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
    'title' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'El nombre no debe estar vacío.',
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'El título ya ha sido utilizado.',
	)
    )
);
}
?>