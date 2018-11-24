
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Aviato E-Commerce Template">
  
  <meta name="author" content="Themefisher.com">

<!-- Slider Start -->
<section class="slider">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="block">
					<h1 class="animated fadeInUp">Un site pour s'inscrire <br> Réalisé par BlueStier</h1>
					<p class="animated fadeInUp">Et un back-office  pour récupérer les informations des internautes<br>  Ceci est un test proposé par Lemon-Interactive</p>
					<a href="<?php echo base_url() ?>site/1"  class="btn btn-main animated fadeInUp" onClick="gelocalise();">S'inscrire</a>
				</div>
			</div>
		</div>
	</div>	
</section>
<?php if(isset($message)){ ?>
<h1 class="text-center"><?php echo $message; ?></h1>
<?php } ?>

   