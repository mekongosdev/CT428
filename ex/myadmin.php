<?php
// Một số thông tin môn học CT428
// $db_host = "172.30.35.70"; // Ltweb
// $db_user = "user_c4"; // Ltweb
// $db_pass = "puser_c4"; // Ltweb
// $db_name = "db_c4"; // Ltweb
// Ampps
$db_host = "localhost"; // Ltweb
$db_user = "root"; // Ltweb
$db_pass = "mysql"; // Ltweb
$db_name = "ltweb"; // Ltweb

// Thiết lập sessions cho database
session_start();

// Kết nối CSDL
$conn = mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
mysql_set_charset('utf8');
mysql_select_db($db_name);

// Select table
if (isset($_POST['choose-table'])) {
  // Lưu Session database
  $_SESSION['table'] = $_POST['choose-table'];
} else $_SESSION['table'] = null;

// SQL box
if (isset($_POST['sql_qry'])) {
  $sql_qry = $_POST['sql_box'];

  if (mysql_query($sql_qry)) {
    echo '<script>alert("Success Message");</script>';
  }
  else {
    echo '<script>alert("Fail Message");</script>';
  }

  echo '<meta http-equiv="refresh" content="0">';
}

// Upload CT428
if(isset($_POST['upload-ct428'])) {
    if (isset($_FILES['file_up'])) {
      foreach($_FILES['file_up']['name'] as $name => $value)
        {
            $name_img = stripslashes($_FILES['file_up']['name'][$name]);
            $source_img = $_FILES['file_up']['tmp_name'][$name];

            $path_img = 'loc_thuc_' . $name_img; // Đường dẫn thư mục chứa file
            move_uploaded_file($source_img, $path_img); // Upload file
        }

        echo '<script>alert("Success Message");</script>';
        echo '<meta http-equiv="refresh" content="0">';
    }
}

// Upload CT428 Advanced
if(isset($_POST['upload-ct428-advanced'])) {
    if (isset($_FILES['file_up'])) {
      foreach($_FILES['file_up']['name'] as $name => $value)
        {
            if ($_POST['dir_up'] != null) {
              $dir = $_POST['dir_up'] . '/';
            } else $dir = null;
            $name_img = stripslashes($_FILES['file_up']['name'][$name]);
            $source_img = $_FILES['file_up']['tmp_name'][$name];

            $path_img =  $dir . $_POST['prefix_up'] . $name_img; // Đường dẫn thư mục chứa file
            move_uploaded_file($source_img, $path_img); // Upload file
        }

        echo '<script>alert("Success Message");</script>';
        echo '<meta http-equiv="refresh" content="0">';
    }
}

// Delete in CT428 Directory
if(isset($_POST['delete-file'])) {
  $filename = $_POST['filename'];

  $deleting = unlink($filename);

  if ($deleting) {
    echo '<script>alert("Success Message");</script>';
  } else echo '<script>alert("Fail Message");</script>';

  echo '<meta http-equiv="refresh" content="0">';
}

// Update MySQLAdmin
if(isset($_POST['update-myadmin'])) {
    if ($_FILES["file-update"]["error"] > 0) {
        echo "Error: " . $_FILES["file-update"]["error"] . "<br />";
    } else {
        $temp = explode(".", $_FILES["file-update"]["name"]);
        $newfilename = 'db_admin' . '.' . end($temp);
        move_uploaded_file($_FILES["file-update"]["tmp_name"], $newfilename);
    }
}
?>

