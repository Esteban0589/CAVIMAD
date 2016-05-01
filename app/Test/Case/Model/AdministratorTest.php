<?php
App::uses('Administrator', 'Model');

/**
 * Administrator Test Case
 */
class AdministratorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.administrator',
		'app.user',
		'app.aboutus',
		'app.download',
		'app.link'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Administrator = ClassRegistry::init('Administrator');
	}
	
	

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Administrator);

		parent::tearDown();
	}

}
