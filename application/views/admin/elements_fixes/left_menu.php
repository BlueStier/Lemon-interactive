  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/admin/image/slider-bg.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
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
            <li id='active1' class="active"><a href="<?php echo base_url()?>admin/view/0"><i class="fa fa-circle-o text-red"></i> Voir</a></li>
            <li id='active2'><a href="<?php echo base_url()?>admin/view/1"><i class="fa fa-circle-o text-red"></i> Créer </a></li>
          </ul>         
        </li>   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script>
 window.onload = active(<?php echo $nb;?>);
  function active(nb){
    for(var i = 0; i < 3 ; i++){
      document.getElementById('active'+i).className = '';
    }
    if(nb>4){
      document.getElementById('a1').className = 'treeview';
      
    }
    document.getElementById(nb).className = 'active';
  }
  </script>