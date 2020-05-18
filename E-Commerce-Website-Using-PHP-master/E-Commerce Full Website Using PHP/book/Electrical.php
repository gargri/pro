<?php include ( "../inc/connect.inc.php" ); ?>
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>BOOKS</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include ( "../inc/mainheader.inc.php" ); ?>
	<div class="categolis">
		<table>
			<tr>
				<th>
					<a href="Novels.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">Novels</a>
				</th>
				<th><a href="CS.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">CS</a></th>
				<th><a href="Electrical.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">Electrical</a></th>
				<th><a href="Mechanical.php" style="text-decoration: none;color: #ddd;padding: 4px 12px">Mechanical</a></th>
				<th><a href="Electronics.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">Electronics</a></th>
				<th><a href="Auto-mobile.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">Auto-mobile</a></th>
				<th><a href="Civil.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">Civil</a></th>
				<th><a href="IT.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;">IT</a></th>
			</tr>
		</table>
	</div>
	<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<div>
		<?php
			$getposts = mysqli_query($link,"SELECT * FROM products WHERE available >='1' AND item ='watch'  ORDER BY id DESC LIMIT 10") or die(mysql_error());
					if (mysqli_num_rows($getposts)) {
					echo '<ul id="recs">';
					while ($row = mysqli_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];

						echo '
							<ul style="float: left;">
								<li style="float: left; padding: 0px 25px 25px 25px;">
									<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">
										<img src="../image/product/watch/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' ₹</div>
									</div>

								</li>
							</ul>
						';

						}
				}
		?>

		</div>
	</div>
</body>
</html>
