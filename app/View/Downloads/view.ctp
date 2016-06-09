
    
        <h1>Title : <?php echo h($Download['Download']['title']); ?></h1>
        <p><small>ID: <?php echo $Download['Download']['id']; ?></small></p>
        <p><small>Description: <?php echo $Download['Download']['description']; ?></small></p>
        <p><small>Created: <?php echo $Download['Download']['abstract']; ?></small></p>
        <p><small>File Name:</small><?php echo h($Download['Download']['report']); ?></p>
        <p><?php echo $this->Html->link('View File',array('controller' => 'downloads','action' => 'viewdown',$Download['Download']['id'],false),array('target'=>'_blank'));?></p>
        
