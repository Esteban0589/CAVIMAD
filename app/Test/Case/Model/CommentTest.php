<?php
App::uses('Comment', 'Model');

/**
 * Comment Test Case
 */
class CommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comment',
		'app.user',
		'app.administrator',
		'app.download',
		'app.link',
		'app.logbook',
		'app.picture',
		'app.pictures_user',
		'app.category',
		'app.gender',
		'app.species',
		'app.country_gender'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comment = ClassRegistry::init('Comment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comment);

		parent::tearDown();
	}

}
