<?php
include "config/config.php";
include ROOT."/include/function.php";
if (!isset($_SESSION)) session_start();
spl_autoload_register("loadClass");
$db= new DB();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bakery Store</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<header> 
  <?php 
  	include"include/header.php";
  ?>
</header>
<?php 
	include"include/menu.php";
?>
<body>
<section>
  <div >
  	<?php include "mod.php"?>
  </div>
</section>
<footer class="container-fluid footer">
  <div> &copy; 2016 All Right Reserved &bull; Design by Alphatek Company </div>
  <div>
    <div class="fa fa-facebook-square fa-2x"> </div>
    <div class="fa fa-youtube-square fa-2x"> </div>
  </div>
  <div class="clear"></div>
  <div ><span> Giờ làm việc: từ thứ 2 - CN ( 7am - 10pm  )</span></div>
  <div ><span> Địa chỉ: 54/1 Bông Sao P5 Q8 </span></div>
</footer>
</body>
</html>
