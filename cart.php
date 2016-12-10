<?php
spl_autoload_register("loadClass");
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION["ten_dang_nhap"]))
{
		echo "Hãy đăng nhập tài khoản";
		exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style>
td a {
	color: #00F;
	font-size: 20px;
}
</style>
<body>
<div style="text-align:center;font-size:36px;margin-bottom:0px ">Giỏ Hàng Của <?php echo $_SESSION["ten_dang_nhap"] ?></div>
<table border="1" style="margin:0 auto; width:auto">
  <tr>
    <td>TENSP</td>
    <td>Gia</td>
    <td>So luong</td>
    <td>ThanhTien</td>
    <td colspan="3"></td>
  </tr>
  <?php
//session_destroy();
$cart = new Cart();
$tong = 0;
$dataecho = array();
if(isset($_GET['id'])&& !empty($_GET['id']) )
{
	$id = $_GET['id'];
	@$_SESSION["name"][$id]+=1; 	
}
if(isset($_GET['add']))
{
	$_SESSION["name"][$_GET['add']]+=1;
}
if(isset($_GET['tru']))
{
	$_SESSION["name"][$_GET['tru']]--;
}
if(isset($_GET['del']))
{
	unset($_SESSION["name"][$_GET['del']]);
}
if(isset($_SESSION["name"]))
{
	//echo "<pre>",print_r($_SESSION["name"]),"<pre>";
	foreach ($_SESSION["name"] as $key=>$value)	
		{
			//echo $key." ".$value."<br/>";
			if($value > 0)
			{
			$sql = "select * from loai_san_pham inner join san_pham on loai_san_pham.MA_LOAI_SP = san_pham.MA_LOAI_SP left join chi_tiet_bang_gia on san_pham.MA_SP = chi_tiet_bang_gia.MA_SP inner join khuyen_mai on san_pham.MA_KM = khuyen_mai.MA_KM where san_pham.MA_SP ='$key'";
			$data = $db->QueryAll($sql);
			//echo "<pre>",print_r($_SESSION['name']),"<pre>";
			//echo "<pre>",print_r($data),"<pre>";
			$tongtien = $value*($data[0]['GIA']-($data[0]['GIA']*($data[0]['CHIETKHAU']/100)));
			echo "<tr><td>".$data[0]['TEN_SP']."</td><td> ".$data[0]['GIA']."</td><td>".$value."</td><td> ".$tongtien."</td><br/><td><a href='index.php?mod=giohang&add=".$key."'>[+]</a></td><td><a href='index.php?mod=giohang&tru=".$key."'>[-]</a></td><td><a href='index.php?mod=giohang&del=".$key."'>[Xoa]</a></td></tr>";	
			}
		$tong +=$tongtien;
		//echo "<pre>",print_r($data[0]['MA_SP']),"<pre>";
     ?>
     <form action="" method="post">
    <input type="text" readonly="readonly" name="makh" value="<?php echo $_SESSION["makh"] ?>" hidden="hidden"/>
    <input type="text" readonly="readonly" name="ngaydh" value="<?php echo date(DATE_ATOM) ?>" hidden="hidden"/>
    <input type="text" readonly="readonly" name="trangthai" value="0" hidden="hidden"/>
	<input type="text" readonly="readonly" name="sp" value="<?php echo $data[0]['MA_SP']; ?>" hidden="hidden"/>
    <input type="text" readonly="readonly" name="sl" value="<?php echo $_SESSION["name"]["$key"]; ?>" hidden="hidden"/>
    <input type="text" readonly="readonly" name="tien" value="<?php echo $data[0]['GIA'] * $value-($data[0]['GIA']*$data[0]['CHIETKHAU']/100)?>" hidden="hidden"/>	
	<?php 
	$thanhtien=$data[0]['GIA'] * $value-($data[0]['GIA']*$data[0]['CHIETKHAU']/100);
	$dataecho[]=array('ngaydh'=> date(DATE_ATOM),'ngaygh'=> date('d/M/y'),'masp'=>$data[0]['MA_SP'],'sl'=>$_SESSION["name"]["$key"],'thanhtien'=>$thanhtien);
	}
	?><tr><td>Ngay Giao Hang</td><td colspan="6"><input type="date"  name="ngaygh" value="" /></td></tr>
<?php }
echo "<tr><td colspan=7>"."Tổng tiền :".$tong."</td></tr>";
$tb ="";
$flag = true;
if(isset($_POST) && isset($_POST["Dathang"]))
{
$dh = new DonHang();
$makh = $_POST["makh"];
$ngaydh = $_POST["ngaydh"];
$ngaygh = $_POST["ngaygh"];
$tt = $_POST["trangthai"];
if($ngaygh < $ngaydh)
{
	$tb = "Đặt hàng thất bại";
	$flag = false;	
}
if($flag){
$xuly = $dh->themdh(NULL,$makh,$ngaydh,$ngaygh,$tt);
$sql = "select MA_DON_HANG from don_dat_hang order by don_dat_hang.MA_DON_HANG ASC";
$row = $db->QueryAll($sql);
//echo "<pre>",print_r($row),"</pre>";
$cuoi= $row[count($row)-1]['MA_DON_HANG'];
//echo $cuoi;
//echo "<pre>",print_r($_SESSION["name"]),"<pre>";
//echo "<pre>",print_r($dataecho),"<pre>";
foreach($dataecho as $key=>$value)
{
	$_SESSION["xulydh"] = $dh->themctdh($cuoi,$value['masp'],$value['sl'],$value['thanhtien']);
}
?> 
<script> alert("Dat hang thanh cong");
window.location="index.php";
</script>
<?php
}}?>
<tr style="text-align:center;"><td colspan="7"><button type="submit" name="Dathang">Đặt Hàng</button></td></tr>
<?php if($tb){ ?><tr style="text-align:center; color:#F00"><td colspan="7"><?php echo $tb; }?></td></tr>
</table>
<div style="padding:0 600px;"> <a target="_blank" href="https://www.nganluong.vn/button_payment.php?receiver=anhduy.bui1995@gmail.com&product_name=AA&price=<?php echo $tong; ?>&return_url=(URL thanh toán thành công)&comments=(Ghi chú về đơn hàng)"><img src="https://www.nganluong.vn/css/newhome/img/button/safe-pay-3.png"border="0" /></a> </div>

</form>
</body>
</html>
