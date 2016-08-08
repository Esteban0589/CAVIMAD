<script type="text/javascript">
//$( document ).ready(function() {
   $(document).ready(function() {
        $.ajax({
            url: "categories/catalogo/", 
            success: function(result){
            $("#secciones").html(result);
        }});
    });
    
    
    function cargar(id)
	{
		$.ajax({
			type: 'GET',
			url: 'admin/categories/cargar/' + id,
			success: function (data) {
				$('#secciones').html(data);
			},
		});
	}
	function edit(id)
	{
		$.ajax({
			type: 'GET',
			url: 'categories/edit/' + id,
			success: function (data) {
				$('#secciones').html(data);
			},
		});
	}
    function catalogo()
    {
        $.ajax({
            url: "categories/catalogo/", 
            success: function(result){
            $("#secciones").html(result);
        }});
    }
    function view(id)
    {
        $.ajax({
            url: 'categories/view/'+id, 
            success: function(result){
            $("#secciones").html(result);
        }});
    }
    function comment(id) 
    { 
        $.ajax({ 
            type: 'POST', 
            url: 'categories/view/'+id,  
            data: {'comments': $('#comment').val(), 'function': 'addcomment'}, 
            success: function(result){ 
            $("#secciones").html(result); 
        }}); 
    }
    function delcomment(id,id2) 
    { 
        $.ajax({ 
            type: 'POST', 
            url: 'categories/view/'+id,  
            data: {'function': 'deletecomment', 'iddc':id2 }, 
            success: function(result){ 
            $("#secciones").html(result); 
        }}); 
    }
//});
</script>


<?php echo $this->Html->css(array('/tree_menu/css/extjs/ext-all'));?>
<?php echo $this->Html->script(array('/tree_menu/js/extjs/ext-base','/tree_menu/js/extjs/ext-all'));?>
<style type="text/css">
html, body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, form, fieldset, input, p, blockquote, th, td {
    padding: none;
}

</style>
<div id="k-body"><!-- content wrapper -->
    
    
    	<div class="container"><!-- container -->
        
            <div class="row"><!-- row -->
                
                <!--Parte contenedora del arbol-->
                <div class="col-lg-3 col-md-3"><!-- doc body wrapper -->
                    <h2>Árbol Taxonómico</h2>
                    <div class="conteiner">
                 
                        <?php if($this->Session->read('Auth')['User']['role'] =='Administrador' || $this->Session->read('Auth')['User']['role'] =='Colaborador'): ?>
                            <div class="btn btn-mini btn-link" title="Ingresar a la sección para administrar los niveles taxonómicos" style="background-color: #3891d4;color: white;margin-bottom: 10px;">
                                <a style= "color: white;" href='/categories/index'>
                                    Administar Taxonomía
                                </a>
                            </div>
                            <div class="btn btn-mini btn-link" title="Agregar nivel taxonómico" style="background-color: #3891d4;color: white;margin-bottom: 10px;" ><a style= "color: white;" href='/categories/add'>Agregar Taxón</a></div>
                            <br>
                        <?php endif; ?>
                    </div>
                    
                    <script type="text/javascript">
                    
                    //Ext.BLANK_IMAGE_URL = '<?php //echo $html->url('/js/ext-2.0.1/resources/images/default/s.gif') ?>';
                    
                    Ext.onReady(function(){
                    
                        var getnodesUrl = '<?php echo $this->Html->url('/admin/tree_menu/categories/getnodes/'.$alias);?>';
                        var reorderUrl = '<?php echo $this->Html->url('/admin/tree_menu/categories/reorder/') ?>';
                        var reparentUrl = '<?php echo $this->Html->url('/admin/tree_menu/categories/reparent/') ?>';
                    
                        var Tree = Ext.tree;
                    
                        var tree = new Tree.TreePanel({
                            el:'tree-div',
                            startCollapsed: false,
                            autoScroll:true,
                            animate:true,
                            enableDD:false,
                            containerScroll: true,
                            rootVisible: false,
                            loader: new Ext.tree.TreeLoader({
                                dataUrl:getnodesUrl
                            })
                        });
                        
                        new Ext.tree.TreeSorter(tree, {
                            folderSort: true,
                            dir: "asc"
                        });
                        
                        // var id = 69; // This is the ID of the node that somehow you know in advance
                        // var node = tree.getNodeById(id);
                        // tree.expandPath(node.getPath());

                        var root = new Tree.AsyncTreeNode({
                            text:'<?php echo __('Category');?>',
                            draggable:false,
                            id:'0'
                        });
                        tree.setRootNode(root);
                    
                        tree.render();
                        root.expand();
                    
                        // track what nodes are moved and send to server to save
                    
                        var oldPosition = null;
                        var oldNextSibling = null;
                    
                        tree.on('startdrag', function(tree, node, event){
                            oldPosition = node.parentNode.indexOf(node);
                            oldNextSibling = node.nextSibling;
                        });
                    
                        tree.on('movenode', function(tree, node, oldParent, newParent, position){
                    
                            if (oldParent == newParent){
                                var url = reorderUrl;
                                var params = {'node':node.id, 'delta':(position-oldPosition)};
                            } else {
                                var url = reparentUrl;
                                var params = {'node':node.id, 'parent':newParent.id, 'position':position};
                            }
                    
                            // we disable tree interaction until we've heard a response from the server
                            // this prevents concurrent requests which could yield unusual results
                    
                            tree.disable();
                    
                            Ext.Ajax.request({
                                url:url,
                                params:params,
                                success:function(response, request) {
                    
                                    // if the first char of our response is zero, then we fail the operation,
                                    // otherwise we re-enable the tree
                    
                                    if (response.responseText.charAt(0) != 1){
                                        request.failure();
                                    } else {
                                        tree.enable();
                                    }
                                },
                                failure:function() {
                    
                                    // we move the node back to where it was beforehand and
                                    // we suspendEvents() so that we don't get stuck in a possible infinite loop
                    
                                    tree.suspendEvents();
                                    oldParent.appendChild(node);
                                    if (oldNextSibling){
                                        oldParent.insertBefore(node, oldNextSibling);
                                    }
                    
                                    tree.resumeEvents();
                                    tree.enable();
                    
                                    alert("Oh no! Your changes could not be saved!");
                                }
                    
                            });
                    
                        });
                    });
                    
                    </script>
                     
                    <div id="tree-div" title="Despliega los distintos niveles taxonómicos." style="height:400px;padding-top: 10px;"></div> 
                    <br>
                </div> 
                
                <!--Parte a refrescar-->
                <a href="javascript:catalogo()" >  <h2 >Catálogo virtual</h2> </a>
                <div id="secciones" class="col-lg-9 col-md-9">
                </div>
            </div>
        </div> 
 </div>
 

