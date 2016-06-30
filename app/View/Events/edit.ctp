<div class="container">
	<div class="events form">
		<div class="row">
			<?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>
				<h1>					
					<?php echo $this->Html->link(__(''), array('action' => 'view',$this->request->data['Event']['id']), array('class' => 'glyphicon glyphicon-arrow-left','title' =>'Ver todos los eventos', 'style'=>'color: #3891D4; font-size:25px; padding: 5px;')); ?>
					<?php echo __('Edición evento'); ?>
					<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $this->request->data['Event']['id']), array('class' => 'glyphicon glyphicon-trash', 'title' =>"Eliminar evento",'style'=>'color: #860000; font-size:25px; padding: 5px;'), __('Atención se va a eliminar evento # %s?', $this->request->data['Event']['title'])); ?>
				</h1>
				<div class="events form col-md-4">
					<?php echo $this->Form->create('Event'); ?>
						<fieldset>
						<br>
						<?php
							echo $this->Form->input('id',array('class'=>'form-control'));
							echo $this->Form->input('title',array('class'=>'form-control','label'=>'Título','title'=>'Ingrese el título del evento'));
							echo $this->Form->input('description',array('class'=>'form-control','label'=>'Descripcíon','rows' => '5', 'cols' => '5','title'=>'Ingrese descripción del evento' ));
							echo $this->Html->link(__('Editar imagenes de evento'), array('controller'=>'NewsEventsPictures','action' => 'view_images_events',$this->request->data['Event']['id'],), array('class' => 'glyphicon glyphicon-th','title' =>'Administrar imagenes del evento', 'style'=>'color: #3891D4; font-size:14px; padding: 5px;'));
							
						?>
						</fieldset>
					<br>
					<?php echo $this->Form->end(array('label'=>'Actualizar evento', 'class'=>'btn btn-success','title'=>'Actualizar evento')); ?>
				</div>
				<div class="news form col-md-8">
					
				
					 <div id="carousel-featured" class="carousel slide" data-interval="4000" data-ride="carousel"><!-- featured posts slider wrapper; auto-slide -->

           				<div class="carousel-inner"><!-- Wrapper for slides -->
                          <?php 
                          	if(count($picsEventsFinal)==0){?>
                            	<div class="thumbnail"> 
									<?php echo $this->Html->image('../files/picture/default.PNG'); ?>
								</div>
                            	<?php }else{
	                         $y=true;
	                         for($i=0; $i<count($picsEventsFinal); $i++){?>
		                         <?php if($y){?>
		                            <div class="item active">
		                         <?php $y=false; 
		                         } else { ?>
		                             <div class="item">
		                         <?php } ?>
		                            <?php
		                            if((!empty('../files/news_events_picture/image/' . $picsEventsFinal[$i]['image_dir']))){?>
		                          	  <div class="thumbnail"> 
		                            	 <?php echo $this->Html->image('../files/news_events_picture/image/' . $picsEventsFinal[$i]['image_dir'].'/'.$picsEventsFinal[$i]['image'], array('style'=>'height: 200px; width: 100%;')); ?>
		                           		</div>
		                          	<?php }	else{ ?>
										<div class="thumbnail"> 
											<?php echo $this->Html->image('../files/news_events_picture/noticias.jpeg'); ?>
										</div>
		                           	<?php  } ?>	
		                            </div>
	                     <?php } }?>
	                     
                    </div><!-- Wrapper for slides end -->
                
                    <!-- Controls -->
                    <?php if(count($picsEventsFinal)>1){?>
	                    <a class="left carousel-control" href="#carousel-featured" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
	                    <a class="right carousel-control" href="#carousel-featured" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                    <?php  } ?>	
                    <!-- Controls end -->
                    
                </div><!-- featured posts slider wrapper end -->
			</div>

				
				
				
				
				<br>
				<br>
				
				
				</div>
			<?php endif; ?>
			
			
			<?php if($this->Session->read('Auth')['User']['role'] !='Administrador'): ?>
        	<div class="alert alert-warning alert-dismissable">
                 <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           </div>
       <?php endif; ?> 
		</div>

			<br>
	</div>
</div>