<?php 
 if($create){?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">    
    <h2>Créer un inscrit </h2>       
      <ol class="breadcrumb">
        <li><i class="glyphicon glyphicon-th text-red"></i> Inscrits</li>
        <li class="active ">Créer</li>
      </ol>       
    </section>
    <div class="form-horizontal">
<div class="box-body">
<?php              echo validation_errors();
                  echo form_open_multipart('admin/create');?>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nom : </label>
                  <div class="col-sm-10">
                  <input class="form-control" name="nom" placeholder="Entrez le nom " required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Prenom : </label>
                  <div class="col-sm-10">
                  <input class="form-control" name="prenom" placeholder="Entrez le prenom " required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Email : </label>
                  <div class="col-sm-10">
                  <input type='email' class="form-control" name="email" placeholder="Entrez le mail " required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Date de naissance : </label>
                  <div class="col-sm-10">
                  <input type='date' class="form-control" name="date_de_naissance" placeholder="Entrez le nom " required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Sexe  : </label>
                  <div class="col-sm-10">
                  <input class='col-md-1' type="radio" id="homme" name="sexe" value="homme">
                    <label for="homme" class='col-md-3'> un homme</label>
                    <input class='col-md-1' type="radio" id="femme" name="sexe" value="femme">
                    <label for="femme" class='col-md-3'> une femme</label>  
                  </div>
                </div>                            
                <div class="form-group">
                <label class="col-sm-2 control-label">Choisissez un pays :</label>
                <div class="col-sm-10">
                <select name='pays' class="form-control select2" >
                <?php foreach($country as $pays):
	            echo"<option>".$pays[3]."</option>";
	            endforeach;
	            ?>
                </select>                
                </div>                
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Zone géographique  : </label>
                  <div class="col-sm-10">
                  <input class="form-control" name="region" placeholder="zone géographique (facultatif) " >
                  </div>
                </div>
                <div class="form-group">
                <label class="col-sm-2 control-label">Choisissez un métier :</label>
                <div class="col-sm-10">
                <select name='metier' class="form-control select2" >
                <option>Artisan</option>	
	            <option>Cadre de la fonction publique</option>
	            <option>Cadre privé</option>
	            <option>Commerçant</option>
	            <option>Employé</option>
	            <option>Employé de la fonction publique</option>
	            <option>Indépendat</option>
	            <option>Profession libérale</option>
                </select>                
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
            <?php }else{ ?>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">    
                    <h2>Modifier l'inscrit : <?php echo $inscrit['nom'].' '.$inscrit['prenom']; ?></h2>       
                      <ol class="breadcrumb">
                        <li><i class="glyphicon glyphicon-th text-red"></i> Inscrits</li>
                        <li class="active ">Modifier</li>
                      </ol>       
                    </section>
                    <div class="form-horizontal">
                <div class="box-body">
                <?php              echo validation_errors();
                                  echo form_open_multipart('admin/update/'.$inscrit['id']);?>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Nom : </label>
                                  <div class="col-sm-10">
                                  <input class="form-control" name="nom" value='<?php echo $inscrit['nom']; ?>' required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Prenom : </label>
                                  <div class="col-sm-10">
                                  <input class="form-control" name="prenom" value="<?php echo $inscrit['prenom']; ?>" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Email : </label>
                                  <div class="col-sm-10">
                                  <input type='email' class="form-control" name="email" value="<?php echo $inscrit['email']; ?>" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Date de naissance : </label>
                                  <div class="col-sm-10">
                                  <input type='date' class="form-control" name="date_de_naissance" value="<?php echo $inscrit['date_de_naissance']; ?>" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Sexe  : </label>
                                  <div class="col-sm-10">
                                  <input class='col-md-1' type="radio" id="homme" name="sexe" value="homme" <?php if($inscrit['sexe'] = 'homme'){ echo 'checked';}?>>
                                    <label for="homme" class='col-md-3'> un homme</label>
                                    <input class='col-md-1' type="radio" id="femme" name="sexe" value="femme" <?php if($inscrit['sexe'] = 'femme'){ echo 'checked';}?>>
                                    <label for="femme" class='col-md-3'> une femme</label>  
                                  </div>
                                </div>                            
                                <div class="form-group">
                                <label class="col-sm-2 control-label">Choisissez un pays :</label>
                                <div class="col-sm-10">
                                <select name='pays' class="form-control select2" >
                                <?php foreach($country as $pays):
                                if($pays[3] = $inscrit['pays']){
                                    echo"<option selected>".$pays[3]."</option>";
                                }else{
                                    echo"<option>".$pays[3]."</option>";    
                                }
                                endforeach;
                                ?>
                                </select>                
                                </div>                
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Zone géographique  : </label>
                                  <div class="col-sm-10">                                  
                                  <input class="form-control" name="region" 
                                  <?php if($inscrit['region'] == null){ 
                                  echo 'placeholder="zone géographique (facultatif) "'; 
                                   }else{ 
                                  echo "value='".$inscrit['region']."'"; 
                                   } ?>>
                                  </div>
                                </div>
                                <div class="form-group">
                                <label class="col-sm-2 control-label">Choisissez un métier :</label>
                                <div class="col-sm-10">
                                <select name='metier' class="form-control select2" >
                                <?php foreach($metier as $job):
                                        if($job = $inscrit['metier']){
                                            echo"<option selected>".$job."</option>";
                                        }else{
                                            echo"<option>".$job."</option>";
                                        }
	                                  endforeach;
	                            ?>
                                </select>                
                                </div>                
                                </div>
                                <div class="box-footer">
                                <a class="btn btn-default" href="<?php echo base_url()?>admin/view/0">Annuler</a>
                                <button type="submit" class="btn btn-info pull-right">Enregistrer les modifcations</button>
                              </div>
                              </div>
                              <!-- /.box-footer -->
                            </form>
                </div>
                </div>

           <?php } ?>
     
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