<script>
	$(document).ready(function() {
	    $('#example').DataTable( {
	         dom: 'Bfrtip',
	         colReorder: true,
    buttons: [
        'colvis',
        'print',
        'excel', 
        'pdf',
        'copy',
        
    ]
	    });
});
</script>


<div class="container">
	<div class="event index">
		<?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>
		<h2>
			<?php echo $this->Html->link(__(''), array('controller'=>'users','action' => 'controlpanel'), array('class' => 'glyphicon glyphicon-arrow-left','title' =>'Volver a panel de control', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
			<?php echo __('Eventos'); ?>
			<?php echo $this->Html->link(__('Agregar evento'), array('action' => 'add'), array('class' => 'glyphicon glyphicon-upload','title' =>'Agregar imagen', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
			
		</h2>
		<div class="col-lg-12 ">
			<table id="example" class="display" cellpadding="0" cellspacing="0">
			<thead>
			<tr>
					<th class="col-lg-2 ">Titulo</th>
					<th class="col-lg-4 ">Descripción</th>
					<th class="col-lg-2 ">Creada</th>
					<th class="col-lg-2 ">Modificada</th>
					<th class="col-lg-2">Acciones</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($events as $homePicture): ?>
			<tr>
				<td class="col-lg-2"><?php echo h($homePicture['Event']['title']); ?>&nbsp;</td>
				<td class="col-lg-4 ">
				<?php 
				echo  substr(($homePicture['Event']['description']),0,100);
				echo $this->Html->link(__('...mas'), array('action' => 'view', $homePicture['Event']['id']), array('title'=>'Ver todos los detalles del evento'));
				?>&nbsp;</td>
				<td class="col-lg-2"><?php echo h($homePicture['Event']['created']); ?>&nbsp;</td>
				<td class="col-lg-2"><?php echo h($homePicture['Event']['modified']); ?>&nbsp;</td>

				<td class="actions col-lg-2">
					<?php echo $this->Html->link(__(''), array('action' => 'view', $homePicture['Event']['id']), array('title'=>'Ver todos los detalles del evento','class' => 'glyphicon glyphicon-eye-open', 'style' => 'font-size:25px; padding: 5px;')); ?>
					<?php echo $this->Html->link(__(''), array('action' => 'edit', $homePicture['Event']['id']),array('title'=>'Editar la información del evento','class' => 'glyphicon glyphicon-pencil', 'style' => 'font-size:25px; padding: 5px;')); ?>
					<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $homePicture['Event']['id']), array('title'=>'Eliminar evento','class' => 'glyphicon glyphicon glyphicon-trash', 'style' => 'font-size:25px; padding: 5px;'), __('Atención se va a el evento # %s', $homePicture['Event']['id'])); ?>
                  

				</td>
			</tr>
		<?php endforeach; ?>
			</tbody>
			</table>
		</div>
		<?php endif; ?>
		<?php if($this->Session->read('Auth')['User']['role'] !='Administrador'): ?>
        	<div class="alert alert-warning alert-dismissable">
                 <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           </div>
       <?php endif; ?> 
	</div>
</div>
