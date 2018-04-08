<?php
// Một số thông tin môn học CT428
// $db_host = "172.30.35.70"; // Ltweb
// $db_user = "user_c4"; // Ltweb
// $db_pass = "puser_c4"; // Ltweb
// $db_name = "db_c4"; // Ltweb

// Thiết lập sessions cho database
session_start();
if (!$_SESSION['database']) $_SESSION['database'] = null; // Official

// Connect server
if (isset($_POST['access-db'])) {
  // Lưu Session server
  setcookie("db_host",$_POST['db_host'],time() + 3600);
  setcookie("db_user",$_POST['db_user'],time() + 3600);
  setcookie("db_pass",$_POST['db_pass'],time() + 3600);
  echo '<meta http-equiv="refresh" content="0">';
}

// Quick connect server College of ICT
if (isset($_POST['access-db-cit'])) {
  // Lưu Session server
  setcookie("db_host","172.30.35.70",time() + 3600);
  setcookie("db_user","user_c4",time() + 3600);
  setcookie("db_pass","puser_c4",time() + 3600);
  $_SESSION['database'] = "db_c4";
  echo '<meta http-equiv="refresh" content="0">';
}

// Quick connect server Ampps
if (isset($_POST['access-db-ampps'])) {
  // Lưu Session server
  setcookie("db_host","localhost",time() + 3600);
  setcookie("db_user","root",time() + 3600);
  setcookie("db_pass","mysql",time() + 3600);
  echo '<meta http-equiv="refresh" content="0">';
}

// Kết nối CSDL
$db_host = $_COOKIE['db_host']; // Official
$db_user = $_COOKIE['db_user']; // Official
$db_pass = $_COOKIE['db_pass']; // Official
$conn = mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
mysql_set_charset('utf8');
mysql_select_db($_SESSION['database']);

// Select database
if (isset($_POST['choose-database'])) {
  // Lưu Session database
  if ($_POST['choose-database'] == 'information_schema' || $_POST['choose-database'] == 'mysql' || $_POST['choose-database'] == 'performance_schema') {
    $_SESSION['database'] = null;
  } else $_SESSION['database'] = $_POST['choose-database'];
} // else $_SESSION['database'] = null;

// Select table
if (isset($_POST['choose-table'])) {
  // Lưu Session database
  $_SESSION['table'] = $_POST['choose-table'];
} else $_SESSION['table'] = null;

// Create new database box
if (isset($_POST['add_db'])) {
  $sql_add_qry = "CREATE DATABASE " . $_POST['name_db'] . " CHARACTER SET utf8 COLLATE utf8_general_ci";

  if (mysql_query($sql_add_qry)) {
    echo '<script>alert("Success Message");</script>';
  }
  else {
    echo '<script>alert("Fail Message");</script>';
  }

  echo '<meta http-equiv="refresh" content="0">';
}

// Drop database box
if (isset($_POST['drop-db'])) {
  foreach ($_POST['db_select'] as $key => $db_name) {
    $sql_drop_db = "DROP DATABASE {$db_name}";
    mysql_query($sql_drop_db);
  }

  echo '<meta http-equiv="refresh" content="0">';
}

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

// Delete row in table
// if (isset($_POST['action-tbl-row'])) {
//     foreach ($_POST['row_action'] as $key => $row_del) {
//       $sql_drop_db = "DELETE FROM Student WHERE field_name={$row_del}";
//       mysql_query($sql_drop_db);
//     }
//
//     echo '<meta http-equiv="refresh" content="0">';
// }

// Update MySQLAdmin
if(isset($_POST['update-myadmin'])) {
    if ($_FILES["file-update"]["error"] > 0) {
        echo "Error: " . $_FILES["file-update"]["error"] . "<br />";
    } else {
        // echo "Upload: " . $_FILES["file-update"]["name"] . "<br />";
        // echo "Type: " . $_FILES["file-update"]["type"] . "<br />";
        // echo "Size: " . ($_FILES["file-update"]["size"] / 1024) . " Kb<br />";
        // echo "Stored in: " . $_FILES["file-update"]["tmp_name"] . "<br />";
        $temp = explode(".", $_FILES["file-update"]["name"]);
        $newfilename = 'db_admin' . '.' . end($temp);
        move_uploaded_file($_FILES["file-update"]["tmp_name"], $newfilename);
    }
}

