<div class="container">
	<div class="row">
		<div class="col-md-6">

			<div class="page-header">
				<h2><?php echo $user['User']['name'].' '.$user['User']['lastname1'].' '.$user['User']['lastname2']; ?></h2>
			</div>
			<div class="row">

				<div class="col col-sm-7">

				
					Email: <?php echo h($user['User']['email']); ?>
					<br/>
					<br/>
					País: <?php echo h($user['User']['country']); ?>
					<br/>
					<br/>
					Estado: <?php echo h($user['User']['state']); ?>
					<br/>
					<br/>
					Ciudad: <?php echo h($user['User']['city']); ?>
					<br/>
					<br/>
					<?php if(($user['User']['role']=='Administrador')||($user['User']['role']=='Administrador')): ?>
					Escpecialidad: <?php echo h($user['Administrator']['0']['specialty']); ?>
					<br/>
					<br/>
					Escpecialidad: <?php echo h($user['Administrator']['0']['curriculum']); ?>
					<br/>
					<br/>
					Escpecialidad: <?php echo h($user['Administrator']['0']['institution']); ?>
					<br/>
					<br/>
					Escpecialidad: <?php echo h($user['Administrator']['0']['publication']); ?>
					<br/>
					<br/>

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
					<?php echo $this->Html->image('../files/user/image/' .$user['User']['image_dir'] . '/' . 'vga_' .$user['User']['image'], array('class' => 'img-thumbnail img-responsive')); ?>
				</div>
			</div>

		</div>
	</div>
</div>
























