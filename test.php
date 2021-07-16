<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dropdown menu</title>
	<style>
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body{
			overflow-x: hidden;
		}
		.main-container{
			position: relative;
			width: 100vw;
			min-height: 50px;
			background-color: #333;

			display: flex;
			justify-content: center;
		}
		.navigation-container{
			position: relative;
			width: 900px;
			height: 50px;

			display: flex;
			justify-content: center;
			background: gray;
		}
		.navigation{
			list-style: none;
		}
		.navigation li{
			position: relative;
			float: left;
		}
		.navigation li a{
			display: block;
			color: #000;
			font-size: 20px;
			padding: 10px;
			text-decoration: none;
			min-height: 50px;
		}
		.navigation a:hover{
			background-color: tomato;
		}
		.navigation ul{
			position: absolute;
			list-style: none;

			background: gray;
			display: none;
		}
		.navigation ul li{
			width: 200px;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<div class="main-container">
		<div class="navigation-container">
			<ul class="navigation">
				<li><a href="#">Product1</a></li>
				<li>
					<a href="#" class="dropdown">Product2</a>
					<ul class="dropdown-navigation">
						<li><a href="#">Dropdown1</a></li>
						<li><a href="#">Dropdown1</a></li>
						<li><a href="#">Dropdown1</a></li>
					</ul>
				</li>
				<li><a href="#">Product3</a></li>
				<li><a href="#">Product4</a></li>
			</ul>
		</div>
	</div>
</body>
<script>
$(document).ready(function(){
	$('.dropdown').hover(function(){
		$('.dropdown-navigation').css('display', 'auto');
	});
	$('.dropdown-navigation').hover(function(){
		#('.dropdown-navigation').
	});
});
</script>
</html>