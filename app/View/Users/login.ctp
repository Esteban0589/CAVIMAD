<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->

            
            <?php echo $this->Flash->render('auth'); ?>
            <?php echo $this->Form->create('User'); ?>
                <fieldset 'text_align':'center'>
                    <div title="Insert your username"><?php echo $this->Form->input('username', array('type'=>'text', 'label'=>'Username: ','placeholder' => 'example@example.com'));?></div>
                      <div>&nbsp</div>
                    <div title="Insert your password"><?php echo $this->Form->input('password', array('label'=>'Password: ','placeholder' => 'Password'));?></div>
                      <div>&nbsp</div>   
                </fieldset>
               	<?php 
                echo $this->Form->button(__('Login'), array(
								'class' => 'btn btn-default',
								'div' => false,
							));
							echo '<br />';
							echo $this->Form->end();
             	?>
            <div>&nbsp</div>
           <?php echo $this->Form->end();
							echo $this->Html->link(__('Forgot your password?'), array('action' => 'forgot_password'), array(
								'class' => 'btn btn-default'
							));?>
          
</div><!--/login form-->

				</div>
						<div class="col-sm-1">
							<h2>OR</h2>
						</div>
						<div class="col-sm-4">
							<div class="signup-form"><!--sign up form-->
								<h2>No Account?</h2>
								<form action="#">
									<p>
										<?php echo $this->Html->link(__('Create one!'), array('action' => 'add'), array(
											'class' => 'btn btn-default',
											'role' => 'button'
										)); ?>
									</p>
								</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
</section><!--/form-->
