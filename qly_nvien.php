<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="vi" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Quản lý nhân viên</title>
  </head>
  <body>
    <center><h2>Quản lý nhân viên</h2></center>
    <table border=1 style="text-align: center; width: 100%">
      <thead>
        <tr>
          <th>MANV</th>
          <th>HOTEN</th>
          <th>NGAYSINH</th>
          <th>GIOITINH</th>
          <th>DONVI</th>
          <th>CHUCVU</th>
          <th>LUONG</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $sql_qry_list_nvien = "SELECT * FROM loc_thuc_nhanvien a, loc_thuc_donvi b, loc_thuc_chucvu c WHERE a.madv = b.madv AND a.macv = c.macv"; // Ltweb
          $qry_list_nvien = mysql_query($sql_qry_list_nvien);
          while ($row_list_nvien = mysql_fetch_array($qry_list_nvien)) {
            echo "<tr>";
            echo "<td>{$row_list_nvien['manv']}</td>";
            echo "<td>{$row_list_nvien['hoten']}</td>";
            echo "<td>{$row_list_nvien['namsinh']}</td>";
            echo "<td>{$row_list_nvien['gioitinh']}</td>";
            echo "<td>{$row_list_nvien['donvi']}</td>";
            echo "<td>{$row_list_nvien['chucvu']}</td>";
            echo "<td>{$row_list_nvien['luong']}</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
    <hr>
    <?php
    echo '<div id="show-dvi" style="width: 50%; float: left">';
    include 'list_dvi.php';
    echo '</div>';

    echo '<div id="show-cvu" style="width: 50%; float: left">';
    include 'list_cvu.php';
    echo '</div>';
    ?>
  </body>
</html>
