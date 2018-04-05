<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="vi" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Danh sách chức vụ</title>
  </head>
  <body>
    <div id="add-row" style="width: 100%; float: left">
      <center>
        <fieldset>
          <legend>Thêm chức vụ</legend>
          <form action="" method="post">
            <input type="text" name="macv" placeholder="Nhập mã chức vụ">
            <input type="text" name="cvu" placeholder="Nhập tên chức vụ">
            <button type="submit" name="add_cvu">Thêm</button>
          </form>
        </fieldset>
      </center>
    </div>
    <div id="list-cvu" style="width: 100%; float: left">
      <table border=1 style="text-align: center; width: 100%">
        <thead>
          <tr>
            <th>MACV</th>
            <th>CHUCVU</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql_qry_list_nvien = "SELECT * FROM loc_thuc_chucvu"; // Ltweb
            $qry_list_nvien = mysql_query($sql_qry_list_nvien);
            while ($row_list_nvien = mysql_fetch_array($qry_list_nvien)) {
              echo "<tr>";
              echo "<td>{$row_list_nvien['macv']}</td>";
              echo "<td>{$row_list_nvien['chucvu']}</td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>

<?php
if(isset($_POST['add_cvu'])) {
  $sql_insert_cvu = "INSERT INTO loc_thuc_chucvu VALUES ('{$_POST['macv']}', '{$_POST['cvu']}')"; // Ltweb
  $qry_insert_cvu = mysql_query($sql_insert_cvu);

  if ($qry_insert_cvu) echo "<script>alert('Thêm mới thành công!')</script>";
  else echo "<script>alert('Thêm mới thất bại!')</script>";

  echo '<meta http-equiv="refresh" content="0">';
}
?>
