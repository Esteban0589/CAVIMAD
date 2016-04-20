<?php
App::uses('Administradore', 'Model');

/**
 * Administradore Test Case
 */
class AdministradoreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.administradore',
		'app.usuario',
		'app.familia',
		'app.familias_usuario',
		'app.genero',
		'app.generos_usuario',
		'app.descarga',
		'app.enlace',
		'app.sobre_nosotro',
		'app.publicacione',
		'app.administradores_publicacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Administradore = ClassRegistry::init('Administradore');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Administradore);

		parent::tearDown();
	}

}
