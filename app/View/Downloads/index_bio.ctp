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
        
    ]
	    });
});
</script>
<script>
	$(document).ready(function() {
	    $('#example2').DataTable( {
	         dom: 'Bfrtip',
	         colReorder: true,
    buttons: [
        'colvis',
        'print',
        'excel', 
        'pdf',
        
    ]
	    });
});
</script>


<div class="container">
	<div class="row">
		<h1><?php echo __('Biomonitoreo'); ?></h1>
		<h4><div style="color: #3891d6"><?php echo __('Descripción'); ?></div></h4>
		<p align="justify">Los macroinvertebrados dulceacuícolas son excelentes indicadores biológicos de la calidad de agua y del impacto ambiental que causan las diversas actividades humanas sobre los ambientes acuáticos. Por lo  tanto, se han desarrollado muchos métodos e índices para utilizar estos organismos en programas de biomonitoreo en diversas partes del mundo, incluyendo varios países de Latinoamérica.
		</p>
		<p align="justify">
			En esta sección encontrará información útil relacionada con el tema del biomonitoreo acuático.
		</p>
		
		
	    <div class="col-md-12">
			<h2 title= "Lista de Enlaces"><?php echo __('Enlaces'); ?>
				<?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>
					<?php echo $this->Html->link(__('Agregar enlace'), array('controller'=>'links','action' => 'add_bio'), array('class' => 'glyphicon glyphicon-upload','title' =>'Agregar enlace', 'style'=>'color: #3891D4;    font-size:25px; padding: 5px;')); ?>
				 <?php endif; ?>
			 </h2>
			
			<div class="row small k-equal-height"><!-- row -->
                              
				 <div class="col-lg-12 col-md-6 col-sm-12">
									
					<table id="example" class="display" cellspacing="0" width="100%">
					        <thead>
                                <tr>
					                <th>Título</th>
					                <th>Enlace</th>
					                <th>Descripción</th>
					                <th>Categoría</th>
					                <?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>
					                	<th>Acciones</th>
					                <?php endif; ?>
					            </tr>
					        </thead>
					        <tbody>
					           	<?php foreach ($Enlace as $link): ?>
						        	<tr>
										<td><?php echo h($link['title']); ?>&nbsp;</td>
										<td class="actions" >
											<?php echo $this->Html->link($link['url']);?>
										</td>
										<td><?php echo h($link['description']); ?>&nbsp;</td>
										<td><?php echo h($link['relatedpage']); ?>&nbsp;</td>
										<?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>
											<td>
												<?php echo $this->Html->link(__(''), array('controller'=>'links','action' => 'edit_bio', $link['id']),array('title'=>'Editar la información del enlace','class' => 'glyphicon glyphicon-pencil', 'style' => 'font-size:25px; padding: 5px;')); ?>
												<?php echo $this->Form->postLink(__(''), array('controller'=>'links','action' => 'delete', $link['id']), array('title'=>'Eliminar enlace','class' => 'glyphicon glyphicon glyphicon-trash', 'style' => 'font-size:25px; padding: 5px;'), __('Atención se va a eliminar el enlace # %s', $link['id'])); ?>
											</td>
										<?php endif; ?>
									</tr>
								<?php endforeach; ?> 

					        </tbody>
					</table>
				</div>
			</div>
		</div>
	    
		<div class="col-md-12">
			<h2 title= "Lista de archivos pdf"><?php echo __('Archivos PDF'); ?>
				<?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>
					<?php echo $this->Html->link(__('Agregar documento'), array('action' => 'add_bio'), array('class' => 'glyphicon glyphicon-upload','title' =>'Agregar documento', 'style'=>'color: #3891D4;    font-size:25px; padding: 5px;')); ?>
				 <?php endif; ?>
			 </h2>
			
			<div class="row small k-equal-height"><!-- row -->
                              
				 <div class="col-lg-12 col-md-6 col-sm-12">
									
					<table id="example2" class="display" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th>Título</th>
					                <th>Descripción</th>
					                <th>Resumen</th>
					                <th>Archivo</th>
					                <?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>	
					                	<th>Acciones</th>
					                <?php endif;?>
					                
					            </tr>
					        </thead>
					        <tbody>
					           	<?php foreach ($Biomonitoreo as $Report): ?>
									<tr>
								    	<td><?php echo $Report['Download']['title']; ?>&nbsp;</td>
										<td><?php echo $Report['Download']['description']; ?>&nbsp;</td>
										<td><?php echo $Report['Download']['abstract']; ?>&nbsp;</td>
										<td class="actions" >
											<?php echo $this->Html->link(__(''), array('controller' => 'downloads', 'action' => 'viewdown', $Report['Download']['id'],true), array('class' => 'glyphicon glyphicon-file','title' =>'Descargar documento', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
										</td>
									 <?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>	

											<td>
												<?php echo $this->Html->link(__(''), array('action' => 'edit_bio', $Report['Download']['id']),array('title'=>'Editar la información del documento','class' => 'glyphicon glyphicon-pencil', 'style' => 'font-size:25px; padding: 5px;')); ?>
												<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $Report['Download']['id']), array('title'=>'Eliminar documento','class' => 'glyphicon glyphicon glyphicon-trash', 'style' => 'font-size:25px; padding: 5px;'), __('Atención se va a eliminar el documento # %s', $Report['Download']['id'])); ?>
											</td>
										<?php endif; ?>
									</tr>
								<?php endforeach; ?> 

					        </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<style>
		.dataTables_filter label, .dataTables_filter input {
			float: right;
			line-height: 40px;
		}
	</style>
</div>
