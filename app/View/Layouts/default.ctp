<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html>

  <head>
    <!--<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>-->
    <!--<script src="js/jquery-migrate-1.2.1.min.js"></script>-->
    <!--<script type="text/javascript" src="js/jquery-ui.min.js"></script>-->
    <!--<script>-->
    <!--    var basePath = " <?php echo Router::url('/'); ?>"-->
    <!--</script>-->
    <!--<script type="text/javascript" src="js/buscador.js"></script>-->
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CAVIMAD</title>
    
    
    <?php //echo $this->Html->script('jquery-2.1.1.min');?>
    <?php //echo $this->Html->script('jquery-migrate-1.2.1.min');?>
    <?php //echo $this->Html->script('jquery-ui.min');?>
    <?php //echo $this->Html->script('buscador');?>
    <!-- Styles -->

    <?php echo $this->Html->css('jquery-ui.min.css');?>
    <?php echo $this->Html->css('font-awesome.min.css');?>
    <?php echo $this->Html->css('bootstrap.min.css');?>
    <?php echo $this->Html->css('dropdown-menu.css');?>
    <?php echo $this->Html->css('jquery.fancybox.css');?>
    <?php echo $this->Html->css('style.css');?>
    <?php echo $this->Html->css('../DataTables/datatables.css');?>
    <!--<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>-->
    <!--<link rel="stylesheet" type="text/css" href="DataTables/datatables.css"/>-->


    
    <?php echo $this->fetch('meta');?>
    <?php echo $this->fetch('css');?>
    <?php echo $this->fetch('script');?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <!--Estos Css de abajo los quite porque estaban cargados arriba y de la manera de abajo-->
    <!--se jode algo que no permite cambiar el color de botones y me imagino que mas cosas-->
   
   <!-- <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">     -->
   <!-- <link href="css/dropdown-menu.css" rel="stylesheet" type="text/css">        -->
   <!--<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">         -->
   <!--<link href="css/bootstrap.css" rel="stylesheet" type="text/css">             -->
   <!-- <link href="css/jquery.fancybox.css" rel="stylesheet" type="text/css">      -->
   <!--<link href=q"css/style.css" rel="stylesheet" type="text/css">                -->
   
 <!--<base href"http://cavimad-jimemachado.c9users.io/"/>-->
    <!--<base href="http://cakebiolo-andres25fg-1.c9users.io/"/>-->
    <!--<base href="http://inge2-maricelmonge.c9users.io"/>-->
    <!--<base href="http://cavimad2-esteban0589.c9users.io/"/>-->
    <!---<base href="http://cavimad-aivaco.c9users.io/"/>-->
     <!--<base href="http://cavimad-julioczar0.c9users.io/"/>-->
     <!--<base href="http://ingenieria2-kevinfl.c9users.io/"/>-->
     
         <!--<base href="http://cavimad.biologia.ucr.ac.cr/"/>-->


  </head>
  
  <body role="document">
  
    <!-- device test, don't remove. javascript needed! -->
    <span class="visible-xs"></span><span class="visible-sm"></span><span class="visible-md"></span><span class="visible-lg"></span>
    <!-- device test end -->
    
    <div id="header" class="container"> 
        <div class="caption-content">
            <div class="col-md-12" style="padding: 0px;">
                <div id="k-site-logo" class="list-inline pull-left col-md-3" style="padding: inherit;">
                
                    <h1 class="k-logo ">
                        <a href="" title="Catalogo Virtual de Macroinvertebrados de Agua Dulce">
                            <img src="app/webroot/img/CavimaLogo.png" alt="CAVIMAD" width="250"; />
                        </a>
                    </h1>
                    <!--<a id="mobile-nav-switch" href="#drop-down"><span class="alter-menu-icon"></span></a>-->
                    <a id="mobile-nav-switch" href="#drop-down"><img id="alter-menu-icon" src="img/menu.png"></a>
            	</div>
                <ul class="list-inline  col-md-9" style="padding: inherit;">
                    <?php
        			    if(empty($_SESSION['role'])||$_SESSION['username']==null){
        		    ?>  
        		    <div class="col-md-8 col-sm-12"></div>
        		    <div class="col-md-2 col-sm-12" style="padding: inherit; text-align: right;">
        				    <div title = "Ingrese con su usuario."><?php echo $this->Html->link(' Iniciar sesión',array('controller' => 'users', 'action' => 'login'));?></div>
                    </div>
        		    <div class="col-md-2 col-sm-12" style="padding: inherit; text-align: right;">
        				    <div title = "Crea una nueva cuenta."><?php echo $this->Html->link('Registrarse',array('controller' => 'users', 'action' => 'add'));?></div>
        			</div>
        			<?php
        			} 
        			else{
        			    
        			    ?>    
        		    <div class="col-md-8 col-sm-12" style="padding: inherit;"> </div>
        		    <div class="col-lg-2 col-sm-12" style="padding: inherit; text-align: right;">
        			        <h6 style="margin: 5px;"><?php echo 'Hola '.$current_user['name'];?>
        			        </h6>
                        <?php
        			    if($current_user['role']=='Administrador'){?>
        			</div>
        		    <div class="col-lg-2 col-sm-12" style="padding: inherit;text-align: right;">
        					    <div title ="Dirige a la sección de administración."><?php echo $this->Html->link('Panel de control',array('controller' => 'users', 'action' => 'index'));?></div>
        			    <?php
        			    }
        				?>
        			</div>
        		    <div class="col-lg-2 col-sm-12" style="padding: inherit;text-align: right;">
        					    <div title ="Cierra la sesión actual."><?php echo $this->Html->link('Cerrar sesión',array('controller' => 'users', 'action' => 'logout'));?></div>
        			</div>
        			<?php
        			}
        			?>
        		 
                </ul>
            </div>
        </div>
        
    </div>
    
    <div id="k-head" ><!-- container + head wrapper -->
    
        <div class="container">
    
    	    <div class="row"><!-- row -->
            

            	<nav id="k-menu" class="k-main-navig"><!-- main navig -->
        
                    <ul id="drop-down-left" class="k-dropdown-menu">
                        <li>
                            <a href="" title="">Inicio</a>
                        </li>
                        <li>
                            <div = "Accesa al catálogo."><a href="categories/sort" title="">Catálogo</a></div>
                        </li>
                        <li>
                             <div = "Accesa a la sección de biomonitoreo."><a href="" title="">Biomonitoreo</a></div>
                        </li>
                        <li>
                             <div = "Accesa a la sección de colaboradores."><a href="users/view_colaboradores" title="">Colaboradores</a></div>
                        </li>
                        <li>
                             <div = "Accesa a la sección de referencias."><a href="" title="">Referencias</a></div>
                        </li>
                        <li>
                             <div = "¿Quiénes somos?"><a href="" title="">Sobre nosotros</a></div>
                        </li>
                        <li>
                             <div = "Si desea enviarnos un mensaje."><a href="" title="">Contáctenos</a></div>
                        </li>
                        <li>
                            <div = "Accesa a la búsqueda avanzada."><a href="categories/advanced_search2" title="">Búsqueda avanzada</a></div>
                        </li>
                        <li>
                            <?php if(!empty($_SESSION['role'])){    ?>  
                                <a class="glyphicon glyphicon-cog" title="" style="font-size:1em;"></a>
                                <ul class="sub-menu">
                        
                                    <div title = "Ver mi perfil."><?php echo $this->Html->link('Ver Perfil',array('controller' => 'users', 'action' => 'view', $current_user['id']));?></div>
                                    <div title = "Dirige a la sección de editar perfil."><?php echo $this->Html->link('Editar Perfil',array('controller' => 'users', 'action' => 'edit', $current_user['id']));?></div>
                                    <div title = "Cierra la sesión activa de la página."><?php echo $this->Html->link('Cerrar sesion',array('controller' => 'users', 'action' => 'logout'));?></div>
                            <?php     }     ?>
                                </ul>   
                        </li>

                    </ul>
        
            	</nav><!-- main navig end -->
            

        </div><!-- row end -->
    
        </div>
    </div><!-- container + head wrapper end -->
    
     <div id="k-body"><!-- content wrapper -->
    
    	<div class="container"><!-- container -->
        
        	<div class="row"><!-- row -->
            
                <div id="k-top-search" class="col-lg-10 clearfix"><!-- top search -->
                
                    <?php /*echo $this->Form->create('Users', array('type' => 'GET', 
                    'class' => 'navbar-form navbar-left', 'url' => array('Controller' => 'users', 'action' => 'buscador'))); ?>
                    <!--<div class = 'form-group'>-->
                    <!--    <?php echo $this->Form->input('buscador', array('label' => false, 'div'=>false, 'id'=> 'buscador', 'class'=> 'form-control buscador', 'autocomplete'=>'off', 'placeholder'=>'Busqueda')) ?>-->
                    <!--</div>-->
                    <!--<?php echo $this->Form->button('Buscar', array('div'=>false, 'class'=> 'btn btn-primary')); ?>-->
                    <!--<?php echo $this->Form->end(); */?>
                    

