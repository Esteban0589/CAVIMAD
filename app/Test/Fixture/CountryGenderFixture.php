<?php
/**
 * CountryGender Fixture
 */
class CountryGenderFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'country_gender';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'belize' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'costa_rica' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'el_salvador' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'guatemala' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'honduras' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'mexico' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'nicaragua' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'panama' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'id_gender' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'belize' => 1,
			'costa_rica' => 1,
			'el_salvador' => 1,
			'guatemala' => 1,
			'honduras' => 1,
			'mexico' => 1,
			'nicaragua' => 1,
			'panama' => 1,
			'id_gender' => 1
		),
	);

}
