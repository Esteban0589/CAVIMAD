<?php
/**
 * Family Fixture
 */
class FamilyFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'characteristic' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'bibliography' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'author' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'globaldistribution' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'habitat' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'categorie_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'categorie_id' => array('column' => 'categorie_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'characteristic' => 'Lorem ipsum dolor sit amet',
			'bibliography' => 'Lorem ipsum dolor sit amet',
			'author' => 'Lorem ipsum dolor sit amet',
			'globaldistribution' => 'Lorem ipsum dolor sit amet',
			'habitat' => 'Lorem ipsum dolor sit amet',
			'categorie_id' => 1
		),
	);

}
