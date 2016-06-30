<div class="container">
	<div class="events view">
			<h2>
					<?php echo $this->Html->link(__(''), array('action' => 'index'), array('class' => 'glyphicon glyphicon-arrow-left','title' =>'Volver a lista de eventos', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
				<?php echo __('Eventos'); ?>
				<?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>
					<?php echo $this->Html->link(__(''), array('action' => 'edit', $events['Event']['id']), array('class' => 'glyphicon glyphicon-pencil','title' =>'Editar este evento', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
					<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $events['Event']['id']), array('class' => 'glyphicon glyphicon-trash', 'title' =>"Eliminar este evento",'style'=>'color: #860000;    font-size:25px;     padding: 5px;'), __('Está seguro de que desea eliminar # %s?', $events['Event']['id'])); ?>
				<?php endif; ?>
					
			</h2>
		<div class="news form col-md-4">

			<dl>
				<dt><h5><?php echo __('Título'); ?></h5></dt>
				<dd>
					<?php echo h($events['Event']['title']); ?>
					&nbsp;
				</dd>
				<dt><h5><?php echo __('Descripción'); ?></h5></dt>
				<dd>
					<?php echo h($events['Event']['description']); ?>
					&nbsp;
			</dl>
		</div>
		<div class="news form col-md-8">
					<h5><?php echo __('Imagen'); ?></h5>
								<div class="col col-sm-8">
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
                    <a class="left carousel-control" href="#carousel-featured" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                    <a class="right carousel-control" href="#carousel-featured" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                    <!-- Controls end -->
                    
                </div><!-- featured posts slider wrapper end -->
			</div>

		</div>
			<?php	echo $this->Html->link(__('Editar imagenes de evento'), array('controller'=>'NewsEventsPictures','action' => 'view_images_events',$this->request->data['Event']['id'],), array('class' => 'glyphicon glyphicon-th','title' =>'Administrar imagenes del evento', 'style'=>'color: #3891D4; font-size:14px; padding: 5px;'));?>
	</div>
	
</div>
