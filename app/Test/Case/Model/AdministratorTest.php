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
		/*'app.aboutus',
		'app.download',
		'app.link'*/
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

	public function testSave() {
        $data = array(
			'id' => 1,
			'specialty' => 'Alguna',
			'curriculum' => 'Varios',
			'institution' => 'Una institución',
			'publication' => 'Varias',
			'user_id' => 1
		);
        $result = $this->Administrator->save($data);
        $this->assertTrue(!empty($this->Administrator->id));
    }
}
