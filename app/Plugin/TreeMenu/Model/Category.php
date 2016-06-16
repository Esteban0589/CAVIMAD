<?php

App::uses('TreeMenuAppModel', 'TreeMenu.Model');

/**
 * Category Model
 *
 */
class Category extends TreeMenuAppModel {

    public $actsAs = array('Tree',
        'TreeMenu.Slug' => array('field' => 'name', 'slug_field' => 'slug', 'primary_key' => 'id', 'replacement' => '_', 'DBcheck' => true),
    );

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'El nombre no debe estar vacío.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Ya existe otro nivel taxónomico con ese nombre.',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
        ),
        

    );

    public function afterSave($created, $options = array()) {
        parent::afterSave($created,$options);

        Cache::clear();
        clearCache();
    }

    public function afterDelete() {
        parent::afterDelete();

        Cache::clear();
        clearCache();
    }

    public function getAllCategory($alias = null) {
        if (($categories = Cache::read('getAllCategory_' . $alias)) === false) {
            $conditions = array();
            if ($alias) {
                $conditions['Category.alias'] = $alias;
            }else{
                $conditions[] = 'Category.alias IS NULL';
            }
            $categories = $this->find('all', array('conditions' => $conditions,
                'fields' => array('Category.id', 'Category.parent_id', 'Category.name', 'Category.published'),
                'order' => array('Category.lft' => 'ASC')
                    ));
            Cache::write('getAllCategory_' . $alias, $categories);
        }
        return $categories;
    }

    public function _generateTreeList($alias = null) {
        if (($categories = Cache::read('GenerateTreeList' . $alias)) === false) {
            $conditions = null;
            if ($alias) {
                $conditions['Category.alias'] = $alias;
            }else{
                $conditions[] = 'Category.alias IS NULL';
            }
            $categories = $this->generateTreeList($conditions);
            Cache::write('GenerateTreeList' . $alias, $categories);
        }
        return $categories;
    }

}
