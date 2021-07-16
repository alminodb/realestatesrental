<?php 
	session_start();
	require_once("connection.php");
/* -------------------------------------------------LOGIN */
	if(isset($_POST["loginButton"])){
		$username = $_POST["userName"];
		$password = $_POST["password"];

		$query = "SELECT * FROM users WHERE username ='".$username."' AND password='".$password."'";
		$result = mysqli_query($db, $query);
		if(mysqli_num_rows($result) != 1){
			header("location: index.php?login=incorrect");
		}
		else{
			if($row = mysqli_fetch_assoc($result)){
				$_SESSION["user_id"] = $row["id"];
				$_SESSION["name"] = $row["name"];
				$_SESSION["lastname"] = $row["lastName"];
				$_SESSION["username"] = $row["username"];
				$_SESSION["admin"] = $row["admin"];
			}
			$_SESSION["message"] = "Uspjesno ste se ulogovali";
			header("location: index.php");
		}
	}
	
/* ------------------------------------------------REGISTER */
	if(isset($_POST["registerButton"])){
		$name 	  = $_POST["name"];
		$lastname = $_POST["lastName"];
		$username = $_POST["userName"];
		$password = $_POST["password"];

		$query = "SELECT * FROM users WHERE username='".$username."'";
		$result = mysqli_query($db, $query);
		if(mysqli_num_rows($result) != 0){
			header("location: index.php?register=has_user");
		}
		else{
			ucfirst($name); ucfirst($lastname);
			$query = "INSERT INTO users (name, lastName, username, password) VALUES ('".$name."','".$lastname."','".$username."','".$password."')";
			$r = mysqli_query($db, $query);
			if(!$r){
				header("location: index.php?register=failed");
			}
			else{
				$query = "SELECT id FROM users WHERE username='$username'";
				$result = mysqli_query($db, $query);
				if($row = mysqli_fetch_assoc($result)){
					$_SESSION['user_id'] = $row["id"];
				}
				$_SESSION["username"] = $username;
				$_SESSION["name"] = $name;
				$_SESSION["lastname"] = $lastname;
				$_SESSION["admin"] = $row["admin"];
				$_SESSION["message"] = "Uspjesno ste se registrovali na nas website";
				header("location: index.php");
			}
		}
	}

/* ------------------------------------------------LOGOUT */
	if(isset($_POST["logout"])){
		if(isset($_SESSION['username'])){
			session_destroy();
			session_start();
			$_SESSION["message"] = "Uspjesno ste se odjavili";
			header("location:index.php");
		}
		else{
			header("location: index.php");
		}
	}

/* --------------------------------------ADDING ESTATES */
	if(isset($_POST["add-estate"])){
		$type	  = $_POST["type"];
		$title 	  = $_POST["title"];
		$price 	  = $_POST["price"];
		$about 	  = $_POST["about"];
		$location = $_POST["location"];
		
		/* IMAGE */

			$file = $_FILES["picture"];
			$fileName = $_FILES["picture"]["name"];
			$fileOldName = $_FILES["picture"]["tmp_name"];

			$file_tmpExt = explode(".", $fileName);
			$fileExt = strtolower(end($file_tmpExt));

			$fileError = $_FILES["picture"]["error"];

		if($fileError === 0){
			$fileNewName = uniqid('', true).".".$fileExt;
			move_uploaded_file($fileOldName, "Uploads/".$fileNewName);
			$query = "INSERT INTO estates (type, title, price, about, location, image, rented, rented_by) VALUES ('$type', '$title', '$price', '$about', '$location', '$fileNewName', 'false', '')";

			mysqli_query($db, $query);

			$_SESSION['estates_message'] = "Uspjesno ste dodali nekretninu!";
			header("location: estates.php?type=".$type);
		}
		else{
			die("Greska pri uploadovanju fajla");
		}
	}

/* ------------------------------------ ITEM OPEN */
	if(isset($_POST["info_item"])){
		$id = $_POST["info_item"];
		$type = $_POST["item_type"];
		$_SESSION["open_item"] = $id;
		header("location: estates.php?type=".$type);
	}
	if(isset($_POST["info_item_user"])){
		$id = $_POST["info_item_user"];
		$rented_by = $_POST["rented_by"];
		$_SESSION["open_item"] = $id;
		header("location: estates.php?user=".$rented_by);
	}
/* ------------------------------------ ITEM RENT */
	if(isset($_POST["item_rent"])){
		$id 	   = $_POST["item_rent"];
		$rent_days = $_POST["rent_days"];
		if(isset($_SESSION['username'])){
			$username = $_SESSION['username'];
			$query = "UPDATE estates SET rented='1', rented_by='$username', days='$rent_days' WHERE id='$id'";
			$r = mysqli_query($db, $query);
			if(!$r){
				$_SESSION['message'] = "Nije moguce rentati ovu nekretninu!";
				header("location: index.php");
			}
			else{
				$_SESSION['estates_message'] = "Uspjesno ste rentali nekretninu";
				header("location: estates.php?user=".$username);
			}
		}
		else{
			$_SESSION['message'] = "Morate se ulogovati";
			header("location: index.php");
		}
	}
/* ------------------------------------ ITEM UNRENT */
	if(isset($_POST["item_unrent"])){
		$id = $_POST["item_unrent"];
		$query = "UPDATE estates SET rented='0', rented_by='', days='0' WHERE id='$id'";
		$r = mysqli_query($db, $query);
		if(!$r){
			$_SESSION["message"] = "Dogodila se greska!";
			header("location: index.php");
		}
		else{
			$_SESSION['message'] = "Uspjesno ste odjavili nekretninu.";
			header("location: index.php");
		}
	}

?>