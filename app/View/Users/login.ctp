<section id="form"><!--form-->
	<div class="container">
		<div class="row" align="center">
			<div class="col-lg-4 col-md-4">
				<div class="login-form"><!--login form-->
					<?php echo $this->Flash->render('auth'); ?>
					<?php echo $this->Form->create('User'); ?>
               		<fieldset>
						<div class="title-median text-info" >
							<h2 class="text-info">Ingresa tu usuario</h1>
							<?php 
							echo $this->Form->input('username', array('label'=>' ','type'=>'text','placeholder' => 'ejemplo@ejemplo.com'));?>
						</div>
						<div class="title-median text-info">
							<h2 class="text-info">Ingresa tu contraseña</h1>
							<?php echo $this->Form->input('password', array('label'=>' ','placeholder' => 'Contraseña'));?>
						</div>
						<div>&nbsp</div>   
					<?php 
						echo $this->Form->button(__('Ingresar'), array(
							'class' => 'custom-button2 cb-gray2',
							'div' => false,
							));
							echo $this->Form->end();
       		     	?>
       		    <div>&nbsp</div>
       		   		<?php 
						echo $this->Html->link(__('¿Olvidaste tu contraseña?'), array('action' => 'forgot_password'), array(
							'class' => 'custom-button3 cb-gray2',
							));?>
				</fieldset>
			</div><!--/login form-->
			</div>
			<div class="col-lg-4 col-md-4">
				<h1 class="text-info">O</h1>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="signup-form text-info"><!--sign up form-->
					<h2 class="text-info">¿No estás registrado?</h2>
					<form action="#">
						<p>
							<?php echo $this->Html->link(__('Registrate'), array('action' => 'add'), array(
								'class' => 'custom-button4 cb-gray2 ',
								'role' => 'button'
							)); ?>
						</p>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->
