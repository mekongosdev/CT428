<fieldset id="qly-nhan-vien">
  <legend><h2>NHÂN VIÊN</h2></legend>
  <div>
    <!-- <legend>Quản lý nhân viên</legend> -->
    <form method="post">
      <p>
        <!-- Thuchanh_4 -->
        <button type="button" class="btn" onclick="showPage('them-nvien',[],[]); return false;">Thêm mới nhân viên</button>
        <button type="button" class="btn" onclick="showPage('them-hinhanh-nvien',[],[]); return false;">Thêm mới hình ảnh nhân viên</button>
        <!-- Thuchanh_5 -->
        <button type="submit" class="btn-danger" name="delete-nvien">Xóa nhân viên</button>
      </p>
      <hr>
      <div style="width: 100%">
        <table class="qly-nvien-tbl">
          <thead>
            <tr>
              <th><input type="checkbox" onClick="toggle(this,'manv[]')" /></th>
              <th>MANV</th>
              <th>HÌNH ẢNH</th>
              <th>HỌ TÊN</th>
              <th>NGÀY SINH</th>
              <th>GIỚI TÍNH</th>
              <th>ĐƠN VỊ</th>
              <th>CHỨC VỤ</th>
              <th>LƯƠNG<br />(nghìn đồng)</th>
              <th>CHỈNH SỬA</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql_qry_list_nvien = "SELECT * FROM loc_thuc_nhanvien a, loc_thuc_donvi b, loc_thuc_chucvu c WHERE a.madv = b.madv AND a.macv = c.macv"; // Ltweb
              $qry_list_nvien = mysql_query($sql_qry_list_nvien);
              while ($row_list_nvien = mysql_fetch_array($qry_list_nvien)) {
                echo "<tr>";
                echo '<td><input type="checkbox" name="manv[]" value="'.$row_list_nvien['manv'].'"</td>';
                echo "<td>{$row_list_nvien['manv']}</td>";
                echo '<td><img src="data:image/jpeg;base64,'.base64_encode( $row_list_nvien['hinhanh'] ).'" style="width: 100px; height: 150px" alt="Hình ảnh nhân viên"/></td>';
                echo "<td>{$row_list_nvien['hoten']}</td>";
                echo "<td>{$row_list_nvien['namsinh']}</td>";
                echo "<td>{$row_list_nvien['gioitinh']}</td>";
                echo "<td>{$row_list_nvien['donvi']}</td>";
                echo "<td>{$row_list_nvien['chucvu']}</td>";
                echo "<td>{$row_list_nvien['luong']}</td>";
                echo '<td>';
                  // Thuchanh_5
                  echo '<button type="button" class="btn" onclick="showPage('."'chinh-sua-nvien', ['manv','hoten','namsinh','gioitinh','chucvu','donvi','luong'], ['".$row_list_nvien['manv']."','".$row_list_nvien['hoten']."','".$row_list_nvien['namsinh']."','".$row_list_nvien['gioitinh']."','".$row_list_nvien['macv']."','".$row_list_nvien['madv']."','".$row_list_nvien['luong']."']".'); return false;">Thông tin</button>';
                  echo "<br />";
                  echo '<button type="button" class="btn" onclick="showPage('."'chinh-sua-hinhanh-nvien', ['manv_ha','hoten_ha'], ['".$row_list_nvien['manv']."','".$row_list_nvien['hoten']."']".'); return false;">Hình ảnh</button>';
                echo '</td>';
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </form>
  </div>
</fieldset>
