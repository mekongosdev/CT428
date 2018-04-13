<!-- Thuchanh_5 -->
<fieldset id="chinh-sua-nvien" class="tbl-nvien-not-qly">
  <legend><h2>CHỈNH SỬA NHÂN VIÊN</h2></legend>
  <button class="btn" onclick="showPage('qly-nhan-vien',[],[]); return false;">Quay lại</button>
  <hr>
  <form method="post">
    <table>
      <tr>
        <td><strong>MANV</strong></td>
        <td><input type="text" name="manv" id="manv" value="" readonly /></td>
      </tr>
      <tr>
        <td><strong>HỌ TÊN</strong></td>
        <td><input type="text" name="hoten" id="hoten" placeholder="Nhập họ tên nhân viên..." required /></td>
      </tr>
      <tr>
        <td><strong>NGÀY SINH</strong></td>
        <td><input type="date" name="namsinh" id="namsinh" value="<?php echo date('Y-m-d', time());?>" placeholder="Nhập họ tên nhân viên..." /></td>
      </tr>
      <tr>
        <td><strong>GIỚI TÍNH</strong></td>
        <td>
          Nam <input type="radio" name="gioitinh" id="nam" value="Nam" checked/>
          Nữ <input type="radio" name="gioitinh" id="nu" value="Nu" />
        </td>
      </tr>
      <tr>
        <td><strong>CHỨC VỤ</strong></td>
        <td>
          <select name="chucvu" id="chucvu">
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
          <select name="donvi" id="donvi">
            <?php
            $sql_select_dv = "SELECT * FROM loc_thuc_donvi";
            $result_select_dv = mysql_query($sql_select_dv);
            while ($row_dvi = mysql_fetch_array($result_select_dv)) {
              echo '<option value="'.$row_dvi['madv'].'">'.$row_dvi['donvi'].'</option>';
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td><strong>LƯƠNG</strong></td>
        <td><input type="number" min="1000" name="luong" id="luong" placeholder="Nhập lương nhân viên..." required /> (nghìn đồng)</td>
      </tr>
    </table>
    <hr>
    <button type="submit" class="btn-primary" name="sua-nvien">Lưu thay đổi</button>
  </form>
</fieldset>
