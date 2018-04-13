<?php

// Các hàm xử lý file tùy biến
// // Lấy kích thước file
// function get_file_name_extension($filename) {
//   $fileSize = filesize($filename) / 1048576;
//   return $fileSize;
// }

// // Lấy phần mở rộng tên file
function get_file_name_extension($filename) {
  $splitFileName = explode(".", $filename);
  return end($splitFileName);
}

// Upload CT428 Directory
if(isset($_POST['upload'])) {
    if (isset($_FILES['file_up'])) {
      foreach($_FILES['file_up']['name'] as $name => $value)
        {
            $name_img = stripslashes($_FILES['file_up']['name'][$name]);
            $source_img = $_FILES['file_up']['tmp_name'][$name];
			if ($_POST['prefix_up'] != null) {
				$prefix = $_POST['prefix_up'];
			} else $prefix = null;

            $path_img =  $prefix . $name_img; // Đường dẫn thư mục chứa file
            $status = move_uploaded_file($source_img, $path_img); // Upload file
        }

        if ($status) {
          echo '<script>alert("Success Message");</script>';
        } else echo '<script>alert("Fail Message");</script>';
        echo '<meta http-equiv="refresh" content="0">';
    }
}

// Delete in CT428 Directory
if(isset($_POST['delete'])) {
  $filename = $_POST['filename'];

  $deleting = unlink($filename);

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
    <title>Upload CT428 Directory</title>
    <script type="text/javascript">
      // Hàm checkall cho checkbox
      function toggle(source,name) {
        checkboxes = document.getElementsByName(name);
        for(var i=0, n=checkboxes.length;i<n;i++) {
          checkboxes[i].checked = source.checked;
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

      .action-left {
          width: 25%;
          float: left;
      }

      .content-right {
          width: 75%;
          float: left;
          overflow-x:auto;
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
        <legend>Upload file</legend>
        <form method="get" enctype="multipart/form-data" >
          <input type="file" name="file_up[]" multiple="true" />
          <br>
          <input type="radio" onclick="document.getElementById('prefix-input').setAttribute('disabled')" checked/>
          <label>Non Prefix</label>
          <br>
          <input type="radio" onclick="document.getElementById('prefix-input').removeAttribute('disabled')"/>
          <label>Prefix</label>
          <input type="text" name="prefix_up" id="prefix-input" placeholder="Example prefix: loc_thuc_..." disabled/>
          <br>
          <input type="submit" name="upload" value="Upload" />
        </form>
      </fieldset>
    </div>
    <div class="content-right">
      <legend>List file</legend>
      <table>
        <tr>
          <th><input type="checkbox" onClick="toggle(this,'manv[]')" /></th>
          <th>TÊN FILE</th>
          <th>KÍCH THƯỚC</th>
          <th>THAO TÁC</th>
        </tr>
      </table>
    </div>
    <!-- <fieldset style="width: 98%">
      <legend><i>Upload Multiples File And Delete</i></legend>
      <fieldset style="width: 47%; float: left">
        <legend>Upload file</legend>
        <form method="post" enctype="multipart/form-data" >
            <input type="file" name="file_up[]" multiple="true" />
            <table>
              <tr>
                <td><label>Prefix</label></td>
                <td><input type="text" name="prefix_up" placeholder="Example prefix: loc_thuc_..."/></td>
              </tr>
            </table>
            <input type="submit" name="upload" value="Upload" />
        </form>
      </fieldset>
      <fieldset style="width: 47%; float: left">
        <legend>Delete file</legend>
        <form method="post">
            <p>
              <label>Choose File Name:</label>
              <select name="filename">
                <?php
                  // $filelist = glob("*.*");
                  // foreach ($filelist as $key => $filename) {
                  //   echo "<option value='{$filename}'>{$filename}</option>";
                  // }
                ?>
              </select>
            </p>
            <button type="submit" name="delete">Delete</button>
        </form>
      </fieldset>
    </fieldset> -->
  </body>
</html>
