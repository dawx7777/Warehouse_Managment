<img class="wave" src="wave.png">

<div class="d-flex" id="wrapper">

<div class="bg-light  border-right" id="sidebar-wrapper" style="height:1000px;">
  <div class="sidebar-heading" >Panel zarządzania</div>
  <div class="list-group list-group2 list-group-flush">
	<a href="stan.php" class="list-group-item list-group-item-action bg-light2">Stan magazynowy</a>
	
	<a href="przyjecie.php" class="list-group-hover list-group-item list-group-item-action bg-light2 ">Przyjęcie produktu</a>

	<a href="raport.php" class="list-group-item list-group-item-action bg-light2">Wyświetl raport</a>
	<a href="wydawanie.php" class="list-group-item list-group-item-action bg-light2">Wydaj towar</a>

	<a href="uslugi.php" class="list-group-item list-group-item-action bg-light2">Dodaj zamówienie</a>

	<a href="pass_edit.php" class="list-group-item list-group-item-action bg-light2">Mój profil</a>
  </div>
</div>

<div id="page-content-wrapper">

  <nav class="navbar navbar2 navbar-expand-lg navbar-light bg-light border-bottom">
	<button class="button" style='background-color:#3a3768; color:white; border-color:#3a3768;' id="menu-toggle"><span>menu</span></button>
	<a href="logout.php"><button class="button" style="vertical-align:middle" ><span>wyloguj się</span></button></a>

	
	<a href="profil.php"><button class="button" style='width: 145px; background-color:transprent; color:black; border-color:transparent; '><?php 
	$user=$_SESSION['imie'];
	echo "Witaj, ".$user."!";?></button></a>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	  <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
	  <li class="nav-item">
			  
	 		 
			  
		
	  </ul>
	</div>
  </nav>

  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>