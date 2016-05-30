<?php
App::uses('Logbook', 'Model');

/**
 * Logbook Test Case
 */
class LogbookTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.logbook',
		'app.user',
		'app.administrator',
		'app.download',
		'app.link',
		'app.picture',
		'app.category',
		'app.pictures_user',
		'app.categorie'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Logbook = ClassRegistry::init('Logbook');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Logbook);

		parent::tearDown();
	}

}
