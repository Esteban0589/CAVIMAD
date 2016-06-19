<div class="events view">
<h2><?php echo __('Events'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($events['Events']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($events['Events']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($events['Events']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($events['Events']['position']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Events'), array('action' => 'edit', $events['Events']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Events'), array('action' => 'delete', $events['Events']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $events['Events']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Events'), array('action' => 'add')); ?> </li>
	</ul>
</div>
