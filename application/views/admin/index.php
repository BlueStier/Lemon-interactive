
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Lemon Interactive Back-office</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/admin/dist/css/AdminLTE.min.css">
   <!-- Favicon -->
   <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>assets/site/images/favicon.png" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<?php if( isset($user)){ ?>
<meta http-equiv='refresh' content="1800; URL=<?php echo base_url().'cms/destroy'?> ">
  <body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="<?php echo base_url();?>"><b>Lemon</b>Interactive</a>
  </div>
  <!-- User name -->
  
  <div class="lockscreen-name"><?php if(isset($error)){echo $error['error'].'<br>';}; ?><?php echo $user ?></div>
  

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php echo base_url().$photouser;?>" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->
    <?php  echo validation_errors();
                  echo form_open_multipart('login/connect');?>
    <!-- lockscreen credentials (contains the form) -->
    <div class="lockscreen-credentials">
      <div class="input-group">
        <input type="password" class="form-control" placeholder="Mot de passe" name='pwd'>

        <div class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Entrer votre mot de passe pour réactiver votre session
  </div>
  <div class="text-center">
    <a href="<?php echo base_url()?>cms/destroy">Se connecter avec un autre utilisateur</a>
  </div>
  <div class="lockscreen-footer text-center">
  <strong>Copyright &copy; 2018-BlueStier</strong> All rights
    reserved.
  </div>
</div>
<!-- /.center -->
<?php } else { ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <a href="<?php echo base_url();?>"><b>Lemon</b>Interactive</a>
  </div> 
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Connexion pour démarrer une session</p>
   
    <?php if(isset($error)){echo $error['error'];};
             echo validation_errors();
                  echo form_open_multipart('admin/connect');?>
      <div class="form-group has-feedback">
        <input type="name" class="form-control" name="pseudo" placeholder="Pseudo" required>
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="pwd" placeholder="Mot de passe" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Connexion</button>
        </div>
        <!-- /.col -->
      </div>
    </form>    

    <a href="#" data-toggle="modal" data-target="#modal-info">Mot de passe oublié</a><br>    
    <strong>Copyright &copy; 2018-BlueStier</strong> All rights
    reserved.
  </div>
  <?php if(isset($message)){echo $message;};?>
  <!-- /.login-box-body -->
</div>

<!-- /.login-box -->

        <!-- Modal pour renvoyer un mot de passe par mail -->
        <div class="modal modal-info fade" id="modal-info">
        <?php if(isset($error)){echo $error['error'];};
             echo validation_errors();
                  echo form_open_multipart('admin/mdp');?>
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Envoi d'un nouveau mot de passe</h4>
              </div>
              <div class="modal-body">
              <div class="form-group has-feedback">
        <input type="name" class="form-control" name="pseudo" placeholder="Pseudo" required>
        <span class="fa fa-user form-control-feedback"></span>
      </div>         
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Annuler</button>                
                <button type="submit" class="btn btn-outline" >Envoyer le nouveau mot de passe</button>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->        
<?php } ?>
<!-- jQuery 3 -->
<script src="<?php echo base_url();?>/assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>/assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>

