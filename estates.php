<?php 

	require_once("connection.php");
	session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Kuce</title>
	<link rel="stylesheet" type="text/css" href="listStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="slike/house.png">
</head>
<body background="#f2f2f2">
<!-- ---------------------ITEM INFO--------------------- -->
	<div class="info-container" id="info-container">
		<!-- ---------------------ITEM CONTAINER--------------------- -->
		<div class="item-container">
			<!-- ---------------------ITEM INFO--------------------- -->
			<div class="item-img"><img src="kuce/kuca1.jpg" id="item-img"></div>
			<div class="item-info">
				<!-- ---------------------ITEM CLOSE AND BUY--------------------- -->
				<span class="item-close" id="item-close">&times;</span> <!-- CLOSE BUTTON -->
				<form class="rent-form" method="post" action="actions.php">
					<?php if(isset($_SESSION['open_item'])){
						$item_id = $_SESSION['open_item'];
					} ?>
					<?php if(isset($_SESSION['username']) && !isset($_GET["user"]) && $_GET["type"] != 0){ ?>
						<input type="number" name="rent_days" placeholder="Broj dana" autocomplete="off" required min="1" max="100">
						<button class="item_rent" value="<?php echo $item_id ?>" name="item_rent">Rentaj</button>
					<?php } ?>
				</form>
				<!-- -------------------------------------------------------------------- -->
				<div class="item-title"><h2  id="item-title">Kuca sa pogledom na more</h2></div>
				<div class="item-price"><p id="item-price">120 BAM / dan</p></div>
				<div class="item-about"><p id="item-about">Jednospratna kuca sa pogledom na more koja ima sve prikljucke, grijanje, klimu, kamin, rostilj</p></div>
			</div>
		</div>
	</div>
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
			<!-- ---------------------SEARCH BAR--------------------- 
			<form class="srb" action="" style="margin:auto;">
			  	<input type="text" placeholder="Pretraga.." name="search2">
			  	<button type="submit"><i class="fa fa-search"></i></button>
			</form> -->
			<!-- ---------------------MENU--------------------- -->
			<span class="menu" id="menu-open"><i class="fa fa-bars"></i></span>
		</div>
	</div>
