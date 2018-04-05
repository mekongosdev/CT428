<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="vi" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Quản lý nhân sự</title>
    <script type="text/javascript">
      function showStuff(id, tbl) {
        document.getElementById(id).style.display = 'block';
        // hide the table
        for (i=0; i<tbl.length; i++) {
          document.getElementById(tbl[i]).style.display = 'none';
        }
      }

      function toggle(source,name) {
        checkboxes = document.getElementsByName(name);
        for(var i=0, n=checkboxes.length;i<n;i++) {
          checkboxes[i].checked = source.checked;
        }
      }

      function showHideElement(primary, second, value) {
          var x = document.getElementById(primary);
          if (x.style.display === "none") {
              x.style.display = "block";
              for (i=0; i<second.length; i++) {
                document.getElementById(second[i]).value = value[i];
              }
          } else {
              x.style.display = "none";
          }
      }
    </script>
    <style media="screen">
        body {
            width: 99%;
            height: 1000px;
            background-color: rgba(85, 164, 246, 0.19);
        }

        .banner {
            width: 100%;
            height: 50px;
            float: left;
            background-color: rgb(29, 223, 72);
        }

        .banner h2 {
            color: white;
            margin: 15px 0 0 20px;
        }

        .wrapper {
            width: 100%;
            height: 100%;
            float: left;
        }
        .menu-left {
            width: 20%;
            height: 100%;
            float: left;
            /* background-color: rgb(83, 96, 87); */
        }

        .menu-bar {
            width: 100%;
            /* background-color: rgb(115, 124, 109); */
        }

        .menu-bar ul{
          	list-style: none;
          	border-top: 1px solid #666;
            margin: 0px 0 0 0px;
            padding: 0px 0 0 0px;
        }

        .menu-bar ul li {
            border-bottom: 1px solid #666;
            font-weight: bold;
            background-color: rgb(14, 69, 235);
        }

        .menu-bar ul a, ul a:visited {
          	padding: 5px 5px 5px 15px;
          	display: block;
          	text-decoration: none;
        }

        .menu-bar ul a:hover, ul a:active, ul a:focus {
          	background-color: rgb(23, 13, 91);
          	color: #FFF;
        }

        .menu-bar a {
            text-decoration: none;
            color: white;
        }

        .content-right {
            width: 80%;
            height: 100%;
            /* background-color: rgb(202, 232, 229); */
            float: left;
        }

        .content-right button {
            margin-right: 5px;
        }

        #qly-don-vi, #qly-chuc-vu {
            display: none;
        }

        .khung-nhin {
            width: 100%;
            height: 100%;
            float: left;
        }

        #them-nvien, #chinh-sua-nvien, #them-hinhanh-nvien, #chinh-sua-hinhanh-nvien, #chinh-sua-don-vi, #chinh-sua-chuc-vu {
            width: 100%;
            display: none;
            float: left;
        }

        #them-nvien, #chinh-sua-nvien, #them-hinhanh-nvien, #chinh-sua-hinhanh-nvien, #chinh-sua-don-vi, #chinh-sua-chuc-vu table {
            width: 46%;
            float: left;
        }
    </style>
  </head>
  <body>
    <div class="banner">
        <h2>QUẢN LÝ NHÂN SỰ</h2>
    </div>
    <div class="wrapper">
      <div class="menu-left">
        <div class="menu-bar">
          <ul>
            <li><a onclick="showStuff('trang-chu', ['qly-don-vi','qly-chuc-vu','chinh-sua-nvien','chinh-sua-don-vi','chinh-sua-chuc-vu']); return false;">Trang chủ</a></li>
            <li><a onclick="showStuff('qly-don-vi', ['trang-chu','qly-chuc-vu','chinh-sua-nvien','chinh-sua-don-vi','chinh-sua-chuc-vu']); return false;">Quản lý đơn vị</a></li>
            <li><a onclick="showStuff('qly-chuc-vu', ['qly-don-vi','trang-chu','chinh-sua-nvien','chinh-sua-don-vi','chinh-sua-chuc-vu']); return false;">Quản lý chức vụ</a></li>
          </ul>
        </div>
      </div>
      <div class="content-right">
        <div class="khung-nhin">
          <fieldset id="trang-chu">
            <legend><h2>TRANG CHỦ</h2></legend>
            <fieldset>
              <legend>Quản lý nhân viên</legend>
              <form action="" method="post">
                <p>
                  <!-- Thuchanh_4 -->
                  <button type="button" onclick="showHideElement('them-nvien')" title="Lần đầu nhấn nút, vui lòng nhấp đôi để sử dụng. Cám ơn!">Thêm mới nhân viên</button>
                  <button type="button" onclick="showHideElement('them-hinhanh-nvien')" title="Lần đầu nhấn nút, vui lòng nhấp đôi để sử dụng. Cám ơn!">Thêm mới hình ảnh nhân viên</button>
                  <!-- Thuchanh_5 -->
                  <button type="submit" name="delete-nvien">Xóa nhân viên</button>
                </p>
                <!-- Thuchanh_4 -->
                <fieldset id="them-nvien">
                  <legend>THÊM MỚI NHÂN VIÊN</legend>
                  <form action="" method="post">
                    <table border="1">
                      <tr>
                        <td><strong>MANV</strong></td>
                        <td><input type="text" name="manv" placeholder="Nhập mã số nhân viên..." /></td>
                      </tr>
                      <tr>
                        <td><strong>HỌ TÊN</strong></td>
                        <td><input type="text" name="hoten" placeholder="Nhập họ tên nhân viên..." /></td>
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
                        <td><strong>LƯƠNG (nghìn đồng)</strong></td>
                        <td><input type="number" min="1000" name="luong" placeholder="Nhập lương nhân viên..." /></td>
                      </tr>
                    </table>
                    <input type="submit" name="sua-nvien" value="Lưu thay đổi">
                  </form>
                </fieldset>
                <!-- Thuchanh_5 -->
                <fieldset id="chinh-sua-nvien">
                  <legend>CHỈNH SỬA NHÂN VIÊN</legend>
                  <form action="" method="post">
                    <table border="1">
                      <tr>
                        <td><strong>MANV</strong></td>
                        <td><input type="text" name="manv" id="manv" value="" disabled /></td>
                      </tr>
                      <tr>
                        <td><strong>HỌ TÊN</strong></td>
                        <td><input type="text" name="hoten" id="hoten" placeholder="Nhập họ tên nhân viên..." /></td>
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
                        <td><strong>LƯƠNG (nghìn đồng)</strong></td>
                        <td><input type="number" min="1000" name="luong" id="luong" placeholder="Nhập lương nhân viên..." /></td>
                      </tr>
                    </table>
                    <input type="submit" name="sua-nvien" value="Lưu thay đổi">
                  </form>
                </fieldset>
                <fieldset id="them-hinhanh-nvien">
                  <legend>THÊM MỚI HÌNH ẢNH NHÂN VIÊN</legend>
                  <form action="" method="post" enctype="multipart/form-data">
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
                    <input type="file" name="img_nv" />
                    <input type="submit" name="update_img_nv" value="Thêm mới" />
                  </form>
                </fieldset>
                <fieldset id="chinh-sua-hinhanh-nvien">
                  <legend>CHỈNH SỬA HÌNH ẢNH NHÂN VIÊN</legend>
                  <form action="" method="post" enctype="multipart/form-data">
                    <p>
                      <input type="text" name="manv" id="manv_ha" value="" disabled/>
                      <input type="text" id="hoten_ha" value="" disabled/>
                    </p>
                    <input type="file" name="img_nv" />
                    <input type="submit" name="update_img_nv" value="Cập nhật" />
                  </form>
                </fieldset>
                <fieldset>
                  <table border=1 style="text-align: center; width: 100%">
                    <thead>
                      <tr>
                        <th></th>
                        <th>MANV</th>
                        <th>HÌNH ẢNH</th>
                        <th>HỌ TÊN</th>
                        <th>NGÀY SINH</th>
                        <th>GIỚI TÍNH</th>
                        <th>ĐƠN VỊ</th>
                        <th>CHỨC VỤ</th>
                        <th>LƯƠNG<br />(nghìn)</th>
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
                          echo "<td>{$row_list_nvien['hinhanh']}</td>";
                          echo "<td>{$row_list_nvien['hoten']}</td>";
                          echo "<td>{$row_list_nvien['namsinh']}</td>";
                          echo "<td>{$row_list_nvien['gioitinh']}</td>";
                          echo "<td>{$row_list_nvien['donvi']}</td>";
                          echo "<td>{$row_list_nvien['chucvu']}</td>";
                          echo "<td>{$row_list_nvien['luong']}</td>";
                          echo '<td>';
                            // Thuchanh_5
                            echo '<button type="button" onclick="showHideElement('."'chinh-sua-nvien',['manv','hoten','luong'],['".$row_list_nvien['manv']."','".$row_list_nvien['hoten']."','".$row_list_nvien['luong']."']".')" title="Lần đầu nhấn nút, vui lòng nhấp đôi để sử dụng. Cám ơn!">Thông tin</button>';
                            echo '<button type="button" onclick="showHideElement('."'chinh-sua-hinhanh-nvien',['manv_ha','hoten_ha'],['".$row_list_nvien['manv']."','".$row_list_nvien['hoten']."']".')" title="Lần đầu nhấn nút, vui lòng nhấp đôi để sử dụng. Cám ơn!">Hình ảnh</button>';
                          echo '</td>';
                          echo "</tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </fieldset>
              </form>
            </fieldset>
          </fieldset>
          <fieldset id="qly-don-vi">
            <legend><h2>PHÒNG BAN/ĐƠN VỊ</h2></legend>
            <fieldset>
              <legend>Quản lý đơn vị</legend>
              <center>
                <form action="" method="post">
                  <label>Thêm đơn vị</label>
                  <input type="text" name="madv" placeholder="Nhập mã đơn vị">
                  <input type="text" name="dvi" placeholder="Nhập tên đơn vị">
                  <button type="submit" name="add_dvi">Thêm</button>
                </form>
                <hr>
                <table border=1 style="text-align: center; width: 100%">
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
              </center>
            </fieldset>
          </fieldset>
          <fieldset id="qly-chuc-vu">
            <legend><h2>CHỨC VỤ</h2></legend>
            <fieldset>
              <legend>Quản lý chức vụ</legend>
              <center>
                <form action="" method="post">
                  <label>Thêm chức vụ</label>
                  <input type="text" name="macv" placeholder="Nhập mã chức vụ">
                  <input type="text" name="cvu" placeholder="Nhập tên chức vụ">
                  <button type="submit" name="add_cvu">Thêm</button>
                </form>
                <hr>
                <table border=1 style="text-align: center; width: 100%">
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
                        echo "<tr>";
                        echo "<td>{$row_list_nvien['macv']}</td>";
                        echo "<td>{$row_list_nvien['chucvu']}</td>";
                        echo "</tr>";
                      }
                    ?>
                  </tbody>
                </table>
              </center>
            </fieldset>
          </fieldset>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
// Thuchanh_3
// // Thêm đơn vị
if(isset($_POST['add_dvi'])) {
  $sql_insert_cvu = "INSERT INTO loc_thuc_donvi VALUES ('{$_POST['madv']}', '{$_POST['dvi']}')"; // Ltweb
  $qry_insert_cvu = mysql_query($sql_insert_cvu);

  if ($qry_insert_cvu) echo "<script>alert('Thêm mới thành công!')</script>";
  else echo "<script>alert('Thêm mới thất bại!')</script>";

  echo '<meta http-equiv="refresh" content="0">';
}

// // Thêm chức vụ
if(isset($_POST['add_cvu'])) {
  $sql_insert_cvu = "INSERT INTO loc_thuc_chucvu VALUES ('{$_POST['macv']}', '{$_POST['cvu']}')"; // Ltweb
  $qry_insert_cvu = mysql_query($sql_insert_cvu);

  if ($qry_insert_cvu) echo "<script>alert('Thêm mới thành công!')</script>";
  else echo "<script>alert('Thêm mới thất bại!')</script>";

  echo '<meta http-equiv="refresh" content="0">';
}
?>
