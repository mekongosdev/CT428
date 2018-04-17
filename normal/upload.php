<?php
// Các hàm xử lý file tùy biến
// // Lấy kích thước file
function get_file_size($filename) {
  $fileSize = round(filesize($filename) / 1024);
  return $fileSize;
}

// // Lấy phần tên file
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
  $fileNewName = $_POST['newname'] . '.' . $_POST['filetype'];
  $status = rename($_POST['oldname'],$fileNewName);

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
      function is_Disabled(id){
        var inputId = document.getElementById(id);
        if(inputId.disabled === true) {
          inputId.disabled = false;
        } else inputId.disabled = true;
			}

      // Hàm truyền giá trị vào các text field
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

      function showField(id, prop, value) {
        var fieldsetId = ['rename-file'];
        for (i=0; i<fieldsetId.length; i++) {
          document.getElementById(fieldsetId[i]).style.display = 'none';
        }
        // show the table by id
        document.getElementById(id).style.display = 'block';
        // parameter transmission for property
        for (i=0; i<prop.length; i++) {
          document.getElementById(prop[i]).value = value[i];
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
          background-color: lime !important;
          color: black !important;
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
          color: lime !important;
          border: 1px solid lime !important;
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
      <fieldset>
        <legend><h2>Upload file</h2></legend>
        <form method="post" enctype="multipart/form-data" >
          <p><input type="file" name="file_up[]" multiple="true" /></p>
          <p>
            <label>Prefix</label>
            <input type="text" name="prefix_up" id="prefix-input" placeholder="Example prefix: loc_thuc_..." disabled />
            <button type="button" name="button" onclick="is_Disabled('prefix-input'); return false;">...</button>
          </p>
          <p><input class="btn btn-primary" type="submit" name="upload" value="Upload" /></p>
        </form>
      </fieldset>
      <fieldset id="rename-file" style="display: none;">
        <legend><h2>Rename file</h2></legend>
        <form method="post">
          <label>Tên mới</label>
          <input type="hidden" name="oldname" id="oldname" value="" />
          <input type="text" name="newname" id="newname" placeholder="Nhập tên file..." />
          <input type="hidden" name="filetype" id="filetype" value="" />
          <p><input class="btn btn-primary" type="submit" name="change-file" value="Lưu file" /></p>
        </form>
      </fieldset>
    </div>
    <div class="content-right">
      <form method="post" id="list-file">
        <legend><h2>List file</h2></legend>
        <p>
          <b class="btn btn-success">Còn lại: <?php echo round(diskfreespace('/') / 1048576) . ' MB'; ?></b>
          <b><button class="btn btn-danger" type="submit" name="delete-file" value="delete-file">Xóa file</button></b>
          <b><button class="btn" type="button" onclick="location.reload();">Tải lại</button></b>
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
              foreach ($filelist as $key => $filename) { ?>
                <tr>
                  <td class="align-center"><input type="checkbox" name="file[]" value="<?php echo $filename; ?>" /></td>
                  <td><?php echo $filename; ?></td>
                  <td class="align-center"><?php echo strtoupper(get_file_name_extension($filename)); ?> File </td>
                  <td class="align-center"><?php echo get_file_size($filename); ?> KB </td>
                  <td class="align-center">
                    <a href="<?php echo $filename; ?>" target="_blank" class="btn btn-success">View</a>
                    <button class="btn btn-primary" onclick="showField('rename-file',['oldname','newname','filetype'],['<?php echo $filename; ?>','<?php echo get_file_name($filename); ?>','<?php echo get_file_name_extension($filename); ?>']); return false;">Rename</button>
                    <button class="btn btn-danger" type="submit" name="delete-file" value="<?php echo $filename; ?>">Delete</button>
                  </td>
                </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
    </div>
  </body>
</html>
