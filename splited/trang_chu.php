<fieldset id="trang-chu">
  <legend><h2>TRANG CHỦ</h2></legend>
  <center>
    <div class="list-nvien">
    <?php
      $sql_qry_list_nvien = "SELECT * FROM loc_thuc_nhanvien a, loc_thuc_donvi b, loc_thuc_chucvu c WHERE a.madv = b.madv AND a.macv = c.macv"; // Ltweb
      $qry_list_nvien = mysql_query($sql_qry_list_nvien);
      while ($row_list_nvien = mysql_fetch_array($qry_list_nvien)) {
        echo '<div class="list-nvien-detail">';
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $row_list_nvien['hinhanh'] ).'" alt="Hình ảnh nhân viên"/>';
        echo "<br />";
        echo "<b>{$row_list_nvien['hoten']}</b>";
        echo "<br />";
        $sql_qry_chucvu_of_nvien = "SELECT chucvu FROM loc_thuc_chucvu WHERE macv = '{$row_list_nvien['macv']}'";
        $qry_chucvu_of_nvien = mysql_query($sql_qry_chucvu_of_nvien);
        $chucvu = mysql_fetch_array($qry_chucvu_of_nvien);
        echo $chucvu[0];
        echo "<br />";
        echo "<span>{$row_list_nvien['manv']}</span>";
        echo "<br />";
        echo "</div>";
      }
    ?>
    </div>
  </center>
</fieldset>
