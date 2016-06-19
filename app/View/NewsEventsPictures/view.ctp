<div class="newsEventsPictures view">
<h2><?php echo __('News Events Picture'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($newsEventsPicture['NewsEventsPicture']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($newsEventsPicture['NewsEventsPicture']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image Dir'); ?></dt>
		<dd>
			<?php echo h($newsEventsPicture['NewsEventsPicture']['image_dir']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($newsEventsPicture['User']['name'], array('controller' => 'users', 'action' => 'view', $newsEventsPicture['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('News'); ?></dt>
		<dd>
			<?php echo $this->Html->link($newsEventsPicture['News']['title'], array('controller' => 'news', 'action' => 'view', $newsEventsPicture['News']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($newsEventsPicture['Event']['title'], array('controller' => 'events', 'action' => 'view', $newsEventsPicture['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($newsEventsPicture['NewsEventsPicture']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($newsEventsPicture['NewsEventsPicture']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit News Events Picture'), array('action' => 'edit', $newsEventsPicture['NewsEventsPicture']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete News Events Picture'), array('action' => 'delete', $newsEventsPicture['NewsEventsPicture']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $newsEventsPicture['NewsEventsPicture']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List News Events Pictures'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New News Events Picture'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List News'), array('controller' => 'news', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New News'), array('controller' => 'news', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
