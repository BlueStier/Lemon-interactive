  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url().$photo;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $admin;?></p>
          <a href="<?php echo base_url()?>admin/dodo"><i class="fa fa-circle text-success"></i> Mettre en veille</a>
        </div>
      </div>     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">      
        <li class="header">Gestion des inscrits</li>
        <li id='a1' class="active treeview menu-open">
          <a href="#">
            <i class="glyphicon glyphicon-th text-red"></i> <span>Inscrits</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id='active0' class="active"><a href="<?php echo base_url()?>admin/view/0"><i class="fa fa-circle-o text-red"></i> Voir</a></li>
            <li id='active1'><a href="<?php echo base_url()?>admin/view/1"><i class="fa fa-circle-o text-red"></i> Créer </a></li>
          </ul>         
        </li>   
        <li class="header">Gestion des Administrateur</li>
        <li id='a2' class="treeview">
          <a href="#">
            <i class="fa fa-user text-green"></i> <span>Administrateurs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id='active2' class="active"><a href="<?php echo base_url()?>admin/view/3"><i class="fa fa-circle-o text-green"></i> Voir</a></li>
            <li id='active3'><a href="<?php echo base_url()?>admin/view/4"><i class="fa fa-circle-o text-green"></i> Créer </a></li>
          </ul>         
        </li>   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script>
 window.onload = active(<?php echo $nb;?>);
  function active(nb){
    for(var i = 0; i < 4 ; i++){
      document.getElementById('active'+i).className = '';
    }

    if(nb < 0){
      document.getElementById('a1').className = 'treeview';
      document.getElementById('a2').className = 'treeview ';
    }

    if(nb >= 0 && nb < 2){
      document.getElementById('a2').className = 'treeview';
      document.getElementById('a1').className = 'active treeview menu-open';
    }

    if(nb >= 2){
      document.getElementById('a1').className = 'treeview';
      document.getElementById('a2').className = 'active treeview menu-open';
    }
    document.getElementById('active'+nb).className = 'active';
  }
  </script>