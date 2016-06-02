<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<div class="container">
	<h2><?php echo 'Error 404: Pagina no valida'; ?></h2>
	<p class="error">
		<strong><?php echo __d('cake', 'Error'); ?>: </strong>
		<?php printf(
			__d('cake', 'La pagina solicitada (%s) no existe.'),
			"<strong>'{$url}'</strong>"
		); ?>
	</p>
	<?php
	if (Configure::read('debug') > 0):
		echo $this->element('exception_stack_trace');
	endif;
	?>
</div>
