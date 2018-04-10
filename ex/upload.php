<?php
// Upload CT428 Directory
if(isset($_POST['upload'])) {
    if (isset($_FILES['file_up'])) {
      foreach($_FILES['file_up']['name'] as $name => $value)
        {
            $name_img = stripslashes($_FILES['file_up']['name'][$name]);
            $source_img = $_FILES['file_up']['tmp_name'][$name];

            $path_img =  $_POST['prefix_up'] . $name_img; // Đường dẫn thư mục chứa file
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
  </head>
  <body>
    <fieldset style="width: 98%">
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
                  $filelist = glob("*.php");
                  foreach ($filelist as $key => $filename) {
                    echo "<option value='{$filename}'>{$filename}</option>";
                  }
                ?>
              </select>
            </p>
            <button type="submit" name="delete">Delete</button>
        </form>
      </fieldset>
    </fieldset>
  </body>
</html>
