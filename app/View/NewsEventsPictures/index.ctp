<div class="newsEventsPictures index">
	<h2><?php echo __('News Events Pictures'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('image'); ?></th>
			<th><?php echo $this->Paginator->sort('image_dir'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('news_id'); ?></th>
			<th><?php echo $this->Paginator->sort('event_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($newsEventsPictures as $newsEventsPicture): ?>
	<tr>
		<td><?php echo h($newsEventsPicture['NewsEventsPicture']['id']); ?>&nbsp;</td>
		<td><?php echo h($newsEventsPicture['NewsEventsPicture']['image']); ?>&nbsp;</td>
		<td><?php echo h($newsEventsPicture['NewsEventsPicture']['image_dir']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($newsEventsPicture['User']['name'], array('controller' => 'users', 'action' => 'view', $newsEventsPicture['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($newsEventsPicture['News']['title'], array('controller' => 'news', 'action' => 'view', $newsEventsPicture['News']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($newsEventsPicture['Event']['title'], array('controller' => 'events', 'action' => 'view', $newsEventsPicture['Event']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $newsEventsPicture['NewsEventsPicture']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $newsEventsPicture['NewsEventsPicture']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $newsEventsPicture['NewsEventsPicture']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $newsEventsPicture['NewsEventsPicture']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New News Events Picture'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List News'), array('controller' => 'news', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New News'), array('controller' => 'news', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
