 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>
        Inscrits
      </h2>
      <ol class="breadcrumb">
        <li><i class="glyphicon glyphicon-th text-red"></i> Inscrits</li>
        <li class="active ">Voir</li>
      </ol>       
    </section>
    
    <?php
    //affiche tous les pays
foreach($pays_item as $a=>$pays): ?>
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Pays : <?php echo $pays; ?></h3>              
            </div>
            </div>
            <div class="box-body">    
              <table class="display table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Modifier</th>                
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Date de naissance</th>
                  <th>Sexe</th>
                  <th>Métier</th>
                  <th>Email</th>                  
                  <th>Date d'inscription</th>
                  <th>Supprimer</th> 
                </tr>
                </thead>
                <tbody>                  
                  <?php
    foreach($inscrits_item as $inscrits):
        if($inscrits['pays'] == $pays){
      ?><tr>
      <td><a href='' type="submit" class="btn btn-success" title="Modifier"><i class="fa fa-pencil"></i></a></td>         
      <td><?php echo $inscrits['nom']; ?></td>
      <td><?php echo $inscrits['prenom']; ?></td>
      <td><?php echo $inscrits['date_de_naissance']; ?></td>
      <td><?php echo $inscrits['sexe']; ?></td>
      <td><?php echo $inscrits['metier']; ?></td>
      <td><?php echo $inscrits['email']; ?></td>
      <td><?php echo $inscrits['date_inscription']; ?></td>
      <td><button class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" title="Supprimer"><i class="fa fa-trash"></i></button></td>      
      </tr>
        <?php }
    endforeach; ?>
</tbody>
<tfoot>
                <tr>             
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Date de naissance</th>
                  <th>Sexe</th>
                  <th>Métier</th>
                  <th>Email</th>                  
                  <th>Date d'inscription</th>
                </tr>
                </tfoot> 
</table> 
</div>                
<?php endforeach; ?>        
    </div>   
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1
    </div>
    <strong>Copyright &copy; 2018-BlueStier</strong> All rights
    reserved.
  </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

