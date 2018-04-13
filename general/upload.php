<?php
// Các hàm xử lý file tùy biến
// // Lấy kích thước file
function get_file_size($filename) {
  $fileSize = round(filesize($filename) / 1024);
  return $fileSize;
}

// // Lấy phần mở rộng tên file
function get_file_name($filename) {
  $splitFileName = array_reverse(explode(".", $filename));
  return end($splitFileName);
}

// // Lấy phần mở rộng tên file
function get_file_name_extension($filename) {
  $splitFileName = explode(".", $filename);
  return strtolower(end($splitFileName));
}

// // Upload file CT428 Directory
if(isset($_POST['upload'])) {
    if (isset($_FILES['file_up'])) {
      foreach($_FILES['file_up']['name'] as $name => $value)
        {
            $name_img = stripslashes($_FILES['file_up']['name'][$name]);
            $source_img = $_FILES['file_up']['tmp_name'][$name];

      			if ($_POST['prefix_up']) {
              $path_img =  $_POST['prefix_up'] . $name_img; // Đường dẫn thư mục chứa file
      			} else $path_img =  $name_img; // Đường dẫn thư mục chứa file

            $status = move_uploaded_file($source_img, $path_img); // Upload file
        }

        if ($status) {
          echo '<script>alert("Success Message");</script>';
        } else echo '<script>alert("Fail Message");</script>';
        echo '<meta http-equiv="refresh" content="0">';
    }
}

// // Rename file in CT428 Directory
if(isset($_POST['change-file'])) {
    foreach ($_POST['oldname'] as $key => $oldname) {
      foreach ($_POST['newname'] as $key => $newname) {
        foreach ($_POST['filetype'] as $key => $filetype) {
          $fileNewName = $newname . '.' . $filetype;
          $status = rename($oldname,$fileNewName);
        }
      }
    }
    if ($status) {
      echo '<script>alert("Success Message");</script>';
    } else echo '<script>alert("Fail Message");</script>';
    echo '<meta http-equiv="refresh" content="0">';
}

// // Delete file in CT428 Directory
if(isset($_POST['delete-file'])) {
  if ($_POST['delete-file'] == 'delete-file') {
    foreach ($_POST['file'] as $key => $filename) {
      $deleting = unlink($filename);
    }
  } else $deleting = unlink($_POST['delete-file']);

  if ($deleting) {
    echo '<script>alert("Success Message");</script>';
  } else echo '<script>alert("Fail Message");</script>';

  echo '<meta http-equiv="refresh" content="0">';
}
?>

