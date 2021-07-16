<?php
	session_start();
	if(isset($_SESSION["username"])){
		$id = $_SESSION['user_id'];
		$name = $_SESSION['name'];
		$lastname = $_SESSION['lastname'];
		$username = $_SESSION['username'];
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Real Estate Rental</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="slike/house.png">
</head>
<body>
<!-- -------------------LOGIN POPUP----------------- -->
	<div class="login-bcg" id="login-bcg">
		<span class="logreg-close" id="login-close">&times;</span> <!-- CLOSE BUTTON -->
		<div class="logreg-container">
			<span class="logreg-title"><h1>Prijava</h1></span>
			<div class="logreg-message">
				<h3 id="login-message">Unesite vase podatke za prijavu</h3>
			</div>
			<!-- LOGIN FORM -->
			<form action="actions.php" method="post">
				<input type="text" name="userName" placeholder="Username" autocomplete="off" required>
				<input type="password" name="password" placeholder="Password" required>
				<input type="submit" name="loginButton" class="logreg-btn">
			</form>
		</div>
	</div>
<!-- -------------------REGISTER POPUP----------------- -->
	<div class="register-bcg" id="register-bcg">
		<span class="logreg-close" id="register-close">&times;</span> <!-- CLOSE BUTTON -->
		<div class="logreg-container">
			<span class="logreg-title"><h1>Registracija</h1></span>
			<div class="logreg-message">
				<h3 id="register-message">Unesite vase podatke za registraciju</h3>
			</div>
			<!-- REGISTER FORM -->
			<form action="actions.php" method="post">
				<input type="text" name="name" placeholder="Ime" autocomplete="off" required>
				<input type="text" name="lastName" placeholder="Prezime" autocomplete="off" required>
				<input type="text" name="userName" placeholder="Username" autocomplete="off" required>
				<input type="password" name="password" placeholder="Password" required>
				<input type="submit" name="registerButton" class="logreg-btn">
			</form>
		</div>
	</div>
<!-- -------------------ALERT/INFO POP UP----------------- -->
	<div class="alert-container" id="alert-container">
		<p class="alert-message" id="alert-message">Alert</p>
	</div>
<!-- -------------------NAVIGACIJA----------------- -->
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
<!-- -------------------HEADER----------------- -->
	<div class="header">
		<span class="menu" id="menu-open"><i class="fa fa-bars"></i></span>
		<!-- -------------------NASLOV----------------- -->
		<div class="title">
			<a href="index.php"><h1 class="header-title">RealEstate<span>Rental</span></h1></a>
		</div>
		<!-- -------------------LOGIN AND REGISTER----------------- -->
		<?php if(!isset($_SESSION['username'])){ ?>
					<div class="logreg">
						<a class="btn-logreg login" id="login-btn">Prijava</a>
						<a class="btn-logreg register" id="register-btn">Registracija</a>
					</div>
		<?php } else { ?>
					<div class="logreg"><h1 class="welcome">Welcome <?php echo $name ?></h1></div>
		<?php } ?>
	</div>
<!-- -------------------DESCRIPTION----------------- -->
	<div class="description">
		<h2>RealEstateRental vam omogucava rentanje svih vrsta nekretnina na najboljim lokacijama za najnize cijene</h2>
	</div>
<!-- -------------------TABOVI----------------- -->
	<div class="tabs">
		<!-- -------------------KUCE----------------- -->
		<div class="tab houses">
			<div class="img-container"><img src="slike/house.png" class="img house"></div>
			<p class="description">Kuce u centru i periferiji grada</p>
			<div class="btn-container"><a class="button" href="estates.php?type=1">Pogledaj</a></div>
		</div>
		<!-- -------------------STANOVI----------------- -->
		<div class="tab apartments">
			<img src="slike/apartments.png" class="img apartment">
			<p class="description">Stanovi sa najboljom lokacijom i najboljim pogledom</p>
			<div class="btn-container"><a class="button" href="estates.php?type=2">Pogledaj</a></div>
		</div>
		<!-- -------------------POSLOVNI PROSTORI----------------- -->
		<div class="tab pps">
			<img src="slike/office.png" class="img pp">
			<p class="description">Poslovni prostori na najaktuelnijim lokacijama</p>
			<div class="btn-container"><a class="button" href="estates.php?type=3">Pogledaj</a></div>
		</div>
	</div>
<!-- -------------------CITY----------------- -->
	<div class="city"></div>
<!-- -------------------FOOTER----------------- -->
	<footer class="footer-distributed">
			<div class="footer-left">
				<h3>RealEstate<span>Rental</span></h3>
				<p class="footer-links">
					<a href="footer">Pocetna</a>

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



<!-- ---------------JAVASCRIPT-------------- -->
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

	var loginForm = document.getElementById("login-bcg");
	var login_open = document.getElementById("login-btn");
	var login_close = document.getElementById("login-close");
	var login_message = document.getElementById("login-message");

	login_open.onclick = function() {
		loginForm.style.left = "0";
	}

	login_close.onclick = function() {
		loginForm.style.left = "100vw";
		login_message.style.color = "gray";
		login_message.innerHTML = "Unesite vase podatke za prijavu";
	}

	var regForm = document.getElementById("register-bcg");
	var reg_open = document.getElementById("register-btn");
	var reg_close = document.getElementById("register-close");
	var reg_message = document.getElementById("register-message");

	reg_open.onclick = function() {
		regForm.style.left = "0";
	}

	reg_close.onclick = function() {
		regForm.style.left = "100vw";
		reg_message.style.color = "gray";
		reg_message.style.innerHTML = "Unesite vase podatke za registraciju";
	}

</script>

</html>


<!-- --------------------------PHP----------------------------------- -->
<?php if(@$_GET["login"] == "incorrect") { ?>
	<script>
		document.getElementById("login-bcg").style.left = "0";
		document.getElementById("login-message").style.color = "red";
		document.getElementById("login-message").innerHTML = "Username i Password se ne poklapaju";
	</script>
<?php } ?>

<?php if(@$_GET["register"] == "has_user") { ?>
	<script>
		document.getElementById("register-bcg").style.left = "0";
		document.getElementById("register-message").style.color = "red";
		document.getElementById("register-message").innerHTML = "Taj username vec postoji";
	</script>
<?php } ?>

<?php if(isset($_SESSION["message"]) && $_SESSION["message"] != "x"){ 
		$msg = $_SESSION["message"];
		$_SESSION["message"] = "x";
?>
	<script>
		document.getElementById("alert-message").innerHTML = "<?php echo $msg ?>";
		document.getElementById("alert-container").style.top = "20%";
		setTimeout(function() {
			document.getElementById("alert-container").style.top = "-40%";
		}, 3000);

	</script>
<?php } ?>