<!-- Thuchanh_4 -->
<fieldset id="them-nvien" class="tbl-nvien-not-qly">
  <legend><h2>THÊM MỚI NHÂN VIÊN</h2></legend>
  <button class="btn" onclick="showPage('qly-nhan-vien',[],[]); return false;">Quay lại</button>
  <hr>
  <form method="post">
    <table>
      <tr>
        <td><strong>MANV</strong></td>
        <td><input type="text" name="manv" value="<?php
        // Tự động sinh mã nhân viên
        $return_manv_end = mysql_fetch_array(mysql_query("SELECT manv FROM loc_thuc_nhanvien ORDER BY manv DESC "));
        $manv_next = $return_manv_end[0] + 1;
        if (($manv_next >= 100000) && ($manv_next >= 10000)) {
            echo $manv_next;
        } else if ($manv_next >= 1000) {
            echo '0'.$manv_next;
        } else if ($manv_next >= 100) {
            echo '00'.$manv_next;
        } else if ($manv_next >= 10) {
            echo '000'.$manv_next;
        } else if ($manv_next >= 1) {
            echo '0000'.$manv_next;
        }
        ?>" placeholder="Nhập mã số nhân viên..." required /></td>
      </tr>
      <tr>
        <td><strong>HỌ TÊN</strong></td>
        <td><input type="text" name="hoten" placeholder="Nhập họ tên nhân viên..." required /></td>
      </tr>
      <tr>
        <td><strong>NGÀY SINH</strong></td>
        <td><input type="date" name="namsinh" value="<?php echo date('Y-m-d', time());?>" placeholder="Nhập họ tên nhân viên..." /></td>
      </tr>
      <tr>
        <td><strong>GIỚI TÍNH</strong></td>
        <td>
          Nam <input type="radio" name="gioitinh" value="Nam" checked/>
          Nữ <input type="radio" name="gioitinh" value="Nu" />
        </td>
      </tr>
      <tr>
        <td><strong>CHỨC VỤ</strong></td>
        <td>
          <select name="chucvu">
            <?php
            $sql_select_cv = "SELECT * FROM loc_thuc_chucvu";
            $result_select_cv = mysql_query($sql_select_cv);
            while ($row_cvu = mysql_fetch_array($result_select_cv)) {
              echo '<option value="'.$row_cvu['macv'].'">'.$row_cvu['chucvu'].'</option>';
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td><strong>ĐƠN VỊ</strong></td>
        <td>
          <select name="donvi">
            <?php
            $sql_select_cv = "SELECT * FROM loc_thuc_donvi";
            $result_select_cv = mysql_query($sql_select_cv);
            while ($row_cvu = mysql_fetch_array($result_select_cv)) {
              echo '<option value="'.$row_cvu['madv'].'">'.$row_cvu['donvi'].'</option>';
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td><strong>LƯƠNG</strong></td>
        <td><input type="number" min="1000" name="luong" placeholder="Nhập lương nhân viên..." required /> (nghìn đồng)</td>
      </tr>
    </table>
    <hr>
    <button type="submit" class="btn-primary" name="them-nvien">Lưu thay đổi</button>
  </form>
</fieldset>
