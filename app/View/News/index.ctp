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
	<div class="news index">
		<?php if($this->Session->read('role') =='Administrador'): ?>
		<h2>
			<?php echo __('Noticias'); ?>
			<?php echo $this->Html->link(__('Agregar Noticia'), array('action' => 'add'), array('class' => 'glyphicon glyphicon-upload','title' =>'Agregar imagen', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
			
		</h2>
		<div class="col-lg-8 ">
			<table id="example" class="display" cellpadding="0" cellspacing="0">
			<thead>
			<tr>
					<th class="col-lg-3 ">Titulo</th>
					<th class="col-lg-6">Descripción</th>
					<th class="col-lg-3" style="text-align: right;">Acciones</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($pictures as $homePicture): ?>
			<tr>
				<td class="col-lg-3"><?php echo h($homePicture['News']['title']); ?>&nbsp;</td>
				<td class="col-lg-6 ">
				<?php 
				echo  substr(($homePicture['News']['description']),0,100);
				echo $this->Html->link(__('...mas'), array('action' => 'view', $homePicture['News']['id']), array('title'=>'Ver todos los detalles de la imagen'));
				?>&nbsp;</td>

				<td class="actions col-lg-3" style="text-align: right;">
					<?php echo $this->Html->link(__(''), array('action' => 'view', $homePicture['News']['id']), array('title'=>'Ver todos los detalles de la imagen','class' => 'glyphicon glyphicon-eye-open', 'style' => 'font-size:25px; padding: 5px;')); ?>
					<?php echo $this->Html->link(__(''), array('action' => 'edit', $homePicture['News']['id']),array('title'=>'Editar la información de la imagen','class' => 'glyphicon glyphicon-pencil', 'style' => 'font-size:25px; padding: 5px;')); ?>
					<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $homePicture['News']['id']), array('title'=>'Eliminar el taxón','class' => 'glyphicon glyphicon glyphicon-trash', 'style' => 'font-size:25px; padding: 5px;'), __('Atención se va a eliminar la imagen # %s', $homePicture['News']['id'])); ?>
                  

				</td>
			</tr>
		<?php endforeach; ?>
			</tbody>
			</table>
		</div>
		<?php endif; ?>
		<?php if($this->Session->read('role') !='Administrador'): ?>
        	<div class="alert alert-warning alert-dismissable">
                 <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           </div>
       <?php endif; ?> 
	</div>
</div>
