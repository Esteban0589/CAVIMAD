<?php
echo $this->Html->css(array(
    '/tree_menu/css/superfish.css'
));
?>
<?php 
$products_categories = $this->requestAction('/tree_menu/categories/get_menu_categories'); 
$zoo_categories = $this->requestAction('/tree_menu/categories/get_menu_categories/alias:zoo'); 
?>

<div class="nav-collapse">
     
    <h3>Get default tree menu</h3>
    <hr>   
    <pre>Use <&quest;php $this->requestAction('/tree_menu/categories/get_menu_categories');&quest;> to get data</pre>  
    <?php
    echo $this->Menu->setup($products_categories, array(
        'modelName' => 'Category',
        'menuId' => 'ldd_menu',
        'menuClass' => 'sf-menu',
        'childMenuClass' => 'child-dropdown-menu submenu',
        'liDevider' => '<li class="divider"></li>',
        'url' => $this->Html->url('/demo/index'), //the page that you like direct to
        'slugUrl' => 'slug', //the slug field name in your database (default: slug)
        'selected' => $this->here));
    
    echo '<div class="clearfix">&nbsp;</div><br><br>';
    ?>
        
    <h3>Get tree menu with alias "zoo"</h3>
    <hr>
    <pre>Use <&quest;php $this->requestAction('/tree_menu/categories/get_menu_categories/alias:<font color="red">zoo</font>');&quest;> to get data</pre>        
    <?php
    
    echo $this->Menu->setup($zoo_categories, array(
        'modelName' => 'Category',        
        'menuId' => 'ldd_menu',
        'menuClass' => 'sf-menu',
        'childMenuClass' => 'child-dropdown-menu submenu',
        'liDevider' => '<li class="divider"></li>',
        'url' => $this->Html->url('/demo/index'), //the page that you like direct to
        'slugUrl' => 'slug', //the slug field name in your database (default: slug)
        'selected' => $this->here));
    ?>        
</div>