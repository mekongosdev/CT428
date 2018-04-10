<fieldset id="qly-don-vi" class="qly-don-vi">
  <legend><h2>PHÒNG BAN/ĐƠN VỊ</h2></legend>
  <center>
    <div>
      <form method="post">
        <label>Thêm đơn vị</label>
        <input type="text" name="madv" value="<?php
        // Tự động sinh mã đơn vị
        $return_madv_end = mysql_fetch_array(mysql_query("SELECT madv FROM loc_thuc_donvi ORDER BY madv DESC "));
        $madv_next = $return_madv_end[0] + 1;
        if (($madv_next >= 1000) && ($madv_next >= 100)) {
            echo $madv_next;
        } else if ($madv_next >= 10) {
            echo '0'.$madv_next;
        } else if ($madv_next >= 1) {
            echo '00'.$madv_next;
        }
        ?>" placeholder="Nhập mã đơn vị" required />
        <input type="text" name="dvi" placeholder="Nhập tên đơn vị" required />
        <button type="submit" class="btn-primary" name="add_dvi">Thêm</button>
      </form>
      <hr>
      <table>
        <thead>
          <tr>
            <th>MADV</th>
            <th>ĐƠN VỊ</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql_qry_list_nvien = "SELECT * FROM loc_thuc_donvi"; // Ltweb
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
  </center>
</fieldset>
