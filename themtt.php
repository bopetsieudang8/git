<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php 
$nhanvien = new NhanVien(); 
$sql = "select MA_NV from nhan_vien";
$rows = $nhanvien->QueryAll($sql);
?>
<?php 
if(isset($_POST) && isset($_POST['Them']) && isset($_FILES))
{
	$tin = new TinTuc();
	$matt = $_POST['matt'];
	$manv = $_POST['manv'];
	$tieude = $_POST['tieude'];
	$noidung = $_POST['tintuc'];
	$hinhanh = $_FILES['hinhanh']['name'];
	$data = $tin->themtin($matt,$manv,$tieude,$noidung,$hinhanh);
	echo "Thêm thành công";
}
?>
<body>
<table style="margin:0 auto; text-align:center; background:#CCC;">
  <form action="" method="post" enctype="multipart/form-data">
    <tr bgcolor="#FF0000">
      <td colspan="2">Form Thêm tin tức</td>
    </tr>
    <tr>
      <td>Mã tin tức : </td>
      <td><input type="text" name="matt" id="" value=""/></td>
    </tr>
    <tr>
      <td>Mã NV : </td>
      <td><select name="manv">
          <?php foreach ($rows as $value){?>
          <option value="<?php echo $value['MA_NV']; ?>"><?php echo $value['MA_NV']; ?></option>
          <?php }?>
        </select></td>
    </tr>
    <tr>
      <td>Tiêu đề : </td>
      <td><input type="text" name="tieude" id="" value=""/></td>
    </tr>
    <tr>
      <td>Nội dung : </td>
      <td><textarea name="tintuc" rows="10" cols="50" role="combobox" > </textarea></td>
    </tr>
    <tr>
      <td>Hình ảnh : </td>
      <td><input type="file" name="hinhanh" id="" value=""/></td>
    </tr>
    <tr>
      <td colspan="2"><button type="submit" value="" name="Them">Thêm</button>
        <button type="reset" value="" name="Them">Reset</button></td>
    </tr>
  </form>
</table>
<div style="margin:0 auto; width:250px;"><a href="index.php?mod=tintuc&ac=xemtt">Quay lại trang quản lý tin tức</a></div>
</body>
</html>