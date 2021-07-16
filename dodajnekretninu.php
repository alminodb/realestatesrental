<?php 
	
	require_once("connection.php");
	session_start();
	if(!isset($_SESSION['admin']) || $_SESSION["admin"] == 0){
		$_SESSION['message'] = "Samo administratori mogu dodavati nove nekretnine!";
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dodavanje nekretnine</title>
	<link rel="stylesheet" type="text/css" href="dodajStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="slike/house.png">
</head>
<body>
<!-- ---------------------NAVIGACIJA--------------------- -->
	<div class="navigation" id="navigation">
		<span class="menu" id="menu-close"><i class="fa fa-bars"></i></span>
		<ul class="navigation-links">
            <li><a href="index.php">Pocetna</a></li>
            <li><a href="estates.php?type=1">Kuce</a></li>
            <li><a href="estates.php?type=2">Stanovi</a></li>
            <li><a href="estates.php?type=3">Poslovni prostori</a></li>
            <?php if(isset($_SESSION['username'])) { ?>
            	<li><a href="estates.php?user=<?php echo $_SESSION['username'] ?>">Moje nekretnine</a></li>
            <?php } ?>
            <?php if(isset($_SESSION["admin"]) && $_SESSION['admin'] != 0){ ?>
            	<li><a href="estates.php?type=0"><i class="fa fa-user" style="color: #333;"></i> Sve nekretnine</a></li>
            	<li><a href="dodajnekretninu.php"><i class="fa fa-user" style="color: #333;"></i> Dodaj Nekretninu</a></li>
        	<?php } ?>
            <?php if(isset($_SESSION['username'])) { ?>
            	<form action="actions.php" method="post">
            		<li><button href="#" type="submit" name="logout">Odjava</button></li>
            	</form>
            <?php } ?>
        </ul>
	</div>
<!-- ---------------------HEADER--------------------- -->
	<div class="list-header">
		<!-- ---------------------HEADER CONTAINER--------------------- -->
		<div class="header-container">
			<!-- ---------------------LOGO--------------------- -->
			<div class="logo">
				<a href="index.php"><img class="logo-img" src="slike/logo.png"></img></a>
				<p>RealEstate<span>Rental</span></p>
			</div>
			<!-- ---------------------MENU--------------------- -->
			<span class="menu" id="menu-open"><i class="fa fa-bars"></i></span>
		</div>
		</div>
<!-- ---------------------MAIN CONTAINER--------------------- -->
	<div class="main-container">
		<form class="forma" action="actions.php" method="post" enctype="multipart/form-data">
			<div class="container">
				<select name="type">
					<option value="1">Kuca</option>
					<option value="2">Stan</option>
					<option value="3">Poslovni prostor</option>
				</select>
				<span class="placeholder">Vrsta</span>
			</div>
			<div class="container">
				<input type="text" name="title" required>
				<span class="placeholder">Naziv</span>
			</div>
			<div class="container">
				<input type="text" name="price" required>
				<span class="placeholder">Cijena / dan (BAM)</span>
			</div>
			<div class="container">
				<textarea type="text" name="about" required></textarea>
				<span class="placeholder">Opis</span>
			</div>
			<div class="container">
				<input type="text" name="location" required>
				<span class="placeholder">Lokacija</span>
			</div>
			<div class="container">
				<input type="file" name="picture" required style="padding-top: 15px;" accept="image/png, image/jpeg, image/jpg">
				<span class="placeholder">Slika</span>
			</div>
			<div class="container">
				<button type="submit" class="add-button" name="add-estate">Dodaj nekretninu</button>
			</div>
		</form>
	</div>
<!-- ---------------------FOOTER--------------------- -->
	<footer class="footer-distributed">
			<div class="footer-left">
				<h3>RealEstate<span>Rental</span></h3>
				<p class="footer-links">
					<a href="#">Pocetna</a>

					<a href="#">Kuce</a>

					<a href="#">Stanovi</a>

					<a href="#">Poslovni prostori</a>
				</p>
				<p class="footer-company-name">Real Estate Rental © 2021</p>
				<div class="footer-icons">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-github"></i></a>
				</div>
			</div>
			<div class="footer-right">
				<p>Kontaktirajte nas</p>
				<form action="#" method="post">
					<input type="text" name="email" placeholder="Email">
					<textarea name="message" placeholder="Poruka"></textarea>
					<button>Posalji</button>
				</form>

			</div>
	</footer>
</body>



<!-- -------------------------- SCRIPT ----------------------- -->
<script type="text/javascript">
	var navigation = document.getElementById("navigation");
    var nav_close = document.getElementById("menu-close");
    var nav_open = document.getElementById("menu-open");

    nav_open.onclick = function() {
        navigation.style.left = "0";
    }

    nav_close.onclick = function() {
        navigation.style.left = "100vw";
    }
</script>
</html>