// Exit database
if (isset($_POST['exit-db-btn'])) {
  session_destroy();

  echo '<meta http-equiv="refresh" content="0">';
}

// Exit server
if (isset($_POST['exit-server-btn'])) {
  session_destroy();
  setcookie("db_host");
  setcookie("db_user");
  setcookie("db_pass");

  echo '<meta http-equiv="refresh" content="0">';
}
?>

<!DOCTYPE html>
<html lang="vi" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MySQLAdmin</title>
    <script type="text/javascript">
      function showStuff(id) {
        var tbl = ['database-box','browse-box','structure-box','sql-box','export-box','import-box','update-box'];
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

      #show-list-db-current {
        width: 73%;
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

          #list-databases {
            width: 100%;
            float: left
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
          <h3 style="color: white; margin-top: 15px; margin-bottom: 5px">NGTHUC <br /> PHPMySQLAdmin</h3>
        </center>
      </div>
      <div id="main-bar">
        <div id="status-bar">
          <span>>>Server:
          <?php
            echo $db_host;
            if ($_SESSION['database']) echo ' >>Database: ' . $_SESSION['database'];
            if ($_SESSION['table']) echo ' >>Table: ' . $_SESSION['table'];
          ?></span>
        </div>
        <div id="menu-bar">
          <form action="" method="post">
              <button type="button" style="margin-left: 5px" id="show-database-box" onclick="showStuff('database-box'); return false;">Databases</button>
              <button type="button" id="show-infomation" onclick="showStuff('browse-box'); return false;">Browse</button>
              <button type="button" id="show-structure" onclick="showStuff('structure-box'); return false;">Structure</button>
              <button type="button" id="show-sql-box" onclick="showStuff('sql-box'); return false;">SQL</button>
              <button type="button" id="show-export-box" onclick="showStuff('export-box'); return false;">Export</button>
              <button type="button" id="show-import-box" onclick="showStuff('import-box'); return false;">Import</button>
              <button type="button" id="show-import-box" onclick="showStuff('update-box'); return false;">Update</button>
              <button type="submit" name="exit-server-btn" style="float: right; margin-right: 5px">Logout</button>
              <button type="submit" name="exit-db-btn" style="float: right; margin-right: 5px">Exit Database</button>
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
              if ($_SESSION['database'] == null) {
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
                    echo '<option value="'.$db[0].'">'.$db[0].'</option>';
                  }
                }
              } else {
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
              }
            ?>
            </select>
            <button type="button" id="show-add-db-box" onclick="showStuff('database-box'); return false;">New</button>
          </form>
          <?php
            if ($_SESSION['database'] != null) {
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
            }
          ?>
        </fieldset>
      </div>
      <div id="content-box">
        <div id="database-box" class="db-box" style="<?php if($_SESSION['database'] == null) {echo '';} else {echo '; display: none';} ?>">
            <h4>Databases</h4><hr>
            <div id="content-db-box" class="db-box">
              <div id="action-database">
                <fieldset>
                  <legend><i>Create Database</i></legend>
                  <form action="" method="POST">
                    <input type="text" name="name_db" placeholder="Enter database name...">
                    <button type="submit" name="add_db">Create</button>
                  </form>
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
                <?php
                if ($_COOKIE['db_host'] == null && $_COOKIE['db_user'] == null && $_COOKIE['db_pass'] == null) {
                  echo '<fieldset>
                    <legend>Access Databases</legend>
                    <form action="" method="post">
                      <table>
                        <tr>
                          <td><label>Host: </label></td>
                          <td><input type="text" name="db_host" placeholder="Enter Database Host..."></td>
                        </tr>
                        <tr>
                          <td><label>Username: </label></td>
                          <td><input type="text" name="db_user" placeholder="Enter Database Username..."></td>
                        </tr>
                        <tr>
                          <td><label>Password: </label></td>
                          <td><input type="text" name="db_pass" placeholder="Enter Database Password..."></td>
                        </tr>
                      </table>
                      <button type="submit" name="access-db">Access</button>
                      <button type="submit" name="access-db-ampps">Ampps</button>
                      <button type="submit" name="access-db-cit">172.30.35.70</button>
                    </form>
                  </fieldset>';
                } else {
                  echo '<fieldset>
                    <legend>Server Infomation</legend>
                    <span>Server: <b style="color: blue">' . $_COOKIE['db_host'] . '</b></span><br />
                    <form action="" method="POST">
                      <span>Action: </span>
                      <button type="submit" name="exit-server-btn" style="float: right; margin-right: 5px">Logout Server</button>
                      <button type="submit" name="exit-db-btn" style="float: right; margin-right: 5px">Exit Database</button>
                    </form>
                  </fieldset>';
                }
                ?>
              </div>
              <div id="show-list-db-current">
                <fieldset>
                  <legend><i>List databases</i></legend>
                  <form action="" method="POST">
                    <?php
                      $result_list_db = mysql_query('SHOW DATABASES;');

                      if (!$result_list_db) {
                        echo "DB Error, could not list tables\n";
                        echo 'MySQL Error: ' . mysql_error();
                        exit;
                      }

                      echo '<table border=1 style="width:99%; margin-left:2px; text-align:center">
                      <thead>
                        <tr style="background-color: #00ff00">
                          <th><input type="checkbox" onClick="'."toggle(this,'db_select[]')".'" /></th>
                          <th>Database</th>
                        </tr>
                        </thead>
                        <tbody>';
                        while($list_db = mysql_fetch_array($result_list_db)) {
                          if ($list_db[0] == 'information_schema' || $list_db[0] == 'mysql' || $list_db[0] == 'performance_schema') {
                            // Do Not Something
                          } else {
                            echo '<tr>
                              <td><input type="checkbox" name="db_select[]" value="'.$list_db[0].'" /></td>
                              <td>'.$list_db[0].'</td>
                            </tr>';
                          }
                        }
                      echo '</tbody>
                      </table>';
                    ?>
                    <i>With selected:</i>
                    <button type="submit" name="drop-db" style="margin: 5px 0 0 5px">Drop</button>
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
                  <tr style="background-color: #00ff00">
                    <th><input type="checkbox" onClick="'."toggle(this,'row_action[]')".'" /></th>';
                  while($row_th = mysql_fetch_array($query_tbl_info)) {
                      echo "<th>{$row_th['Field']}</th>";
                  }
                echo '</tr>
                  </thead>
                <tbody>';

                $sql_query_from_tbl = "SELECT * FROM ".$_SESSION['table'];
                $query_tbl_data = mysql_query($sql_query_from_tbl);
                while($row_data = mysql_fetch_array($query_tbl_data)) {
                    echo "<tr>
                    <td><input type='checkbox' name='row_action[]' /></td>";
                    for ($i = 0; $i < $tbl_nums_field; $i++) {
                      echo "<td>{$row_data[$i]}</td>";
                    }
                    echo "</tr>";
                }
                echo '</tbody>
                </table>
                <i>With selected:</i>
                <button type="submit" name="action-tbl-row" style="margin: 5px 0 0 5px">Delete</button>
                </form>';
              }
            ?>
          </fieldset>
        </div>
        <div id="structure-box" style="<?php if(($_SESSION['database'] != null) || ($_SESSION['database'] != null) && ($_SESSION['table'] != null)) {echo '';} else {echo 'display: none';} ?>">
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
                    <th><input type="checkbox" name="field_action[]" /></th>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Null</th>
                    <th>Key</th>
                    <th>Default</th>
                    <th>Extra</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';
                while($row_info = mysql_fetch_array($query_tbl_info)) {
                    echo "<tr>
                      <td><input type='checkbox' name='field_action[]' /></td>
                      <td>{$row_info['Field']}</td>
                      <td>{$row_info['Type']}</td>
                      <td>{$row_info['Null']}</td>
                      <td>{$row_info['Key']}</td>
                      <td>{$row_info['Default']}</td>
                      <td>{$row_info['Extra']}</td>
                      <td>
                          <a href='#'>Change</a> |
                          <a href='#'>Drop</a> |
                          <a href='#'>Set Primary</a> |
                          <a href='#'>Unset Primary</a>
                      </td>
                    </tr>";
                }
                echo '</tbody>
                </table>
                <i>With selected:</i>
                <button type="submit" name="action-field-drop" style="margin: 5px 0 0 5px">Drop</button>
                <button type="submit" name="action-field-primary" style="margin: 5px 0 0 5px">Primary</button>
                </form>';
              } else {
                $sql_struc_tbl = "SHOW TABLES FROM ".$_SESSION['database'];
                $result_struc_tbl = mysql_query($sql_struc_tbl);

                if (!$result_struc_tbl) {
                  echo "<i><strong>Please choose database for view</strong></i>";
                  // echo "DB Error, could not list tables\n";
                  // echo 'MySQL Error: ' . mysql_error();
                  // exit;
                } else {
                  echo '<form action="" method="POST">
                  <table border=1 style="width:99%; margin-left:2px; text-align:center">
                  <thead>
                    <tr style="background-color: #00ff00">
                      <th><input type="checkbox" onClick="'."toggle(this,'tbl_action[]')".'" /></th>
                      <th>Table</th>
                      <th>Action</th>
                      <th>Rows</th>
                    </tr>
                  </thead>
                  <tbody>';
                  while ($row_struc_tbl = mysql_fetch_row($result_struc_tbl)) {
                    $num_rows_struc_tbl = mysql_num_rows(mysql_query("SELECT * FROM {$row_struc_tbl[0]}"));
                    if (!$num_rows_struc_tbl) echo '<meta http-equiv="refresh" content="0">';

                    echo "<tr>
                          <td><input type='checkbox' name='tbl_action[]' /></td>
                          <td>{$row_struc_tbl[0]}</td>
                          <td>
                            <a href='#'>Insert</a> |
                            <a href='#'>Empty</a> |
                            <a href='#'>Drop</a>
                          </td>
                          <td>{$num_rows_struc_tbl}</td>
                        </tr>";
                  }
                  echo '</tbody>
                  </table>
                  <select name="action-tbl" style="margin: 5px 0 0 5px" onchange="this.form.submit()">
                    <option>With selected: </option>
                    <option value="export">Export </option>
                    <option value="empty">Empty </option>
                    <option value="drop">Drop </option>
                  </select>
                  </form>';
                }
              }
            ?>
          </fieldset>
        </div>
        <div id="sql-box" class="box-content">
            <h4>Run SQL query/queries <?php
              if ($_SESSION['database']) echo $_SESSION['database'];
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
        <div id="export-box" class="box-content">
            <h4>Exporting databases from the current server</h4><hr>
            <fieldset>
              <legend>Export</legend>
              <form method="post" enctype="multipart/form-data" >
                  <label for="file">Choosefile :</label>
                  <input type="file" name="export-file" id="export-file" />
                  <!-- <input type="submit" name="export-btn" value="Export" /> -->
              </form>
            </fieldset>
        </div>
        <div id="import-box" class="box-content">
            <h4>Importing into the current server</h4><hr>
            <fieldset>
              <legend>Import</legend>
              <form method="post" enctype="multipart/form-data" >
                  <label for="file">Choosefile :</label>
                  <input type="file" name="import-file" id="import-file" />
                  <!-- <input type="submit" name="import-btn" value="Import" /> -->
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
