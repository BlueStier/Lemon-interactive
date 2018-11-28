<?php 
 if($create){?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">    
    <h2>Créer un administrateur </h2>       
      <ol class="breadcrumb">
        <li><i class="glyphicon glyphicon-th text-red"></i> Administrateurs</li>
        <li class="active ">Créer</li>
      </ol>       
    </section>   
    <div class="form-horizontal">
<div class="box-body">
<?php             if(isset($error)){echo $error['error'];};
                  echo validation_errors();
                  echo form_open_multipart('admin/create_admin');?>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Pseudo : </label>
                  <div class="col-sm-10">
                  <input class="form-control" name="pseudo" placeholder="Entrez le pseudo " required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Email : </label>
                  <div class="col-sm-10">
                  <input type='email' class="form-control" name="email" placeholder="Entrez le mail " required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Mot de passe : </label>
                  <div class="col-sm-10">
                  <input type='password'class="form-control" name="mdp" placeholder="Entrez le mot de passe " required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Confirmation du mot de passe : </label>
                  <div class="col-sm-10">
                  <input type='password' class="form-control" name="conf_mdp" placeholder="Entrez une 2ème fois le mot de passe " required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Choisir une photo </label>
                  <div class="col-sm-4">
                  <input type="file" name="photo" id="exampleInputFile" value='Choisissez une photo'>
                </div>
                <label class="col-sm-4 control-label">Ou utiliser l'image par défaut </label>
                  <div class="col-sm-2">
                  <input type="checkbox" name="pas_de_photo">
                </div>
                </div>
                <div class="box-footer">
                                <a class="btn btn-default" href="<?php echo base_url()?>admin/view/0">Annuler</a>
                                <button type="submit" class="btn btn-info pull-right">Enregistrer</button>
                              </div>
                              </div>
                              <!-- /.box-footer -->
                            </form>
                </div>
                </div>

    <?php } ?>
    </div>
     <!-- /.content-wrapper -->
     <footer class="main-footer">
         <div class="pull-right hidden-xs">
           <b>Version</b> 1
         </div>
         <strong>Copyright &copy; 2018-BlueStier | Design by AdminLTE</strong> All rights
         reserved.
       </footer>
       <!-- /.control-sidebar -->
       <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
     <div class="control-sidebar-bg"></div>
     </div>
     <!-- ./wrapper -->