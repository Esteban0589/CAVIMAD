 <div id="k-body"><!-- content wrapper -->
    
    	<div class="container"><!-- container -->
        
            <div class="row"><!-- row -->
                
                <div class="col-lg-12 col-md-12"><!-- doc body wrapper -->
                
                <h2>Administración de Categorías Taxonómicas</h2>
                
                <div class="conteiner">
             
                 <!--<?php if (!isset($this->params['named']['alias'])) echo 'active'; ?>-->
                         <div class="btn btn-mini btn-link"><a href='categories/sort'>Árbol Taxonómico</a></div>
                </div>
                
        <div class="categories">
            <div class="span4" style="text-align: right;">
                    <?php echo $this->Html->link(__('Nueva categoría'), array('action' => 'add', 'alias' => $alias), array('class' => 'btn btn-mini btn-primary', 'id' => 'addnew')); ?>
                 </div>
            <?php if (isset($this->params['named']['alias'])):
            ?>
            <div class="alert alert-info">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <strong>Tip!</strong> See the URL - You only change the name behind alias (EX: alias:my_team), so you can create new tree menu.
            </div>
            <?php
            endif; ?>
            <table cellpadding="0" cellspacing="0" id="table-categories" class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th class="header" style="text-align: center; width:200px"><?php echo __('Nombre de la Categoría'); ?></th>
                        <!--<th class="header" style="text-align: center; width:150px"><?php echo __('Published'); ?></th>-->
                        <th class="header" style="text-align: center; width:200px"><?php echo __('Clasificación'); ?></th>
                        <th class="header"> <?php echo __('Descripción'); ?></th>
                        <th class="header" style="text-align: center; width:200px"><?php echo __('Acciones'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($allCategories as $category):
                        $rowId = "node-" . $category['Category']['id'];
                        $childClass = (intval($category['Category']['parent_id']) > 0) ? "child-of-node-" . $category['Category']['parent_id'] : "";
                        ?>
                        <tr id="<?php echo $rowId; ?>" class="<?php echo $childClass; ?>">
                            <td>
                                <?php
                                echo $category['Category']['name'];
                                //$this->Html->link($category['Category']['name'], array('action'=>'edit', $category['Category']['id']));
                                ?>
                            </td>
                            <td><?php echo h($category['Category']['classification']); ?>&nbsp;</td>
                            <td><?php echo h($category['Category']['description']); ?>&nbsp;</td>
                            
            <!--                <td style="text-align: center">-->
            <!--                    <span style="cursor: pointer">-->
            <!--                        <?php-->
            <!--                        echo $this->Html->image('/tree_menu/img/allow-' . intval($category['Category']['published']) . '.png', array('onclick' => 'published.toggle("status-' . $category['Category']['id'] . '",-->
        				<!--"' . $this->Html->url(array('action' => 'toggle', $category['Category']['id'], (int) $category['Category']['published'], "published")) . '");',-->
            <!--                            'id' => 'status-' . $category['Category']['id']-->
            <!--                        ));-->
            <!--                        ?>-->
            <!--                    </span>&nbsp;-->
            <!--                </td>-->
                            <td style="text-align: center">
                                <?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $category['Category']['id'], 'alias'=>$alias), array('class' => 'btn btn-mini btn-primary')); ?>
                                <?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $category['Category']['id'], 'alias'=>$alias), array('class' => 'btn btn-mini btn-danger'), __('Está seguro de que desea eliminar # %s?', $category['Category']['name'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        
            <?php
            echo $this->Html->script(array(        
                '/tree_menu/js/treetable/jquery.treeTable.js'
            ));
            ?>
            <script type="text/javascript">
                var published = { toggle : function(id, url){ obj = $('#'+id).closest("span"); $.ajax({ url: url, type: "POST", success: function(response){ obj.html(response); } }); } };       
                $(document).ready(function()  {
                    $("#table-categories").treeTable({expandable: false});
                });
            </script>
        </div>
        </div> 
     </div>
    </div> 
 </div>