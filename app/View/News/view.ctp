<div class="container">
	<div class="news view">
			<h2>
					<?php echo $this->Html->link(__(''), array('action' => 'index'), array('class' => 'glyphicon glyphicon-arrow-left','title' =>'Volver a lista de noticias', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
				<?php echo __('Noticia'); ?>
				<?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>
					<?php echo $this->Html->link(__(''), array('action' => 'edit', $news['News']['id']), array('class' => 'glyphicon glyphicon-pencil','title' =>'Editar esta noticia', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
					<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $news['News']['id']), array('class' => 'glyphicon glyphicon-trash', 'title' =>"Eliminar esta noticia",'style'=>'color: #860000;    font-size:25px;     padding: 5px;'), __('Está seguro de que desea eliminar # %s?', $news['News']['id'])); ?>
				<?php endif; ?>
					
			</h2>
		<div class="news form col-md-4">

			<dl>
				<dt><h5>
						<?php echo h($news['News']['title']); ?>
						&nbsp;
					</h5>
				</dt>
					<?php echo h($news['News']['description']); ?>
					&nbsp;
			</dl>
		</div>
		<div class="news form col-md-8">
			<?php echo $this->Html->link(__('Editar imagenes de noticia'), array('controller'=>'NewsEventsPictures','action' => 'view_images_news',$news['News']['id'],), array('class' => 'glyphicon glyphicon-th','title' =>'Administrar imagenes de noticia', 'style'=>'color: #3891D4; font-size:14px; padding: 5px;')); ?>

			<h5><?php echo __('Imagen'); ?></h5>
			<div class="col col-sm-8">
				
				<div id="carousel-featured" class="carousel slide" data-interval="4000" data-ride="carousel"><!-- featured posts slider wrapper; auto-slide -->

           				<div class="carousel-inner"><!-- Wrapper for slides -->
                          <?php 	if(count($picsNewsFinal)==0){?>
                            	<div class="thumbnail"> 
									<?php echo $this->Html->image('../files/picture/default.PNG'); ?>
								</div>
                            	<?php }else{
	                         $y=true;
	                         for($i=0; $i<count($picsNewsFinal); $i++){?>
		                         <?php if($y){?>
		                            <div class="item active">
		                         <?php $y=false; 
		                         } else { ?>
		                             <div class="item">
		                         <?php } ?>
		                            <?php
		                            if((!empty('../files/news_events_picture/image/' . $picsNewsFinal[$i]['image_dir']))){?>
		                          	  <div class="thumbnail"> 
		                            	 <?php echo $this->Html->image('../files/news_events_picture/image/' . $picsNewsFinal[$i]['image_dir'].'/'.$picsNewsFinal[$i]['image'], array('style'=>'height: 200px; width: 100%;')); ?>
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
					<?php 	if(count($picsNewsFinal)>1){?>
	                    <a class="left carousel-control" href="#carousel-featured" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
	                    <a class="right carousel-control" href="#carousel-featured" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                   	<?php  } ?>	
                    <!-- Controls end -->
                    
                </div><!-- featured posts slider wrapper end -->
			</div>
			
			</div>
		</div>
	</div>
</div>
