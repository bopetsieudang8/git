<?php
spl_autoload_register("loadClass");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php 
	if(isset($_GET) && isset($_GET['Tim']))
	{
		$sp = new Cake();
		$gttim = $_GET['gttim'];
		if($gttim!="")
		{
			$rows = $sp->timsp($gttim);
		}
	}
?>
<body>
<div class="container-fluid">
  <div class="row">
    <?php 
if(isset($rows) && $rows !=null){
foreach ($rows as $value){ ?>
    <div class="col-md-3 " style="height:340px"> <a href="#">
      <div class="hinh">
        <?php if($value['MA_LOAI_SP'] == "H001"){?>
        <div> <img src="images/Hot/<?php echo $value['HINH_ANH']; ?>" /><div class="chitiet"><?php echo $value['DAC_DIEM']?></div> </div>
        <?php }?>
        <?php if($value['MA_LOAI_SP'] == "K001"){?>
        <div> <img src="images/KM/<?php echo $value['HINH_ANH']; ?>" /> <div class="chitiet"><?php echo $value['DAC_DIEM']?></div></div>
        <?php }?>
        <?php if($value['MA_LOAI_SP'] == "N001"){?>
        <div> <img src="images/New/<?php echo $value['HINH_ANH']; ?>" /> <div class="chitiet"><?php echo $value['DAC_DIEM']?></div></div>
        <?php }?>
        <?php if($value['MA_LOAI_SP'] == "BC001"){?>
        <div> <img src="images/banhcuoi/<?php echo $value['HINH_ANH']; ?>" /> <div class="chitiet"><?php echo $value['DAC_DIEM']?></div></div>
        <?php }?>
        <?php if($value['MA_LOAI_SP'] == "LT001"){?>
        <div> <img src="images/banhletiec/<?php echo $value['HINH_ANH']; ?>" /><div class="chitiet"><?php echo $value['DAC_DIEM']?></div> </div>
        <?php }?>
        <?php if($value['MA_LOAI_SP'] == "BK001"){?>
        <div> <img src="images/banhkhac/<?php echo $value['HINH_ANH']; ?>" /> <div class="chitiet"><?php echo $value['DAC_DIEM']?></div></div>
        <?php }?>
        <?php if($value['MA_LOAI_SP'] == "SN001"){?>
        <div> <img src="images/banhsinhnhat/<?php echo $value['HINH_ANH']; ?>" /><div class="chitiet"><?php echo $value['DAC_DIEM']?></div> </div>
        <?php }?>
        
      </div>
      </a>
      <div class="row">
        <div class="col-md-offset-3 col-md-7"> <?php echo $value['TEN_SP']?> </div>
     <div class="col-md-12">
        <div class="col-md-7" style="color:#F00;">Giá Gốc: </div><div class="col-md-5" style="color:#F00; <?php if($value["CHIETKHAU"]!=0){ ?> text-decoration:line-through <?php }?>"> <?php echo $value['GIA'] ?> VND </div>
        <?php if($value["CHIETKHAU"]!=0){ ?><div class="col-md-7" style="color:#F00" >Giá Khuyến Mãi: </div> <div class="col-md-5" style="color:#F00"><?php echo $value['GIA']-(($value['CHIETKHAU']/100)*$value['GIA']) ?> VND</div><?php } ?>
          <a href="index.php?mod=giohang&them=add&id=<?php echo $value['MA_SP'] ?>&dongia=<?php echo $value['GIA']?>" style="color:#009">
          <div class="col-md-offset-2 col-md-4">Đặt mua </div>
          </a> </div>
      </div>
    </div>
    <?php }}
else{
	echo "Không tổn tại từ khoá '" .$_GET['gttim']."'";	
}
?>
  </div>
</div>

</body>
</html>