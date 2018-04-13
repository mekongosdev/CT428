<fieldset id="them-hinhanh-nvien">
  <legend><h2>THÊM MỚI HÌNH ẢNH NHÂN VIÊN</h2></legend>
  <button class="btn" onclick="showPage('qly-nhan-vien',[],[]); return false;">Quay lại</button>
  <hr>
  <form method="post" enctype="multipart/form-data">
    <p>Nhân viên:
      <select name="manv">
        <?php
          $sql_select_nv = "SELECT * FROM loc_thuc_nhanvien";
          $result_select_nv = mysql_query($sql_select_nv);
          while ($row_nvien = mysql_fetch_array($result_select_nv)) {
            echo '<option value="'.$row_nvien['manv'].'">'.$row_nvien['hoten'].'</option>';
          }
        ?>
      </select>
    </p>
    <input type="file" name="img_nv" style="margin-bottom: 10px;" /><br>
    <button type="submit" class="btn-primary" name="upload_img_nv">Thêm mới</button>
  </form>
</fieldset>
