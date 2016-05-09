<div class="categories">
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
                <th class="header" ><?php echo __('Category Name'); ?></th>
                <th class="header" style="text-align: center; width:150px"><?php echo __('Published'); ?></th>
                <th class="header" style="text-align: center; width:200px"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($categories as $category):
                $rowId = "node-" . $category['Category']['id'];
                $childClass = (intval($category['Category']['parent_id']) > 0) ? "child-of-node-" . $category['Category']['parent_id'] : "";
                ?>
                <tr id="<?php echo $rowId; ?>" class="<?php echo $childClass; ?>">
                    <td>
                        <?php
                        echo $category['Category']['name']; //$this->Html->link($category['Category']['name'], array('action'=>'edit', $category['Category']['id']));
                        ?>
                    </td>
                    <td style="text-align: center">
                        <span style="cursor: pointer">
                            <?php
                            echo $this->Html->image('/tree_menu/img/allow-' . intval($category['Category']['published']) . '.png', array('onclick' => 'published.toggle("status-' . $category['Category']['id'] . '",
				"' . $this->Html->url(array('action' => 'toggle', $category['Category']['id'], (int) $category['Category']['published'], "published")) . '");',
                                'id' => 'status-' . $category['Category']['id']
                            ));
                            ?>
                        </span>&nbsp;
                    </td>
                    <td style="text-align: center">
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'], 'alias'=>$alias), array('class' => 'btn btn-mini btn-primary')); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id'], 'alias'=>$alias), array('class' => 'btn btn-mini btn-danger'), __('Are you sure you want to delete # %s?', $category['Category']['name'])); ?>
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

