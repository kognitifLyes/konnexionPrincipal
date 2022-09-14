<?php
include('../env_setting.php');
if(!isset($_COOKIE['chatkonnexion_session'])){
	header('Location: login.php');
} ?>

<?php session_start();
if(isset($_SESSION['csrf_token'])) {
	setcookie('csrf_token', $_SESSION['csrf_token']);
}

?>


<html style="background-color: #eeeaff;">


<style>

.parallax > use {
  animation: move-forever 25s cubic-bezier(0.55, 0.5, 0.45, 0.5) infinite;
}
.parallax > use:nth-child(1) {
  animation-delay: -2s;
  animation-duration: 7s;
}
.parallax > use:nth-child(2) {
  animation-delay: -3s;
  animation-duration: 10s;
}
.parallax > use:nth-child(3) {
  animation-delay: -4s;
  animation-duration: 13s;
}
.parallax > use:nth-child(4) {
  animation-delay: -5s;
  animation-duration: 20s;
}
@keyframes move-forever {
  0% {
    transform: translate3d(-90px, 0, 0);
  }
  100% {
    transform: translate3d(85px, 0, 0);
  }
}


</style>

<body style="text-align: center;overflow:hidden;background-color:white;margin:20px">
	<p style="font: normal normal bold 32px/50px Roboto;"><b>Bonjour,</b></p>
	<p style="font: normal normal bold 32px/50px Roboto;color:#633AFF" id="username"><b></b></p>
	<p style="text-align: center;letter-spacing: 0px;color: #505050;opacity: 1;">Vous voici de retour, nous vous souhaitons une belle journée, pleine de nouvelles opportunités! </p>
	
	<div   style="width: 70%;height: 60%;background: transparent linear-gradient(180deg, rgba(119, 43, 255, 1) 0%, rgba(81, 30, 221, 1) 100%) 0% 0% no-repeat padding-box;;opacity: 1;margin-left: 15%;margin-top: -50px;"> 
		
	<div style="margin-top: 0px;">	

	<p style="text-align: center;font: normal normal normal 70px/92px Roboto;letter-spacing: 0px;color: #FFFFFF;opacity: 1;" id="locale_fr_time"></p>
			<p style="text-align: center;font: normal normal normal 31px/40px Roboto;letter-spacing: 0px;color: #FFFFFF;opacity: 1;" id="locale_fr_date"></p>
			<div style="justify-content:  space-between;display:flex;height: 20%;">
				<div style="display:flex;margin-left: 2%;">
					<div style="padding-top: 2%;margin-right: 2%;">
						<img  id="wIcon" src="img/logo.png"  width="100px" />
					</div>
					<div>
						<p style="text-align: left;font: normal normal normal 39px/52px Roboto;letter-spacing: 0px;color: #FFFFFF;opacity: 1;margin-bottom: -20px;" id="city"></p>
						<p style="text-align: left;font: normal normal 300 19px/25px Roboto;letter-spacing: 0px;color: #FFFFFF;opacity: 1;" id="description"></p>

					</div>
				</div>


				<div style="margin-top: -3%;">
					<p style="padding-right: 30px;text-align: left;font: normal normal 300 69px/91px Roboto;letter-spacing: 0px;color: #FFFFFF;opacity: 1;" id="temp"></p>
				</div>
			</div>


		<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
		viewBox="10 20 150 120" preserveAspectRatio="none" shape-rendering="auto" >
		<defs>
		<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
		</defs>
		<g class="parallax" >
		<!--<use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />-->
		<use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.3)" />
		<use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.1)" />
		<!--<use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />-->
		</g>
		</svg>



	</div>


		
			






			
			





			</div>


			<div  id="redirect_tasks" style="margin-top: 50px;text-align: center;margin-left: 40%;width: 244px;height: 37px;border: 1px solid #707070;border-radius: 19px;opacity: 1;cursor:pointer">
				<p id="text_redirect_tasks" style="color: #633aff;text-align: center;font: normal normal normal 16px/21px Roboto;letter-spacing: 0px;color: #633AFF;opacity: 1;margin-top: 5px;">Accéder à mes tâches</p></div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>


description_weather = { 


		"overcast clouds": "nuages couverts", 
        "broken clouds" : "nuages brisés",
        "scattered clouds" : "nuages dispersés",
        "few clouds":"quelques nuages",

        "clear sky":"ciel clair",

        "tornado" : "tornade",
        "squalls" : "grains",
        "fog": "brouillard",
        







    };
       
   

