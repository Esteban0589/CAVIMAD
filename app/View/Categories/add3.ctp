<style>
.democlass {
        display: block;

}
.hidden {
        display: none;

}
</style>
<script>
   //Este script se utiliza para esconder o mostrar secciones de dropdown según lo seleccionado.
   $(document).ready(function() {
   	
	   	$("#drop1").change(function(){
	        $(this).find("option:selected").each(function(){
	            if($(this).attr("value")=="Familia"){
					document.getElementById("familia").setAttribute("class", "democlass"); 
					document.getElementById("genero").setAttribute("class", "hidden"); 
	            }
	            else if($(this).attr("value")=="Genero"){
	                document.getElementById("familia").setAttribute("class", "hidden"); 
   					document.getElementById("genero").setAttribute("class", "democlass"); 
	            }
	            else{
	                document.getElementById("familia").setAttribute("class", "hidden");
		            document.getElementById("genero").setAttribute("class", "hidden");
	            }
	        });
	    }).change();
   });
   	
   	
   	
</script>


<body>

 <div id="k-body"><!-- content wrapper -->
    
	<div class="container"><!-- container -->
    
    	<?php if($_SESSION['role']=='Administrador'): ?> 
    	
        <div class="row"><!-- row -->
            
			<div class="col-lg-12 col-md-12"><!-- doc body wrapper -->
				<div class="categories form">
						
					<ul class="breadcrumb">
					    <li>
					    	<!--Ruta del arbol-->
							<?php echo $this->Html->link(__('Manejar niveles taxonómicos'), array('action'=>'index', 'alias'=>$alias));?>
							<span class="divider">/</span>
						</li>
					    <li class="active"><?php echo __('Agregar taxón'); ?></li>
					</ul>
					<?php echo $this->Form->create('Category', array('class'=>'form-horizontal','onsubmit' => "return confirm(\"Recuerde que la clasificación debe de tener congruencia con respecto a su padre\");"));?>
					<fieldset class="col-lg-4 col-md-4" >
						
						<!--Titulo principal-->
						<h2><?php echo __('Agregar nivel taxonómico'); ?></h2>
						<div title="Seleccione el taxón padre">
						<?php echo $this->Form->input('parent_id', array('div'=>'control-group','placeholder'=>'','options'=>$parentCategories,
										'empty'=>array('0'=>__('Root')),
										'before'=>'<label class="control-label">'.__('Padre').'</label><div class="controls">',
										'after'=>$this->Form->error('parent_id', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
										'label'=>false, 'class'=>'form-control'));?></div>

						<div title="Seleccione la clasificación del nuevo taxón">
						<?php echo $this->Form->input('classification', array('div'=>'control-group','id'=>'drop1','placeholder'=>'','options'=>$classification,
										'before'=>'<label class="control-label">'.__('Clasificación').'</label><div class="controls">',
										'after'=>$this->Form->error('classification', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
										'error' => array('attributes' => array('style' => 'display:none')),
										'label'=>false, 'class'=>'form-control'));?></div>
						<?php echo $this->Form->input('name', array('div'=>'control-group','placeholder'=>'','title'=>'Ingrese el nombre del nivel taxonómico',
										'before'=>'<label class="control-label">'.__('Nombre').'</label><div class="controls">',
										'after'=>$this->Form->error('name', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
										'error' => array('attributes' => array('style' => 'display:none')),
										'label'=>false, 'class'=>'form-control'));?>
						<div title="Introduzca el slug del nuevo taxón">		
						<?php echo $this->Form->input('slug', array('type'=>'hidden','div'=>'control-group','placeholder'=>'', 'readonly'=>true,
										'before'=>'<label class="control-label">'.__('Slug').'</label><div class="controls">',
										'after'=>$this->Form->error('slug', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
										'error' => array('attributes' => array('style' => 'display:none')),
										'label'=>false, 'class'=>'form-control'));?></div>
						<?php echo $this->Form->input('description', array('type'=>'textarea','rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese una breve descripción del nivel taxonómico ingresado. Campo de texto expandible',
										'before'=>'<label class="control-label">'.__('Descripción').'</label><div class="controls">',
										'after'=>$this->Form->error('description', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
										'error' => array('attributes' => array('style' => 'display:none')),
										'label'=>false));?>

							<?php echo $this->Form->input('published', array('div'=>'control-group', 'type'=>'hidden','value'=>'0','placeholder'=>'',
										'before'=>'<label class="control-label">'.__('Publicado').'</label><div class="controls">',
										'after'=>$this->Form->error('published', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
										'error' => array('attributes' => array('style' => 'display:none')),
										'label'=>false, 'class'=>''));
								// Este publis se asigno oculto debido a que la funcionalidad del plugin no esta clara.
							?>
							
									<div id="familia" class="hidden" >
										<?php echo $this->Form->input('Family.0.id'); ?>
										<?php echo $this->Form->input('Family.0.author', array('required' => false,'div'=>'control-group','style' => 'display:inherit','placeholder'=>'','title'=>'Ingrese el nombre del nivel taxonómico',
										'before'=>'<label class="control-label">'.__('Fam').'</label><div class="controls">',
										'after'=>$this->Form->error('Family.0.author', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
										'error' => array('attributes' => array('style' => 'display:none')),
										'label'=>false, 'class'=>'form-control' ));?>
										ASDASDSADSADSAD
										SADASD
										
									
										
										
										<br>
										
										
									</div>
									
									
									<div id="genero" class="hidden" >
										<?php echo $this->Form->input('Gender.0.id'); ?>
										<?php echo $this->Form->input('Gender.0.author', array('required' => false,'div'=>'control-group','placeholder'=>'','title'=>'Ingrese el nombre del nivel taxonómico',
										'before'=>'<label class="control-label">'.__('Gen').'</label><div class="controls">',
										'after'=>$this->Form->error('Gender.0.author', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
										'error' => array('attributes' => array('style' => 'display:none')),
										'label'=>false, 'class'=>'form-control'));?>
											
										<br>
									</div>

							
							
							<br>
					        <div class="form-actions">
							<?php echo $this->Form->end(array('label'=>'Crear Taxón', 'class'=>'btn btn-primary')); ?>


<!--<?php echo $this->Form->submit(__('Guardar'), array('class'=>'btn btn-primary', 'div'=>false,'title'=>'Guardar los datos ingresados','onclick'=>"myFunction()"));?>            -->

					            <!--La siguiente linea fue comentada debido a que el reset solamente limpia el formulario y no tiene mucho uso-->
					            <!--<?php echo $this->Form->reset(__('Cancelar'), array('class'=>'btn', 'div'=>false));?>        -->
								<br>
								<br>
				            </div>
						</fieldset>
					<?php echo $this->Form->end();?>
						
					</div>
        	</div> 
     	</div>
     	
     	<?php endif; ?>
		<?php if($_SESSION['role']!='Administrador'): ?>
            	<div class="alert alert-warning alert-dismissable">
                	<p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           		</div>
   		<?php endif; ?>     
     	
    </div> 
 </div>
 
 </body>