<?php
include 'connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="vi" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- Co giãn web theo tỉ lệ khung hình -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý nhân sự</title>
    <link rel="stylesheet" href="style.css">
    <script src="main.js" charset="utf-8"></script>
  </head>
  <body onload="showFieldsetSessions(); return false;">
    <header>
      <h2><strong>QUẢN LÝ NHÂN SỰ</strong></h2>
      <div class="menu-bar" id="menu-bar">
        <a onclick="showPage('trang-chu',[],[]); return false;">Trang chủ</a>
        <a onclick="showPage('qly-nhan-vien',[],[]); return false;">Quản lý nhân viên</a>
        <a onclick="showPage('qly-don-vi',[],[]); return false;">Quản lý đơn vị</a>
        <a onclick="showPage('qly-chuc-vu',[],[]); return false;">Quản lý chức vụ</a>
        <a onClick="window.location.reload()">Tải lại trang</a>
        <a style="font-size:15px;" class="icon" onclick="callMenuBar()">&#9776;</a>
      </div>
    </header>
    <div class="main-content" onclick="closeMenuBar()">
      <?php include 'trang_chu.php'; ?>
      <?php include 'qly_nhanvien.php'; ?>
      <?php include 'qly_nhanvien_them_nvien.php'; ?>
      <?php include 'qly_nhanvien_sua_nvien.php'; ?>
      <?php include 'qly_nhanvien_them_hinhanh.php'; ?>
      <?php include 'qly_nhanvien_sua_hinhanh.php'; ?>
      <?php include 'qly_donvi.php'; ?>
      <?php include 'qly_chucvu.php'; ?>
    </div>
    <footer>
      <h3 class="full-screen">VĂN LỘC B1400703 - NGUYÊN THỨC B1400731  | CT428 - LẬP TRÌNH WEB | PGS.TS ĐỖ THANH NGHỊ</h3>
      <h4 class="mobile-screen">Copyright @ 2018 <br> Nhóm Văn Lộc - Nguyên Thức</h4>
    </footer>
  </body>
</html>


<?php
// Thuchanh_3: HTML, PHP, MySQL
// // Thêm đơn vị
if(isset($_POST['add_dvi'])) {
  $sql_insert_cvu = "INSERT INTO loc_thuc_donvi VALUES ('{$_POST['madv']}', '{$_POST['dvi']}')"; // Ltweb
  $qry_insert_cvu = mysql_query($sql_insert_cvu);

  if ($qry_insert_cvu) echo "<script>alert('Thêm mới thành công!')</script>";
  else echo "<script>alert('Thêm mới thất bại!')</script>";

  echo '<meta http-equiv="refresh" content="0">';
}

// // Thêm chức vụ
if(isset($_POST['add_cvu'])) {
  $sql_insert_cvu = "INSERT INTO loc_thuc_chucvu VALUES ('{$_POST['macv']}', '{$_POST['cvu']}')"; // Ltweb
  $qry_insert_cvu = mysql_query($sql_insert_cvu);

  if ($qry_insert_cvu) echo "<script>alert('Thêm mới thành công!')</script>";
  else echo "<script>alert('Thêm mới thất bại!')</script>";

  echo '<meta http-equiv="refresh" content="0">';
}

// Thuchanh_4: HTML, PHP, MySQL
// // Thêm nhân viên
if(isset($_POST['them-nvien'])) {
  $sql_insert_nvien = "INSERT INTO loc_thuc_nhanvien VALUES ('{$_POST['manv']}', null, '{$_POST['hoten']}', '{$_POST['namsinh']}', '{$_POST['gioitinh']}', '{$_POST['donvi']}', '{$_POST['chucvu']}', '{$_POST['luong']}')"; // Ltweb
  $qry_insert_nvien = mysql_query($sql_insert_nvien);

  if ($qry_insert_nvien) echo "<script>
  sessionStorage.setItem('page', 'qly-nhan-vien');
  alert('Thêm mới thành công!');</script>";
  else echo "<script>alert('Thêm mới thất bại!')</script>";

  echo '<meta http-equiv="refresh" content="0">';
}

// // Thêm ảnh nhân viên
if(isset($_POST['upload_img_nv'])) {
  $manv = $_POST['manv'];

  // Upload ảnh
  if ($_FILES["img_nv"]["error"] > 0) {
      echo "Error: " . $_FILES["img_nv"]["error"] . "<br />";
  } else if (($_FILES["img_nv"]["size"] / 1024) <= 2048) { // Giới hạn kích thước nhỏ hơn 2MB
      // Tên file ảnh
      $img_tmp = addslashes(file_get_contents($_FILES['img_nv']['tmp_name']));

      // // Chèn nội dung file ảnh vào table loc_thuc_nhanvien
      $sql_upload_img_nvien = "UPDATE loc_thuc_nhanvien SET hinhanh = '{$img_tmp}' WHERE manv = '{$manv}'";
      $qry_upload_img_nvien = mysql_query($sql_upload_img_nvien);

      if ($qry_upload_img_nvien) echo "<script>
      sessionStorage.setItem('page', 'qly-nhan-vien');
      alert('Thao tác thành công!');</script>";
      else echo "<script>
      sessionStorage.setItem('page', 'qly-nhan-vien');
      alert('Thao tác thất bại!')</script>";
  }
  else {
      echo "<script>sessionStorage.setItem('page', 'qly-nhan-vien');
      alert('Thao tác thất bại!')</script>";
  }

  echo '<meta http-equiv="refresh" content="0">';
}

// Thuchanh_5: HTML, PHP, MySQL
// // Cập nhật thông tin nhân viên
if(isset($_POST['sua-nvien'])) {
  $sql_update_nvien = "UPDATE loc_thuc_nhanvien SET hoten = '".$_POST['hoten']."', namsinh = '".$_POST['namsinh']."', gioitinh = '".$_POST['gioitinh']."', madv = '".$_POST['donvi']."', macv = '".$_POST['chucvu']."', luong = ".$_POST['luong']." WHERE manv = '".$_POST['manv']."'"; // Ltweb
  $qry_update_nvien = mysql_query($sql_update_nvien);

  if ($qry_update_nvien) echo "<script>
  sessionStorage.setItem('page', 'qly-nhan-vien');
  alert('Chỉnh sửa thành công!');</script>";
  else echo "<script>alert('Chỉnh sửa thất bại!')</script>";

  echo '<meta http-equiv="refresh" content="0">';
}

// // Xóa nhân viên
if(isset($_POST['delete-nvien'])) {
  foreach ($_POST['manv'] as $key => $manv) {
    $sql_del_nvien = "DELETE FROM loc_thuc_nhanvien WHERE manv='{$manv}'"; // Ltweb
    $qry_del_nvien = mysql_query($sql_del_nvien);
  }

  if ($qry_del_nvien) echo "<script>
  sessionStorage.setItem('page', 'qly-nhan-vien');
  alert('Xóa thành công!');</script>";
  else echo "<script>alert('Xóa thất bại!')</script>";

  echo '<meta http-equiv="refresh" content="0">';
}

// Thuchanh_6: Hoàn chỉnh giao diện

?>
