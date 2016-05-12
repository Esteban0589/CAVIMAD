<section id="form"><!--form-->
	<div class="container">
		<div class="row" align="center">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12col-lg-offset-3 col-md-offset-3 col-sm-offset-3 text-center">
				<table style="margin-left:auto; margin-right:auto;" cellpadding="10%" cellspacing="10%">
					<div class="col-sm-9"style="margin-left:auto; margin-right:auto;">
						<div class="features_items"><!--features_items-->
							<h2 class="title text-center"><?php echo __('Resultados de la búsqueda:'); ?></h2>
								
								<?php foreach ($resultados as $resultado): ?>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<!--<div class="thumbnail"> <?//php echo $this->Html->image('../files/category/image/' . $resultado['Category']['image_dir'].'/'.'thumb_'.$resultado['Category']['image']); ?>;-->
													<div class="thumbnail"> <?php echo $this->Html->image('../files/category/image/12/thumb_descarga.jpg'); ?> </div>
													<div>Nombre:<?php echo h($resultado['Category']['name']); ?></div>
													<div>Descripción:<?php echo h($resultado['Category']['description']); ?></div>
													<div>Clasificación:<?php echo h($resultado['Category']['classification']); ?></div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
						</div>
					</div>
				</table>
			</div>
		</div>
</section>