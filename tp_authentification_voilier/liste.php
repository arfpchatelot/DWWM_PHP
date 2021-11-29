<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8" />
<title>Liste des voiliers disponibles à la location</title>
<!--Elements <meta />  -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"></script>
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->


</head>

<body>
<?php 
session_start();

if( isset($_SESSION["login"]) && !empty($_SESSION["login"]))
{

	echo '<ul>
	<li  class="">
		<a  class="" href="/edel/edel2" >
			<span class="">Edel Grand-large</span>
		</a>
	</li>
	<li  class="">
		<a class="" href="/edel/edel2" >
			
			<span class="">Edel 2</span>	
		</a>
	</li>
	<li  class="">
		<a class="" href="/edel/edel3" >
			
			<span class="">Edel 3</span>	
		</a>
	</li>
	<li  class="">
		<a class="" href="/edel/edel4" >
			
			<span class="">Edel 4</span>
		</a>
	</li>
	<li  class="">
		<a  class="" href="/edel/edel-5-545" >
			
			<span class="">Edel 5 / 545 / Dayboat</span>	
		</a>
	</li>
	<li  class="">
		<a  class="" href="/edel/edel600" >
			
			<span class="">Edel 600</span>	
			
		</a></li>
		<li  class="">
			<a class="" href="/edel/edel-6-660-665" >
				
				<span class="">Edel 6 / 660 / 665</span>
				
			</a>
		</li>
		<li  class="">
			<a class="" href="/edel/edel730" >
				
				
				<span class="">Edel 730</span>	
				
			</a>
		</li>

		<li  class="">
			<a  class="" href="/edel/edel820" >
				
				<span class="">Edel 820</span>	
			</a>
		</li>
	</ul>';
}
else {
	echo "Vous n'êtes pas autorisé à accéder a ce contenu, veuillez vous connecter à la page suivante :"."<a href='index.php' target='_self' >lien accès membre</a>";

}


		?>

</body>
</html>
