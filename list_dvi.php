<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="vi" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Danh sách đơn vị</title>
  </head>
  <body>
    <div id="add-row" style="width: 100%; float: left">
      <center>
        <fieldset>
          <legend>Thêm đơn vị</legend>
          <form action="" method="post">
            <input type="text" name="madv" placeholder="Nhập mã chức vụ">
            <input type="text" name="dvi" placeholder="Nhập tên chức vụ">
            <button type="submit" name="add_dvi">Thêm</button>
          </form>
        </fieldset>
      </center>
    </div>
    <div id="list-dvi" style="width: 100%; float: left">
      <table border=1 style="text-align: center; width: 100%">
        <thead>
          <tr>
            <th>MADV</th>
            <th>DONVI</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql_qry_list_nvien = "SELECT * FROM donvi"; // Ampps
            // $sql_qry_list_nvien = "SELECT * FROM loc_thuc_donvi"; // Ltweb
            $qry_list_nvien = mysql_query($sql_qry_list_nvien);
            while ($row_list_nvien = mysql_fetch_array($qry_list_nvien)) {
              echo "<tr>";
              echo "<td>{$row_list_nvien['madv']}</td>";
              echo "<td>{$row_list_nvien['donvi']}</td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>

<?php
if(isset($_POST['add_dvi'])) {
  $sql_insert_cvu = "INSERT INTO donvi VALUES ('{$_POST['madv']}', '{$_POST['dvi']}')"; // Ampps
  // $sql_insert_cvu = "INSERT INTO loc_thuc_donvi VALUES ('{$_POST['madv']}', '{$_POST['dvi']}')"; // Ltweb
  $qry_insert_cvu = mysql_query($sql_insert_cvu);

  if ($qry_insert_cvu) echo "<script>alert('Thêm mới thành công!')</script>";
  else echo "<script>alert('Thêm mới thất bại!')</script>";

  echo '<meta http-equiv="refresh" content="0">';
}
?>