//console.log(description_weather["overcast clouds"])


konnexion = localStorage.getItem("konnexion");
konnexion = JSON.parse(konnexion);
konnexion_kcm_user_id = konnexion.user.kcm_user_id;



$( "#redirect_tasks" ).click(function() {
$(parent.document).find("#content").attr("src","https://"+window.location.hostname+"/todolist/public/index.php/?id_user="+konnexion_kcm_user_id);
});





$( "#redirect_tasks" ).mouseenter(function() {
 $(this).css("background-color","#633AFF");
 $("#text_redirect_tasks").css("color","white");


});


$( "#redirect_tasks" ).mouseout(function() {
  $(this).css("background-color","white");
   $("#text_redirect_tasks").css("color","#633aff");

});


//https://beta.konnexion.io/todolist/public/index.php/?id_user=10

			
		function afficher() {
			var jours_fr = ["Dim.","Lun.","Mar.","Mer.","Jeu.","Vend.","Sam."];
			var mois_fr = ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"];
			;
			var offsetUTC = +2,
			lD = new Date();
			oD = new Date();
			oD.setHours(lD.getUTCHours()+offsetUTC);
			var m=oD.getMinutes();
			var s=oD.getSeconds();
			var diffEnMilliseconde = lD-oD;
			var diffEnHeures = ((lD-oD)/1000)/3600;

		
		if(m <= 9) {m = "0" + m;}
		if(s <= 9) {s = "0" + s;}		
		 
		  document.getElementById("locale_fr_time").innerHTML = lD.getHours() + ":" + m ;
		
		  
		   document.getElementById("locale_fr_date").innerHTML = " " + jours_fr[lD.getDay()] +" " + lD.getDate() + " " + mois_fr[lD.getMonth()] ;
		
			 


		  }	  
		 	  
		  



	

		window.onload=function() {
		  afficher();
		  setInterval(afficher,60000);
		}


///////////////
    
konnexion = localStorage.getItem("konnexion");
konnexion = JSON.parse(konnexion);
konnexion_username = konnexion.user.first_name+" "+konnexion.user.last_name;
document.getElementById("username").innerHTML =konnexion_username;




   try {
   
            loclisation_by_ip = ('<?php
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }


            echo(stripslashes(file_get_contents('http://ip-api.com/json/'.$ip.'?fields=status,message,country,countryCode,city,zip,lat,lon'))) ?>');
        

        loclisation_by_ip=(JSON.parse(loclisation_by_ip));
/////////////////////////

/*
 localStorage.setItem("latitude", loclisation_by_ip.lat);
 localStorage.setItem("longitude", loclisation_by_ip.lon);
 localStorage.setItem("address", loclisation_by_ip.city);
*/








///////////////////////////

KEY = ",&APPID=be3424f761f7de4add4378e33732b310";
 var URL ='https://api.openweathermap.org/data/2.5/weather?q=' + loclisation_by_ip.city + KEY;



 $.getJSON(URL, function(data) {
        var type = data.weather[0].main;  //array 0 index
        var id = data.weather[0].id; //array 0 index"
        var city = data.name;

        var tempCel = Math.round(data.main.temp - 273.15);
        var tempC = tempCel + '°';
        var weather = data.weather[0].description;
        console.log(weather)
        $("#description").text(description_weather[weather]);
        var tempF = Math.round(tempCel * (9 / 5) + 32) + '°F';
        var icon = data.weather[0].icon;
        var tempBool = true;

        //Output data to display on the page
       // $('#city').text(city);
       $('#city').text(loclisation_by_ip.city);
       // $('#state').text(region);
       $('#temp').text(tempC); //Show Fahrenheit by Default
       var weatherIcon = 'http://openweathermap.org/img/w/' + icon + '.png';
        $('#wIcon').attr('src',weatherIcon);


   //Then toggle to switch between F and C temperature.
   $('#btnToggle').on('click', function() {
        var temp = $('#temp');
        if (tempBool) {
            temp.html(tempC);
            tempBool = false
            } else {
            temp.html(tempF);
            tempBool = true;
         }
      }); 

        });
    

//////////////////////////////
                           
                     

/////////////////////////
          } catch (error) {
            console.error(error);
          }




////////////////
</script>





	</body>
</html>