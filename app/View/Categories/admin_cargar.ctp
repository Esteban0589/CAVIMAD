<!--Este style lo use para dalre formato a los botones de editar y eliminar cuando se esta en modo admin-->
<style>
/*363636 - 3891D4 - 860000*/

a{
    color: #363636;
}

.glyphicon-pencil:hover {
    color: #3891D4;
    font-size:25px; 
    padding: 5px;
}
.glyphicon-trash:hover {
    color: #860000;
    font-size:25px; 
    padding: 5px;
}


</style>

<script>
	$(document).ready(function() {
	    $('#example').DataTable( {
	    	"iDisplayLength": 5,
	         dom: 'Bfrtip',
	         colReorder: true,
    buttons: [
    ]
	    });
});
</script>


<div class="container" style = "width: initial;">
	<!--En este row vamos a poner que solo aparezcan el titulo la imagen y datos del taxon seleccionado(tipo y clasificacion)-->
	<div class="row">
			<!--Titulo de cual es el taxon seleccionado(abarca las 12 columnas de este row)-->
			<a title=\"Ver perfil de taxón\" href="javascript:view(<?php echo $category['Category']['id']?>)" >
				<h2 style="margin: 0px;"> <?php echo $category['Category']['name']; ?>	</h2>
			</a> 			<!--Imagen a la izq con 3 columnas-->
			<div class="col col-sm-3">
				<?php
				if((!empty($category['Picture']['image_dir']))&&(count($category['Picture']['image_dir'])>0) ){
				?>
					<div class="thumbnail"> 
						<a title=\"Ver perfil de taxón\" href="javascript:view(<?php echo $category['Category']['id']?>)" >
						<?php echo $this->Html->image('../files/category/image/' . $category['Picture']['image_dir'].'/'.'thumb_'.$category['Picture']['image']); ?>
						</a>
					</div>
				<?php
				}else{ ?>
					<div class="thumbnail"> 
						<a title=\"Ver perfil de taxón\" href="javascript:view(<?php echo $category['Category']['id']?>)" >
						<?php echo $this->Html->image('../files/category/default.PNG'); ?>
					 	</a>
					</div>
				<?php
				}	
				?>
				</div>
	
			<!--Campo para tipo y descripcion. Toma las 9columans restantes de este row-->
			<div class="col col-sm-9">
		    
				<h5 style = "margin: 0px; ">Clasificación</h5> 
				<?php echo h($category['Category']['classification']); ?>
				<h5 style = "margin: 0px; ">Descripción:</h5> 
				<?php echo substr($category['Category']['description'],0,300); ?> 
				
				<a title=\"Ver perfil de taxón\" href="javascript:view(<?php echo $category['Category']['id']?>)" >...más</a>
				
				<br>
			</div>
	</div>
	<!--En este row veremos los taxones asociados con su imagen y una pequeña decripcion-->
    <?php if($category['Category']['classification'] !='Genero'): ?>
	<div class="row">
		<h2 style = "margin: 0px;">
			Taxones asociados
		</h2>
		<!--Tabla donde se muestran las imagenes, nombre y descripcion de taxones derivados del actual-->
		
		
		
		<table id="example" class="display" cellspacing="0" width="100%">
	        <thead>
	            <tr>
	                <th class="col col-sm-2"> </th>
	                <th class="col col-sm-2">Taxón</th>
	                <th>Descripción</th>
	                <th>Acciones</th>
	            </tr>
	        </thead>
	        <tbody>
	            <?php foreach ($sons as $son): ?>
					<tr>
						<!--Imagen-->
						<td class="col col-sm-2">
							<?php if((!empty($son['Picture']['image_dir']))&&(count($son['Picture']['image_dir'])>0) ){?>
								<div class="thumbnail" style=" margin: 0px;"> 
									<a title=\"Ver perfil de taxón\" href="javascript:view(<?php echo $son['Category']['id']?>)" >
									<?php echo $this->Html->image('../files/category/image/' . $son['Picture']['image_dir'].'/'.'thumb_'.$son['Picture']['image']); ?>
									</a>
								</div>
							<?php }else{ ?>
								<div class="thumbnail" style=" margin: 0px;"> 
									<a title=\"Ver perfil de taxón\" href="javascript:view(<?php echo $son['Category']['id']?>)" >
									<?php echo $this->Html->image('../files/category/default.PNG'); ?>
								 	</a>
								</div>
							<?php } ?>
						</td>
						<!--Nombre de taxón-->
						<td class="col col-sm-2">
							<a title=\"Ver perfil de taxón\" href="javascript:view(<?php echo $son['Category']['id']?>)" >
								<h4 style=" margin: 0px;" >
									<?php echo h($son['Category']['name']); ?>
								</h4>
							</a>
						</td>
						<!--Nombre descripcion de taxón-->
						<td class="col col-sm-6">
							<?php echo substr($son['Category']['description'],0,200); ?> 
							<a title=\"Ver perfil de taxón\" href="javascript:view(<?php echo $son['Category']['id']?>)" >...más</a>

						</td>
						<!--Acciones-->
						<td title=\"Ver perfil de taxón\" class="actions col col-sm-2" style="text-align: center;">
							<!--Ver perfil de taxon especifico-->
							<a title=\"Ver perfil principal de taxón\" class="glyphicon glyphicon-eye-open" style="font-size:25px;padding: 10px;float: left;" href="javascript:view(<?php echo $son['Category']['id']?>)"  >   </a>
							
							<a title=\"Ver perfil resumido de taxón y sus taxones relacionados\" class="glyphicon glyphicon-list-alt" style="font-size:25px;padding: 10px;" href="javascript:cargar(<?php echo $son['Category']['id']?>)" ></a>
						</td>
					</tr>
				<?php endforeach; ?>
	            
	        </tbody>
	    </table>
	</div>
    <?php endif; ?>
    <?php if($category['Category']['classification'] =='Genero'): ?>
    <button title=\"Ver perfil principal de taxón\" class="btn btn-mini btn-primary col col-sm-2">
    	
    	<a style="color: #FFFFFF;" href="javascript:view(<?php echo $category['Category']['id']?>)" >
    		Ver perfil
    	</a>
    	<!--<button title=\"Ver perfil principal de taxón\" class="btn btn-mini btn-primary col col-sm-2"  href="javascript:view(<?php echo $category['Category']['id']?>)"  > </button>-->
    </button>
    <?php endif; ?>
</div>