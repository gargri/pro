<?php include ( "inc/connect.inc.php" ); ?>
<?php
ob_start();
session_start();
$link=mysqli_connect("localhost","root","","ebuybd");
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($link,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}

if (isset($_REQUEST['keywords'])) {

	$epid = mysqli_real_escape_string($link,$_REQUEST['keywords']);
	if($epid != "" && ctype_alnum($epid)){

	}else {
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

$search_value = "";
$search_value = trim($_GET['keywords']);

?>

<!DOCTYPE html>
<html>
<head>
	<title>BOOKS</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="homepageheader">
		<div class="signinButton loginButton">
			<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
				<?php
					if ($user!="") {
						echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
					}
					else {
						echo '<a style="text-decoration: none; color: #fff;" href="signin.php">SIGN IN</a>';
					}
				 ?>

			</div>
			<div class="uiloginbutton signinButton loginButton" style="">
				<?php
					if ($user!="") {
						echo '<a style="text-decoration: none; color: #fff;" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
					}
					else {
						echo '<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>';
					}
				 ?>
			</div>
		</div>
		<div style="float: left; margin: 5px 0px 0px 23px;">
			<a href="index.php">
				<img style=" height: 75px; width: 130px;" src="book8.png">
			</a>
		</div>
		<div id="srcheader">
				<form id="newsearch" method="get" action="search.php">
				        <?php
				        	echo '<input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..." value="'.$search_value.'"><input type="submit" value="search" class="srcbutton" >';
				         ?>
				</form>
			<div class="srcclear"></div>
		</div>
	</div>
	<div class="categolis">
		<table>
			<tr>
				<th>
					<a href="book/Novels.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">Novels</a>
				</th>
				<th><a href="book/CS.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">CS</a></th>
				<th><a href="book/Electrical.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">Electrical</a></th>
				<th><a href="book/Mechanical.php" style="text-decoration: none;color: #ddd;padding: 4px 12px">Mechanical</a></th>
				<th><a href="book/Electronics.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">Electronics</a></th>
				<th><a href="book/Auto-mobile.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">Auto-mobile</a></th>
				<th><a href="book/Civil.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">Civil</a></th>
				<th><a href="book/IT.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">IT</a></th>
			</tr>
		</table>
	</div>
	<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<div>
		<?php
			if (isset($_GET['keywords']) && $_GET['keywords'] != ""){
				$search_value = trim($_GET['keywords']);
				$getposts = mysqli_query($link,"SELECT * FROM products WHERE pName like '%$search_value%'  ORDER BY id DESC") or die(mysql_error());
					if ( $total = mysqli_num_rows($getposts)) {
					echo '<ul id="recs">';
					echo '<div style="text-align: center;"> '.$total.' Books Found... </div><br>';
					while ($row = mysqli_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];

						echo '
							<ul style="float: left;">
								<li style="float: left; padding: 0px 25px 25px 25px;">
									<div class="home-prodlist-img"><a href="book/view_product.php?pid='.$id.'">
										<img src="image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.'  ₹</div>
									</div>

								</li>
							</ul>
						';

						}
				}else {
				echo "Nothing Found!";
			}
			}else {
				echo "Input Someting...";
			}

		?>

		</div>
	</div>
</body>
</html>
