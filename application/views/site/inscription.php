<!-- Slider Start -->
<section class="slider">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="block">
					<h1 class="animated fadeInUp">Un site pour s'inscrire <br> Réalisé par BlueStier</h1>
					<p class="animated fadeInUp">Et un back-office  pour récupérer les informations des internautes<br>  Ceci est un test proposé par Lemon-Interactive</p>
					<h2 class="animated fadeInUp">Pour vous inscrire veuillez remplir le formuliare<br> Un email de confirmation vous sera envoyé.</h2>
				</div>
			</div>
		</div>
	</div>
</section>
<br>
<?php echo validation_errors(); ?>
<div class="container">
	<div class="row form-group">
	<?php  echo form_open_multipart('site/enregistrer'); ?>		
    <input type="text" class="col-md-12 col-sm-12 form-control" name='nom' placeholder="Votre nom" required/>
    <br><br>
    <input type="text" class="col-md-12 form-control" name='prenom' placeholder="Votre prenom" required/>
    <br><br>
	<label class="col-md-12 form-control">Quelle est votre date de naissance : </label>
	<input type="date" class="col-md-12 form-control" name='date_de_naissance' required/>
    <br><br>
    <input type="email" class="col-md-12 form-control" name='email' placeholder="Votre email" required/>
    <br><br>
    <div class="col-md-12 form-control ">
	<label class='col-md-3'>Vous êtes ? </label>
    <input class='col-md-1' type="radio" id="homme" name="sexe" value="homme">
    <label for="homme" class='col-md-3'> un homme</label>
    <input class='col-md-1' type="radio" id="femme" name="sexe" value="femme">
    <label for="femme" class='col-md-3'> une femme</label>  
	</div>
	<label class="col-md-12 form-control">Choissisez votre pays : </label>
	<select class="col-md-12 form-control" name='pays' id="pays_a_selectionner">
	<?php foreach($country as $pays):
	echo"<option>".$pays[3]."</option>";
	endforeach;
	?>
	</select>
	<label class="col-md-12 form-control">Quel est votre métier : </label>
	<select class="col-md-12 form-control" name='metier'>
	<option>Cadre privé</option>
	<option>Cadre de la fonction publique</option>
	<option>Employé</option>
	<option>Employé de la fonction publique</option>
	<option>Commerçant</option>
	<option>Artisan</option>
	</select>	
	</div>
	<input type='submit' class='col-md-12 form-control btn btn-primary'	value="s'inscrire"/>
	</form>
</div>
<script>
function select_pays(pays){
	/*vérifie toutes les options du select concernant les pays et passe à true le selected si le pays
	passé en paramètre est dans la liste*/ 
	var pays_a_selectionner = document.getElementById('pays_a_selectionner');
    for (var i = 0; i < pays_a_selectionner.options.length; ++i) {
        if (pays_a_selectionner.options[i].text === pays)
		pays_a_selectionner.options[i].selected = true;
    }
}

function maPosition(position) {
	//récupère la latitude et la longitude  
  var latitude = position.coords.latitude;
  var longitude = position.coords.longitude;
  //google map api 
  var geocoder = new google.maps.Geocoder();
	var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
	geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
				var pays;
				var region;
				var ville
				//récupère les éléments de l'adresse
				var elt = results[0].address_components;
          	for(i in elt){            
            	if(elt[i].types[0] == 'locality')
            	ville = elt[i].long_name;
            	if(elt[i].types[0] == 'administrative_area_level_2')
            	region = elt[i].long_name;
				if(elt[i].types[0] == 'country')
            	pays = elt[i].long_name;
		  }
		  //appel de la fonction select_pays()avec le pays trouvé en paramètre
		  select_pays(pays);			  
			  }
			}
		});
}
	//utilise l'api de geolocalisation du navigateur et appel la fonction maPosition
if(navigator.geolocation){
  navigator.geolocation.getCurrentPosition(maPosition);
  
  } 
</script>
   