<fieldset id="qly-chuc-vu" class="qly-chuc-vu">
  <legend><h2>CHỨC VỤ</h2></legend>
  <center>
    <div>
      <form method="post">
        <label>Thêm chức vụ</label>
        <input type="text" name="macv" value="<?php
        // Tự động sinh mã chức vụ
        $return_macv_end = mysql_fetch_array(mysql_query("SELECT macv FROM loc_thuc_chucvu ORDER BY macv DESC "));
        $macv_next = $return_macv_end[0] + 1;
        if (($macv_next >= 1000) && ($macv_next >= 100)) {
            echo $macv_next;
        } else if ($macv_next >= 10) {
            echo '0'.$macv_next;
        } else if ($macv_next >= 1) {
            echo '00'.$macv_next;
        }
        ?>" placeholder="Nhập mã chức vụ" required />
        <input type="text" name="cvu" placeholder="Nhập tên chức vụ" required />
        <button type="submit" class="btn-primary" name="add_cvu">Thêm</button>
      </form>
      <hr>
      <table>
        <thead>
          <tr>
            <th>MACV</th>
            <th>CHỨC VỤ</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql_qry_list_nvien = "SELECT * FROM loc_thuc_chucvu"; // Ltweb
            $qry_list_nvien = mysql_query($sql_qry_list_nvien);
            while ($row_list_nvien = mysql_fetch_array($qry_list_nvien)) {
              echo '<tr>';
              echo "<td>{$row_list_nvien['macv']}</td>";
              echo "<td>{$row_list_nvien['chucvu']}</td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </center>
</fieldset>
