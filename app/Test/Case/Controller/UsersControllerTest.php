<?php
App::uses('UsersController', 'Controller');

/**
 * UsersController Test Case
 */
class UsersControllerTest extends ControllerTestCase {

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
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
	/*	$data = array(
			'id' => 1,
			'activated' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'lastname1' => 'Lorem ipsum dolor sit amet',
			'lastname2' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'country' => 'Lorem ipsum dolor sit amet',
			'state' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'role' => 'Lorem ipsum dolor sit amet',
			'image' => 'Lorem ipsum dolor sit amet',
			'image_dir' => 'Lorem ipsum dolor sit amet',
			'tokenhash' => 'Lorem ipsum dolor sit amet'
		);
		$this->testAction('/users/login');
		$this->testAction('/users/index');
    	$this->assertInternalType('array', $this->vars['users']);*/
	}

/**
 * testViewManagers method
 *
 * @return void
 */
	public function testViewManagers() {
		$this->markTestIncomplete('testViewManagers not implemented.');
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$this->markTestIncomplete('testView not implemented.');
	}

/**
 * testLogin method
 *
 * @return void
 */
	public function testLogin() {
	  $UsersController = $this->generate( 'Users', array(
                'components' => array(
                    'Auth' => array( 'user' )
                ),
            )
        );

        $UsersController->Auth->expects( $this->any() )
        ->method( 'user' )
        ->with( 'id' )
        ->will( $this->returnValue( 2 ) );

        $data = array( 'User' => array(
                'username' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'remember_me' => 1
            ) );

        //$UsersController->Auth->login( $data['User'] );

        $this->testAction( '/users/login', array( 'data' => $data, 'method' => 'get' ) );
        $url = parse_url( $this->headers['pages'] );
        $this->assertEquals( $url['path'], '/index' );
    }

/**
 * testLogout method
 *
 * @return void
 */
	public function testLogout() {
		 $this->markTestIncomplete('testLogout not implemented.');
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$this->markTestIncomplete('testEdit not implemented.');
	}

/**
 * testEditrol method
 *
 * @return void
 */
	public function testEditrol() {
		$this->markTestIncomplete('testEditrol not implemented.');
	}

/**
 * testEditactivated method
 *
 * @return void
 */
	public function testEditactivated() {
		$this->markTestIncomplete('testEditactivated not implemented.');
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$this->markTestIncomplete('testAdd not implemented.');
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		$this->markTestIncomplete('testDelete not implemented.');
	}

/**
 * testSendMail method
 *
 * @return void
 */
	public function testSendMail() {
		$this->markTestIncomplete('testSendMail not implemented.');
	}

/**
 * testForgotPassword method
 *
 * @return void
 */
	public function testForgotPassword() {
		$this->markTestIncomplete('testForgotPassword not implemented.');
	}

/**
 * testReset method
 *
 * @return void
 */
	public function testReset() {
		$this->markTestIncomplete('testReset not implemented.');
	}

}
