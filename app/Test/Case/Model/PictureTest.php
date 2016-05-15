<?php
App::uses('Picture', 'Model');

/**
 * Picture Test Case
 */
class PictureTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.picture',
		'app.categorie',
		'app.user',
		'app.administrator',
		'app.download',
		'app.link',
		'app.pictures_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Picture = ClassRegistry::init('Picture');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Picture);

		parent::tearDown();
	}

}
