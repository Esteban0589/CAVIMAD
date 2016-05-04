<?php
App::uses('User', 'Model');

/**
 * User Test Case
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.administrator',
		/*'app.download',
		'app.link',
		'app.picture',
		'app.pictures_user'*/
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}


	public function testSave() {
        $data = array(
			'id' => 1,
			'activated' => 1,
			'name' => 'Jose',
			'lastname1' => 'Lopez',
			'lastname2' => 'Lopez',
			'email' => 'jose@ejemplo.com',
			'country' => 'CR',
			'state' => 'SJ',
			'city' => 'SP',
			'username' => 'jose.lopez',
			'password' => 'Jose.lopez1',
			'role' => 'Usuario',
			'image' => '',
			'image_dir' => '',
			'tokenhash' => ''
		);
        $result = $this->User->save($data);
        $this->assertTrue(!empty($this->User->id));
    }

	
}