<!DOCTYPE html>
<html lang="vi" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>File Manager</title>
    <script type="text/javascript">
      // Hàm checkall cho checkbox
      function toggle(source,name) {
        checkboxes = document.getElementsByName(name);
        for(var i=0, n=checkboxes.length;i<n;i++) {
          checkboxes[i].checked = source.checked;
        }
      }

      // Hàm true/false disabled
      function is_Disabled(parent_id, class_name) {
          var parent = document.getElementById(parent_id);
          var same_class = parent.getElementsByClassName(class_name);
          for (i=0; i<= same_class.length; i++) {
            if (same_class[i].disabled === true) {
                same_class[i].disabled = false;
            } else {
                same_class[i].disabled = true;
            }
          }
      }
    </script>
    <style media="screen">
      body {
          background-color: rgba(85, 164, 246, 0.19);
      }

      header {
          height: 50px;
          float: left;
          position: fixed;
          left: 0;
          top: 0;
          width: 100%;
          color: white;
          text-align: center;
          background-color: rgb(29, 223, 72);
      }

      header h2 {
          color: white;
          margin: 15px 0 0 20px;
          float: center;
          font-size: 1.8em;
      }

      footer {
          height: 50px;
          float: left;
          position: fixed;
          left: 0;
          bottom: 0;
          width: 100%;
          color: white;
          text-align: center;
          background-color: rgb(29, 223, 72);
      }

      footer h3 {
          color: white;
          float: center;
      }

      table {
          float: left;
          width: 100%;
          text-align: center;
      }

      tr:hover {
          background-color: #f5f5f5;
      }

      tr:nth-child(even) {
          background-color: #f2f2f2;
      }

      th {
          padding: 5px;
          background-color: #4CAF50;
          color: white;
          border-bottom: 1px solid #ddd;
          vertical-align: center;
      }

      td {
          padding: 5px;
          text-align: left;
          border-bottom: 1px solid #ddd;
          vertical-align: center;
      }

      fieldset {
          width: 100%;
          border: 0px;
          float: left;;
      }

      a {
          text-decoration: none;
      }

      /* lớp btn cho button */
      .btn {
          background-color: white;
          color: blue;
          font-weight: bold;
          padding: 5px 10px 5px 10px;
          border: 1px solid blue;
          border-radius: 10px;
      }

      /* lớp btn-primary cho thẻ button */
      .btn-primary {
          background-color: blue !important;
          color: white !important;
          border: 1px solid white !important;
      }

      .btn-success {
          background-color: green !important;
          color: white !important;
          border: 1px solid white !important;
      }

      /* lớp btn-danger cho thẻ button */
      .btn-danger {
          background-color: red !important;
          color: white !important;
          border: 1px solid white !important;
      }

      /* sự kiện hover cho các lớp btn */
      .btn:hover {
          background-color: blue;
          color: white;
          font-weight: bold;
          padding: 5px 10px 5px 10px;
          border: 1px solid white;
          border-radius: 10px;
      }

      .btn-primary:hover {
          background-color: white !important;
          color: blue !important;
          border: 1px solid blue !important;
      }

      .btn-success:hover {
          background-color: white !important;
          color: green !important;
          border: 1px solid green !important;
      }

      .btn-danger:hover {
          background-color: white !important;
          color: red !important;
          border: 1px solid red !important;
      }

      .action-left {
          width: 25%;
          float: left;
      }

      .content-right {
          width: 75%;
          float: left;
          overflow-x:auto;
      }

      .content-right input {
          border: none;
      }

      .content-right input:disabled {
          background-color: inherit;
      }

      .align-center {
          text-align: center;
      }

      @media only screen and (max-width: 920px) {
          .action-left {
              width: 100%;
              float: left;
          }

          .content-right {
              width: 100%;
              float: left;
          }
      }
    </style>
  </head>
  <body>
    <div class="action-left">
      <fieldset id="upload-file">
        <legend><h2>Upload file</h2></legend>
        <form method="post" enctype="multipart/form-data" >
          <p><input type="file" name="file_up[]" multiple="true" /></p>
          <p>
            <label>Prefix</label>
            <input type="text" name="prefix_up" class="prefix-input" placeholder="Example prefix: loc_thuc_..." disabled />
            <button type="button" name="button" onclick="is_Disabled('upload-file','prefix-input'); return false;">...</button>
          </p>
          <p><input type="submit" name="upload" value="Upload" /></p>
        </form>
      </fieldset>
    </div>
    <div class="content-right">
      <form method="post" id="list-file">
        <legend><h2>List file</h2></legend>
        <p>
          <b class="btn btn-success">Còn lại: <?php echo round(diskfreespace('/') / 1048576) . ' MB'; ?></b>
          <b><button class="btn btn-primary" type="submit" name="change-file" value="change-file">Lưu file</button></b>
          <b><button class="btn btn-danger" type="submit" name="delete-file" value="delete-file">Xóa file</button></b>
        </p>
        <table>
          <thead>
            <tr>
              <th><input type="checkbox" onClick="toggle(this,'file[]')" /></th>
              <th>TÊN FILE</th>
              <th>KIỂU</th>
              <th>KÍCH THƯỚC</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $filelist = glob("*.*");
              foreach ($filelist as $key => $filename) {
                echo "<tr>
                  <td class='align-center'><input type='checkbox' name='file[]' value='{$filename}' /></td>
                  <td ondblclick='".'is_Disabled("list-file","' . strtolower(get_file_name($filename)) . '")'."; return false;'>
                    <input class='" . strtolower(get_file_name($filename)) . "' type='hidden' name='oldname[]' value='{$filename}' disabled/>
                    <input class='" . strtolower(get_file_name($filename)) . "' type='text' name='newname[]' value='" . get_file_name($filename) . "' placeholder='Nhập tên file...' disabled/>
                    <input class='" . strtolower(get_file_name($filename)) . "' type='hidden' name='filetype[]' value='" . get_file_name_extension($filename) . "' disabled/>
                  </td>
                  <td class='align-center'>" . strtoupper(get_file_name_extension($filename)) . " File </td>
                  <td class='align-center'>" . get_file_size($filename) . " KB </td>
                  <td class='align-center'>
                    <a href='{$filename}' target='_blank' class='btn btn-success'>View</a>
                    <!--button class='btn btn-success'>Rename</button-->
                    <button class='btn btn-danger' type='submit' name='delete-file' value='{$filename}'>Delete</button>
                  </td>
                </tr>";
              }
            ?>
          </tbody>
        </table>
      </form>
    </div>
  </body>
</html>