<!-- ---------------------MAIN CONTAINER--------------------- -->
	<div id="main-container" class="main-container">
		<?php 
			if(isset($_GET["type"])){
				$type = $_GET["type"];
					if($type == 0 && $_SESSION["admin"] == 1){
						$query = "SELECT * FROM estates";
					}
					else{
						$query = "SELECT * FROM estates WHERE type='$type' AND rented='0'";
					}
					$r = mysqli_query($db, $query);
					if(mysqli_num_rows($r) < 1){
						$_SESSION["message"] = "Nema slobodnih nekretnina ove vrste u bazi!";
						header("location: index.php");
					}
					else{
						while($row = mysqli_fetch_assoc($r)){
							$id	   		= $row["id"];
							$title 		= $row["title"];
							$price 		= $row["price"];
							$about		= $row["about"];
							$location 	= $row["location"];
							$rented_by 	= $row["rented_by"];
							$rent_days  = $row["days"];
					?>
							<form class="box-container" id="box-container" action="actions.php" method="post">
								<div> 
									<div class="box-img">
										<img src="Uploads/<?php echo $row['image'] ?>">
									</div>
									<h3 class="box-title" id="box-title"><?php echo $title ?></h3>
									<p class="box-info">- <?php echo $location ?> -</p>
									<?php if(!empty($rented_by) && $_GET["type"] == 0){ ?>
										<p class="box-info">Rentao <span style="color: #5383d3; font-weight: bold;"><?php echo $rented_by ?></span> na <span style="color: #5383d3; font-weight: bold;"><?php echo $rent_days ?> dan/a</span></p>
									<?php }
										else if(empty($rented_by) && $_GET["type"] == 0){ ?>
											<p class="box-info" style="color: green;">Slobodna nekretnina</p>
									<?php } ?>
									<p class="box-price"><?php echo $price ?> BAM / dan</p>
									<p class="box-info" style="min-height: 50px;">
										<?php 
											if(strlen($about) <= 80)
												echo $about;
											else
												echo substr($about, 0, 80)."...";
										?>
									</p>
									<input type="text" name="item_type" value="<?php echo $type ?>" style="display: none;">
									<button name="info_item" value="<?php echo $id ?>" style="margin-bottom: 15px;">Info</button>
								</div>
							</form>
					<?php }}}
			else if(isset($_GET["user"])){
				$user = $_GET["user"];
				$username = $_SESSION["username"];
				if($user === $username){
					$query = "SELECT * FROM estates WHERE rented_by='$username' AND rented='1'";
					$r = mysqli_query($db, $query);
					if(mysqli_num_rows($r) == 0){
						$_SESSION["message"] = "Nemate rentanih nekretnina";
						header("location: index.php");
					}
					else{
						while($row = mysqli_fetch_assoc($r)){
								$id 	   = $row["id"];
								$title     = $row["title"];
								$location  = $row["location"];
								$price     = $row["price"];
								$about     = $row["about"];
								$rented_by = $row["rented_by"];
								$rent_days = $row["days"];
							?>
							<form class="box-container" id="box-container" action="actions.php" method="post">
								<div> 
									<div class="box-img">
										<img src="Uploads/<?php echo $row['image'] ?>">
									</div>
									<h3 class="box-title" id="box-title"><?php echo $title ?></h3>
									<p class="box-info">- <?php echo $location ?> -</p>
									<?php if(!empty($rent_days) && $_GET["user"] == $rented_by){ ?>
										<p class="box-info">Rentano na <span style="color: #5383d3; font-weight: bold;"><?php echo $rent_days ?> dan/a</span></p>
									<?php } ?>
									<p class="box-price"><?php echo $price ?> BAM / dan</p>
									<p class="box-info" style="min-height: 50px;">
										<?php 
											if(strlen($about) <= 80)
												echo $about;
											else
												echo substr($about, 0, 80)."...";
										?>
									</p>
									<input type="text" name="rented_by" value="<?php echo $rented_by ?>" style="display: none;">
									<button name="info_item_user" value="<?php echo $id ?>" style="margin-bottom: 15px;">Info</button>
									<?php if(@$_GET["user"] === $_SESSION['username']){ ?>
										<br>
										<button name="item_unrent" value="<?php echo $id ?>" style="margin-bottom: 15px;">Odrentaj</button>
									<?php } ?>
								</div>
							</form>
			<?php }}}
				else{
					$_SESSION['message'] = "Ne mozete pristupiti ovom linku!";
					header("location: index.php");
				}
			}
			else{
				header("location: index.php");
			}
		?>
	</div>
<!-- -------------------ALERT/INFO POP UP----------------- -->
	<div class="alert-container" id="alert-container">
		<p class="alert-message" id="alert-message">Alert</p>
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
</body>


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

    var item_container = document.getElementById("info-container")
    var item_close = document.getElementById("item-close");

    item_close.onclick = function() {
    	item_container.style.top = "-100vh";
    }

</script>
</html>

<!-- -------------------------------- -->
<?php if(isset($_SESSION["open_item"]) && $_SESSION["open_item"] != -1) { 
	$item_id = $_SESSION["open_item"];
	$_SESSION["open_item"] = -1;

	$query = "SELECT * FROM estates WHERE id='$item_id'";
	$r = mysqli_query($db, $query);
	if($row = mysqli_fetch_assoc($r)){
?>

<script>

		document.getElementById("item-img").src = "Uploads/<?php echo $row['image']; ?>";
		document.getElementById("item-title").innerHTML = "<?php echo $row['title'] ?>";
		document.getElementById("item-price").innerHTML = "<?php echo $row['price'] ?> BAM / dan";
		document.getElementById("item-about").innerHTML = "<?php echo $row['about'] ?>";

		setTimeout(function() {
			document.getElementById("info-container").style.top = "0";
		}, 500);
</script>

<?php }} ?>

<?php if(isset($_SESSION['estates_message']) && $_SESSION["estates_message"] != "x"){ 
		$msg = $_SESSION['estates_message'];
		$_SESSION['estates_message'] = "x";
?>
	<script>
		document.getElementById("alert-message").innerHTML = "<?php echo $msg ?>";
		document.getElementById("alert-container").style.top = "20%";
		setTimeout(function() {
			document.getElementById("alert-container").style.top = "-40%";
		}, 3000);

	</script>
<?php } ?>