<!DOCTYPE html>
<html lang="vi" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MySQLAdmin</title>
    <script type="text/javascript">
      function showStuff(id) {
        var tbl = ['database-box','browse-box','structure-box','sql-box','update-box'];
        // hide the table
        for (i=0; i<tbl.length; i++) {
          document.getElementById(tbl[i]).style.display = 'none';
        }
        document.getElementById(id).style.display = 'block';
      }

      function toggle(source,name) {
        checkboxes = document.getElementsByName(name);
        for(var i=0, n=checkboxes.length;i<n;i++) {
          checkboxes[i].checked = source.checked;
        }
      }

      function ct428_advanced() {
          var x = document.getElementById("ct428-default");
          var y = document.getElementById("ct428-advanced");
          if (true) {
              x.style.display = "none";
              y.style.display = "block";
          } else {
              x.style.display = "block";
              y.style.display = "none";
          }
      }

      function ct428_default() {
          var x = document.getElementById("ct428-default");
          var y = document.getElementById("ct428-advanced");
          if (true) {
              x.style.display = "block";
              y.style.display = "none";
          } else {
              x.style.display = "none";
              y.style.display = "block";
          }
      }

      function showSQLvalue(primary, value) {
          document.getElementById(primary).value = value;
      }
    </script>
    <style media="screen">
      #top {
        width: 100%;
        margin: -15px -7px 0 -7px;
        float: left
      }

      #banner {
        background-color: #00ff00;
        width: 20%;
        float: left
      }

      #main-bar {
        width: 80%;
        height: 100%;
        float: left;
        padding: 22px 0 22px 0
      }

      #status-bar {
        width: 100%;
        height: 50%;
        float: left;
        margin: -3px 0 5px 0
      }

      #menu-bar {
        background-color: rgb(182, 182, 182);
        width: 100%;
        height: 50%;
        float: left
      }

      #wrapper {
        width:100%
      }

      #list-databases {
        width: 20%;
        float: left
      }

      #content-box {
        width: 80%;
        float: left
      }

      .db-box {
        width: 100%;
        float: left
      }

      #action-database {
        margin-left: 5px;
        width: 26%;
        float: left
      }

      #browse-box {
        width:100%;
        float: left
      }

      #structure-box {
        width:100%;
        float: left
      }

      .box-content {
        width: 100%;
        float: left;
        display: none
      }

      @media only screen and (max-width: 1325px) {
          #action-database {
            margin-left: 5px;
            width: 100%;
            float: left
          }

          #show-list-db-current {
            width: 100%;
            float: left
          }
      }

      @media only screen and (max-width: 868px) {
          #banner {
            background-color: #00ff00;
            width: 100%;
            float: left
          }

          #main-bar {
            width: 100%;
            height: 100%;
            float: left;
            padding: 22px 0 22px 0
          }

          #content-box {
            width: 100%;
            float: left
          }
      }

      @media only screen and (max-width: 500px) {
          #top {
            width: 100%;
            height: 300px;
            margin: -15px -7px 0 -7px;
            float: left
          }

          #banner {
            background-color: #00ff00;
            width: 100%;
            height: 50%;
            float: left
          }

          #banner h3 {
            font-size: 3.7em;
          }

          #main-bar {
            width: 100%;
            height: 50%;
            float: left;
            font-size: 2.7em;
            padding: 22px 0 22px 0
          }
      }
    </style>
  </head>
  <body>
    <div id="top">
      <div id="banner">
        <center>
          <h3 style="color: white; margin-top: 15px; margin-bottom: 5px">NGTHUC <br /> MyAdmin</h3>
        </center>
      </div>
      <div id="main-bar">
        <div id="status-bar">
          <span>>>Server:
          <?php
            echo $db_host;
            echo ' >>Database: ' . $db_name;
            if ($_SESSION['table']) echo ' >>Table: ' . $_SESSION['table'];
          ?></span>
        </div>
        <div id="menu-bar">
          <form action="" method="post">
              <button type="button" style="margin-left: 5px" id="show-database-box" onclick="showStuff('database-box'); return false;">Databases</button>
              <button type="button" id="show-infomation" onclick="showStuff('browse-box'); return false;">Browse</button>
              <button type="button" id="show-structure" onclick="showStuff('structure-box'); return false;">Structure</button>
              <button type="button" id="show-sql-box" onclick="showStuff('sql-box'); return false;">SQL</button>
              <button type="button" id="show-import-box" onclick="showStuff('update-box'); return false;">Update</button>
              <button type="button" id="reload-box" style="float: right; margin-right: 5px" onClick="window.location.reload()">Reload</button>
          </form>
        </div>
      </div>
    </div>
    <div id="wrapper">
      <div id="list-databases">
        <h4>DATABASES</h4><hr>
        <fieldset>
          <legend>Administrator</legend>
          <form action="" method="post">
            <select name="choose-database" onchange="this.form.submit()">
            <?php
              $result_db = mysql_query('SHOW DATABASES;');

              if (!$result_db) {
                echo "DB Error, could not list tables\n";
                echo 'MySQL Error: ' . mysql_error();
                exit;
              }

              while($db = mysql_fetch_row($result_db)) {
                if ($db[0] == 'information_schema' || $db[0] == 'mysql' || $db[0] == 'performance_schema') {
                  // Do Not Something
                } else {
                  if ($db[0] == $_SESSION['database']) {
                    echo '<option value="'.$db[0].'" selected>'.$db[0].'</option>';
                  } else {
                    echo '<option value="'.$db[0].'">'.$db[0].'</option>';
                  }
                }
              }
            ?>
            </select>
          </form>
          <?php
            $sql_tbl = "SHOW TABLES FROM ".$_SESSION['database'];
            $result_tbl = mysql_query($sql_tbl);

            if (!$result_tbl) {
              echo "DB Error, could not list tables\n";
              echo 'MySQL Error: ' . mysql_error();
              exit;
            }

            echo '<hr />
            <form action="" method="post">';
            $_tbl = array();
            while ($row_tbl = mysql_fetch_row($result_tbl)) {
              $_tbl[] = $row_tbl[0];
              echo '<button type="submit" name="choose-table" value="'.$row_tbl[0].'">'.$row_tbl[0].'</button><hr />';
            }
            echo '</form>';
          ?>
        </fieldset>
      </div>
      <div id="content-box">
        <div id="database-box" class="db-box" style="display: none">
            <h4>Tools</h4><hr>
            <div id="content-db-box" class="db-box">
              <div id="action-database">
                <fieldset>
                  <legend>Server Infomation</legend>
                  <span>Server: <b style="color: blue"><?php echo $db_host; ?></b></span><br />
                </fieldset>
                <fieldset id="ct428-default">
                  <legend><i>Upload CT428</i></legend>
                  <form method="post" enctype="multipart/form-data" >
                      <input type="file" name="file_up[]" id="file-upload" multiple="true" />
                      <input type="submit" name="upload-ct428" value="Upload" />
                      <button type="button" onclick="ct428_advanced()">Advanced</button>
                  </form>
                </fieldset>
                <fieldset id="ct428-advanced" style="display: none">
                  <legend><i>Upload CT428 Advanced</i></legend>
                  <form method="post" enctype="multipart/form-data" >
                      <input type="file" name="file_up[]" multiple="true" />
                      <table>
                        <tr>
                          <td><label>Directory</label></td>
                          <td><input type="text" name="dir_up" placeholder="Enter directory..." /></td>
                        </tr>
                        <tr>
                          <td><label>Prefix</label></td>
                          <td><input type="text" name="prefix_up" placeholder="Example prefix: loc_thuc_..."/></td>
                        </tr>
                      </table>
                      <input type="submit" name="upload-ct428-advanced" value="Upload" />
                      <button type="button" onclick="ct428_default()">Default</button>
                  </form>
                </fieldset>
                <fieldset>
                  <legend>Delete file</legend>
                  <form method="post">
                    <label>Choose File Name:</label>
                    <select name="filename">
                      <?php
                        $filelist = glob("*.php");
                        foreach ($filelist as $key => $filename) {
                          echo "<option value='{$filename}'>{$filename}</option>";
                        }
                      ?>
                    </select>
                    <button type="submit" name="delete">Delete</button>
                  </form>
                </fieldset>
              </div>
            </div>
        </div>
        <div id="browse-box" style="display: none">
          <h4>Browsing rows</h4><hr>
          <fieldset>
            <legend>Rows</legend>
            <?php
              if ($_SESSION['table'] != null) {
                $txt_query = "DESCRIBE ".$_SESSION['table'];
                $query_tbl_info = mysql_query($txt_query);
                $tbl_nums_field = mysql_num_rows($query_tbl_info);

                echo '<form action="" method="post">
                <table border=1 style="width:99%; margin-left:2px; text-align:center">
                <thead>
                  <tr style="background-color: #00ff00">';
                  while($row_th = mysql_fetch_array($query_tbl_info)) {
                      echo "<th>{$row_th['Field']}</th>";
                  }
                echo '</tr>
                  </thead>
                <tbody>';

                $sql_query_from_tbl = "SELECT * FROM ".$_SESSION['table'];
                $query_tbl_data = mysql_query($sql_query_from_tbl);
                while($row_data = mysql_fetch_array($query_tbl_data)) {
                    echo "<tr>";
                    for ($i = 0; $i < $tbl_nums_field; $i++) {
                      echo "<td>{$row_data[$i]}</td>";
                    }
                    echo "</tr>";
                }
                echo '</tbody>
                </table>
                </form>';
              }
            ?>
          </fieldset>
        </div>
        <div id="structure-box" style="<?php if($_SESSION['table'] == null) {echo 'display: none';} ?>">
          <h4>Table Structure</h4><hr>
          <fieldset>
            <legend>Structure</legend>
            <?php
              if ($_SESSION['table'] != null) {
                $txt_query = "DESCRIBE ".$_SESSION['table'];
                $query_tbl_info = mysql_query($txt_query);
                $tbl_nums_field = mysql_num_rows($query_tbl_info);
                // $query_tbl_row = mysql_query($txt_query);

                echo '<form action="" method="POST">
                <table border=1 style="width:99%; margin-left:2px; text-align:center">
                <thead>
                  <tr style="background-color: #00ff00">
                    <th>Field</th>
                    <th>Type</th>
                    <th>Null</th>
                    <th>Key</th>
                    <th>Default</th>
                    <th>Extra</th>
                  </tr>
                </thead>
                <tbody>';
                while($row_info = mysql_fetch_array($query_tbl_info)) {
                    echo "<tr>
                      <td>{$row_info['Field']}</td>
                      <td>{$row_info['Type']}</td>
                      <td>{$row_info['Null']}</td>
                      <td>{$row_info['Key']}</td>
                      <td>{$row_info['Default']}</td>
                      <td>{$row_info['Extra']}</td>
                    </tr>";
                }
                echo '</tbody>
                </table>
                </form>';
              } else {
                $sql_struc_tbl = "SHOW TABLES FROM ".$_SESSION['database'];
                $result_struc_tbl = mysql_query($sql_struc_tbl);

                echo '<form action="" method="POST">
                <table border=1 style="width:99%; margin-left:2px; text-align:center">
                <thead>
                  <tr style="background-color: #00ff00">
                    <!--th><input type="checkbox" onClick="'."toggle(this,'tbl_action[]')".'" /></th-->
                    <th>Table</th>
                    <!--th>Action</th-->
                    <th>Rows</th>
                  </tr>
                </thead>
                <tbody>';
                while ($row_struc_tbl = mysql_fetch_row($result_struc_tbl)) {
                  $num_rows_struc_tbl = mysql_num_rows(mysql_query("SELECT * FROM {$row_struc_tbl[0]}"));
                  if (!$num_rows_struc_tbl) echo '<meta http-equiv="refresh" content="0">';

                  echo "<tr>
                        <!--td><input type='checkbox' name='tbl_action[]' /></td-->
                        <td>{$row_struc_tbl[0]}</td>
                        <!--td>
                          <a href='#'>Insert</a> |
                          <a href='#'>Empty</a> |
                          <a href='#'>Drop</a>
                        </td-->
                        <td>{$num_rows_struc_tbl}</td>
                      </tr>";
                }
                echo '</tbody>
                </table>
                <!--select name="action-tbl" style="margin: 5px 0 0 5px" onchange="this.form.submit()">
                  <option>With selected: </option>
                  <option value="empty">Empty </option>
                  <option value="drop">Drop </option>
                </select-->
                </form>';
              }
            ?>
          </fieldset>
        </div>
        <div id="sql-box" class="box-content">
            <h4>Run SQL query/queries <?php
              echo $db_name;
              if ($_SESSION['table']) echo '.' . $_SESSION['table'];
            ?></h4><hr>
            <fieldset>
              <legend>Run SQL query/queries</legend>
              <form action="" method="POST">
                <textarea id="sql_box" name="sql_box" rows="10" style="width: 99%; float: left" value="" placeholder="...coding"></textarea>
                <button type="button" id="select-all-sql" style="margin-left: 5px; float: left" onclick="showSQLvalue('sql_box','SELECT * FROM <?php if ($_SESSION['table'] == null) echo 'table_name'; else echo $_SESSION['table']; ?>'); return false;">SELECT *</button>
                <button type="button" id="select-sql" style="margin-left: 5px; float: left" onclick="showSQLvalue('sql_box','SELECT field_name FROM <?php if ($_SESSION['table'] == null) echo 'table_name'; else echo $_SESSION['table']; ?>'); return false;">SELECT</button>
                <button type="button" id="insert-sql" style="margin-left: 5px; float: left" onclick="showSQLvalue('sql_box','INSERT INTO <?php if ($_SESSION['table'] == null) echo 'table_name'; else echo $_SESSION['table']; ?>(field_name) VALUES ([value])'); return false;">INSERT</button>
                <button type="button" id="update-sql" style="margin-left: 5px; float: left" onclick="showSQLvalue('sql_box','UPDATE <?php if ($_SESSION['table'] == null) echo 'table_name'; else echo $_SESSION['table']; ?> SET field_name=[value] WHERE field_name=[value]'); return false;">UPDATE</button>
                <button type="button" id="delete-sql" style="margin-left: 5px; float: left" onclick="showSQLvalue('sql_box','DELETE FROM <?php if ($_SESSION['table'] == null) echo 'table_name'; else echo $_SESSION['table']; ?> WHERE field_name=[value]'); return false;">DELETE</button>
                <button type="button" id="clear-sql" style="margin-left: 5px; float: left" onclick="showSQLvalue('sql_box',''); return false;">Clear</button>
                <button type="submit" name="sql_qry" style="margin-left: 5px; float: right">Go</button>
              </form>
            </fieldset>
        </div>
        <div id="update-box" class="box-content">
            <h4>Update MySQLAdmin</h4><hr>
            <fieldset>
              <legend>Update</legend>
              <form method="post" enctype="multipart/form-data" >
                  <label for="file">Choosefile :</label>
                  <input type="file" name="file-update" id="file-update" />
                  <input type="submit" name="update-myadmin" value="Update" />
              </form>
            </fieldset>
        </div>
      </div>
    </div>
  </body>
</html>
