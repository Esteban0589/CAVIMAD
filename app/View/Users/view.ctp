<div class="container">
	<div class="row">
		<div class="col-md-6">

			<div class="page-header">
				<h2><?php echo $user['User']['name'].' '.$user['User']['lastname1'].' '.$user['User']['lastname2']; ?></h2>
			</div>
			<div class="row">

				<div class="col col-sm-7">

				
					<h5>Email:</h5> <?php echo h($user['User']['email']); ?>
					<h5>País:</h5> <?php echo h($user['User']['country']); ?>
					<h5>Estado:</h5> <?php echo h($user['User']['state']); ?>
					<h5>Ciudad:</h5> <?php echo h($user['User']['city']); ?>
					<h5>Institución:</h5> <?php echo h($user['User']['institution']); ?>
					<h5>Ocupación:</h5> <?php echo h($user['User']['occupation']); ?>
						<?php if(($user['User']['role']=='Administrador')||($user['User']['role']=='Colaborador')): ?>
					<h5>Escpecialidad:</h5> <?php echo h($user['Administrator']['0']['specialty']); ?>
					<h5>Publicaciones:</h5>
						<p><?php echo nl2br(h($user['Administrator']['0']['publication'])); ?> </p>
					<h5>Curriculum:</h5> 
						<p><?php echo nl2br( h($user['Administrator']['0']['curriculum'])); ?> </p>
					
					

					<?php endif; ?>

					<!--<div class="actions">-->
<!--	<h3><?php echo __('Actions'); ?></h3>-->
<!--	<ul>-->
<!--		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>-->
<!--		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('List Administrators'), array('controller' => 'administrators', 'action' => 'index')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('New Administrator'), array('controller' => 'administrators', 'action' => 'add')); ?> </li>-->
<!--	</ul>-->
<!--</div>-->

				</div>


				<div class="col col-sm-5">
					<?php 
					if (!empty($user['User']['image_dir'])){
						echo $this->Html->image('../files/user/image/' .$user['User']['image_dir'] . '/' . 'vga_' .$user['User']['image'], array('class' => 'img-thumbnail img-responsive')); 
					}else{
						echo $this->Html->image('usuario.jpg');
					}
					?>
				</div>
			</div>

		</div>
	</div>
</div>
