<?php 		
   /*//Permite realizar la actualización del dropdown de familia según un orden seleccionado.
   //Obtiene el valor del dropdown order.
   $this->Js->get('#Buscar');
   //Si este cambia.
   echo $this->Js->event('change', 
      //Realiza un request que actualiza la variable family. Para esto llama al método getDataFamily.
      $this->Js->request(array(
          'controller'=>'PagesController',
          'action'=>'autocomplebuscar'
          ), array(
          'update'=>'#Buscar',
          'async' => true,
          'method' => 'post',
          'dataExpression'=>true,
          'data'=> $this->Js->serializeForm(array(
              'isForm' => true,
              'inline' => true
              ))
          ))
      );*/
   ?>
                    <form action="categories/buscar" id="top-searchform" method="get" role="Buscar">
                        
                           <div title = "Búsqueda general."><input type="text" name="Buscar" id="sitesearch" class="form-control" autocomplete="off" placeholder="Digite las palabras por las cuales desea buscar" /></div>

                    </form>
                    
                    <div id="bt-toggle-search" class="glyphicon glyphicon-search" style="font-size:1.3em;">
                        <!--<i class="s-open fa fa-search"></i>-->
                        <!--<i class="s-close fa fa-times"></i>-->
                    </div><!-- toggle search button -->
                
                </div><!-- top search end -->
                
                 
            
            	<div class="k-breadcrumbs col-lg-12 clearfix"><!-- breadcrumbs -->
                
                	<!--<ol class="breadcrumb">-->
                 <!--   	<li><a href="#">Home</a></li>-->
                 <!--       <li class="active">Page Example</li>-->
                 <!--   </ol>-->
                    
                </div><!-- breadcrumbs end -->
                
            </div><!-- row end -->
        
        </div><!-- container end -->
    
    </div><!-- content wrapper end -->
    
    <div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
    
	<div id="k-footer"><!-- footer -->
    
    	<div class="container"><!-- container -->
        
        	<div class="row no-gutter"><!-- row -->
            
            	<div class="col-lg-4 col-md-4"><!-- widgets column left -->
            
                    <div class="col-padded col-naked">
                    
                        <ul class="list-unstyled clear-margins"><!-- widgets -->
                        
                        	<li class="widget-container widget_nav_menu"><!-- widgets list -->
                    
                                <h1 class="title-widget">Useful links</h1>
                                
                                <ul>
                                	<li><a href="#" title="menu item">Placement Exam Schedule</a></li>
                                    <li><a href="#" title="menu item">Superintendent's Hearing Audio</a></li>
                                    <li><a href="#" title="menu item">Budget Central</a></li>
                                    <li><a href="#" title="menu item">Job Opportunities - Application</a></li>
                                    <li><a href="#" title="menu item">College Acceptances as of May 12</a></li>
                                </ul>
                    
							</li>
                            
                        </ul>
                         
                    </div>
                    
                </div><!-- widgets column left end -->
            	<div class="col-lg-4 col-md-4"><!-- widgets column left -->
            
                    <div class="col-padded col-naked">
                    
                        <ul class="list-unstyled clear-margins"><!-- widgets -->
                        
                        	<li class="widget-container widget_nav_menu"><!-- widgets list -->
                    
                                <h1 class="title-widget">Useful links</h1>
                                
                                <ul>
                                	<li><a href="#" title="menu item">Placement Exam Schedule</a></li>
                                    <li><a href="#" title="menu item">Superintendent's Hearing Audio</a></li>
                                    <li><a href="#" title="menu item">Budget Central</a></li>
                                    <li><a href="#" title="menu item">Job Opportunities - Application</a></li>
                                    <li><a href="#" title="menu item">College Acceptances as of May 12</a></li>
                                </ul>
                    
							</li>
                            
                        </ul>
                         
                    </div>
                    
                </div><!-- widgets column left end -->
            	<div class="col-lg-4 col-md-4"><!-- widgets column right -->
                
                    <div class="col-padded col-naked">
                    
                        <ul class="list-unstyled clear-margins"><!-- widgets -->
                        
                        	<li class="widget-container widget_sofa_flickr"><!-- widgets list -->
                    
                                <h1 class="title-widget">Organizaciones</h1>
                                
                                <ul class="k-flickr-photos list-unstyled">
                                	<li><a class="k-logo" href="http://www.ucr.ac.cr" title="Universidad de Costa Rica"><img src="app/webroot/img/ucr.gif" alt="UCR" width="100"; /></a></li>
                                    <li><a href="http://www.cimar.ucr.ac.cr" title="Centro de Investigación en Ciencias del Mar y Limnología"><img src="app/webroot/img/logo_cimar.png" alt="CIMAR" width="10"; /></a></li>
                                    
                                    <li><a href="http://www.biologia.ucr.ac.cr" title="Escuela de Biologia, UCR"><img src="app/webroot/img/logopeq.png" alt="ESCUELA DE BIOLOGIA" width="10"; /></a></li>
                                    <li><a href="http://www.vra.ucr.ac.cr/" title="Vicerrectoría de Administración, UCR"><img src="app/webroot/img/logi-vi-cuadrado.png" alt="Vicerrectoría de Administración" width="10"; /></a></li>
                                    
                                </ul>
                    
							</li>
                            
                        </ul> 
                        
                    </div>
                
                </div><!-- widgets column right end -->
            
            </div><!-- row end -->
        
        </div><!-- container end -->
    
    </div><!-- footer end -->
    
    <div id="k-subfooter"><!-- subfooter -->
    
    	<div class="container"><!-- container -->
        
        	<div class="row"><!-- row -->
            
            	<div class="col-lg-12">
                
                	<p class="copy-text text-inverse">
                    ECCI Ingenieria de Software 2. 2016
                    </p>
                
                </div>
            
            </div><!-- row end -->
        
        </div><!-- container end -->
    
    </div><!-- subfooter end -->

    <!-- jQuery -->
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    
    <!-- Bootstrap -->
     <script src="js/bootstrap.min.js"></script>
     <script src="js/bootstrap.js"></script>
     <!--<script src="js/npm.js"></script>-->
     <script src="js/buscador.js"></script>
    
    <!-- Drop-down -->
     <script src="js/dropdown-menu.js"></script>
    
    <!-- Fancybox -->
	<script src="js/jquery.fancybox.pack.js"></script>
    <script src="js/jquery.fancybox-media.js"></script><!-- Fancybox media -->

    <!-- Pie charts -->
     <script src="js/jquery.easy-pie-chart.js"></script>

    <!-- Theme -->
     <script src="js/theme.js"></script>
     
     <!--<script type="text/javascript" src="DataTables/datatables.min.js"></script>-->
     <script type="text/javascript" src="DataTables/datatables.js"></script>
     
    <?php
    echo $this->Js->writeBuffer(); ?>
    
    
  </body>
</html>