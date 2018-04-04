<?php
// Thiết lập sessions cho database
session_start();
if (!$_SESSION['database']) $_SESSION['database'] = null; // Test
// if (!$_SESSION['database']) $_SESSION['database'] = 'ltweb'; // Ampps
// if (!$_SESSION['database']) $_SESSION['database'] = 'db_c4'; // Ltweb

// Kết nối CSDL
$db_host = "localhost"; // Ampps
$db_user = "root"; // Ampps
$db_pass = "mysql"; // Ampps
// $db_host = "172.30.35.70"; // Ltweb
// $db_user = "user_c4"; // Ltweb
// $db_pass = "puser_c4"; // Ltweb
$conn = mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
mysql_set_charset('utf8');
mysql_select_db($_SESSION['database']);

// Select database
if (isset($_POST['choose-database'])) {
  // Lưu Session database
  $_SESSION['database'] = $_POST['choose-database'];
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
?>

<!DOCTYPE html>
<html lang="vi" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MySQLAdmin</title>
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
    </script>
  </head>
  <body>
    <div id="top" style="width: 100%; margin: -15px -7px 0 -7px; float: left">
      <div id="banner" style="background-color: #00ff00; width: 20%; float: left">
        <center>
          <h3 style="color: white; margin-top: 15px; margin-bottom: 5px">NGTHUC <br /> PHPMySQLAdmin</h3>
        </center>
      </div>
      <div id="main-bar" style="width: 80%; height: 100%; float: left; padding: 22px 0 22px 0">
        <div id="empty-bar" style="width: 100%; height: 50%; float: left; margin: -3px 0 5px 0">
          <span>>>Server:
          <?php
            echo $db_host;
            if ($_SESSION['database']) echo ' >>Database: ' . $_SESSION['database'];
            if ($_SESSION['table']) echo ' >>Table: ' . $_SESSION['table'];
          ?></span>
        </div>
        <div id="menu-bar" style="background-color: rgb(182, 182, 182); width: 100%; height: 50%; float: left">
          <button type="button" style="margin-left: 5px" id="show-database-box" onclick="showStuff('database-box', ['browse-box','structure-box','sql-box','export-box','import-box']); return false;">Databases</button>
          <button type="button" id="show-infomation" onclick="showStuff('browse-box', ['database-box','structure-box','sql-box','export-box','import-box']); return false;">Browse</button>
          <button type="button" id="show-structure" onclick="showStuff('structure-box', ['browse-box','database-box','sql-box','export-box','import-box']); return false;">Structure</button>
          <button type="button" id="show-sql-box" onclick="showStuff('sql-box', ['browse-box','structure-box','database-box','export-box','import-box']); return false;">SQL</button>
          <button type="button" id="show-export-box"onclick="showStuff('export-box', ['browse-box','structure-box','sql-box','database-box','import-box']); return false;">Export</button>
          <button type="button" id="show-import-box"onclick="showStuff('import-box', ['browse-box','structure-box','sql-box','export-box','database-box']); return false;">Import</button>
        </div>
      </div>
    </div>
    <div id="wrapper" style="width:100%">
      <div id="list-databases" style="width:20%; float: left">
        <h4>DATABASES</h4><hr>
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
              echo '<option value="'.$db[0].'">'.$db[0].'</option>';
            }
          } else {
            $result_db = mysql_query('SHOW DATABASES;');

            if (!$result_db) {
              echo "DB Error, could not list tables\n";
              echo 'MySQL Error: ' . mysql_error();
              exit;
            }

            while($db = mysql_fetch_row($result_db)) {
              if ($db[0] == $_SESSION['database']) {
                echo '<option value="'.$db[0].'" selected>'.$db[0].'</option>';
              } else {
                echo '<option value="'.$db[0].'">'.$db[0].'</option>';
              }
            }
            echo '</select>';
          }
        ?>
          </select>
          <button type="button" id="show-add-db-box" onclick="showStuff('database-box', ['browse-box','structure-box','sql-box','export-box','import-box']); return false;">New</button>
        </form>
        <hr />
        <h4>TABLES</h4><hr>
        <?php
          if ($_SESSION['database'] != null) {
            $sql_tbl = "SHOW TABLES FROM ".$_SESSION['database'];
            $result_tbl = mysql_query($sql_tbl);

            if (!$result_tbl) {
              echo "DB Error, could not list tables\n";
              echo 'MySQL Error: ' . mysql_error();
              exit;
            }

            echo '<form action="" method="post">';
            $_tbl = array();
            while ($row_tbl = mysql_fetch_row($result_tbl)) {
              $_tbl[] = $row_tbl[0];
              echo '<button type="submit" name="choose-table" value="'.$row_tbl[0].'">'.$row_tbl[0].'</button><hr />';
            }
            echo '</form>';
          }
        ?>
      </div>
      <div id="database-box" style="width: 80%; float: left<?php if($_SESSION['table'] != null) echo '; display: none'; ?>">
          <h4>Databases</h4><hr>
          <div id="content-db-box" style="width: 100%; float: left">
            <div id="create-db-new" style="margin-left: 5px; width: 25%; float: left">
              <fieldset>
                <legend><i>Create Database</i></legend>
                <form action="" method="POST">
                  <input type="text" name="name_db" placeholder="Enter database name...">
                  <button type="submit" name="add_db">Create</button>
                </form>
              </fieldset>
            </div>
            <div id="show-list-db-current" style="width: 74%; float: left">
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
                        <th></th>
                        <th>Database</th>
                      </tr>
                      </thead>
                      <tbody>';
                      while($list_db = mysql_fetch_array($result_list_db)) {
                          echo '<tr>
                            <td><input type="checkbox" name="db_select[]" value="'.$list_db[0].'" /></td>
                            <td>'.$list_db[0].'</td>
                          </tr>';
                      }
                    echo '</tbody>
                    </table>';
                  ?>
                  <input type="checkbox" onClick="toggle(this,'db_select[]')" /> Check All <i>With selected:</i>
                  <button type="submit" name="drop-db" style="margin: 5px 0 0 5px">Drop</button>
                </form>
              </fieldset>
            </div>
          </div>
      </div>
      <div id="browse-box" style="width:80%; float: left<?php if($_SESSION['table'] == null) echo '; display: none'; ?>">
        <h4>Showing rows</h4><hr>

        <?php
          if ($_SESSION['table'] != null) {
            $txt_query = "DESCRIBE ".$_SESSION['table'];
            $query_tbl_info = mysql_query($txt_query);
            $tbl_nums_field = mysql_num_rows($query_tbl_info);
            $query_tbl_row = mysql_query($txt_query);

            echo '<form action="" method="post">
            <table border=1 style="width:99%; margin-left:2px; text-align:center">
            <thead>
              <tr style="background-color: #00ff00">
                <th></th>';
              while($row_th = mysql_fetch_array($query_tbl_row)) {
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
            <input type="checkbox" onClick="'."toggle(this,'row_action[]')".'" /> Check All <i>With selected:</i>
            <button type="submit" name="action-tbl-row" style="margin: 5px 0 0 5px">Drop</button>
            </form>';
          }
        ?>
      </div>
      <div id="structure-box" style="width:80%; float: left; display: none">
        <h4>Table Structure</h4><hr>
        <?php
          if ($_SESSION['table'] != null) {
            $txt_query = "DESCRIBE ".$_SESSION['table'];
            $query_tbl_info = mysql_query($txt_query);
            $tbl_nums_field = mysql_num_rows($query_tbl_info);
            $query_tbl_row = mysql_query($txt_query);

            echo '<form action="" method="POST">
            <table border=1 style="width:99%; margin-left:2px; text-align:center">
            <thead>
              <tr style="background-color: #00ff00">
                <th></th>
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
                  <td><input type='checkbox' name='field_action[]' /></td>
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
            <input type="checkbox" onClick="'."toggle(this,'field_action[]')".'" /> Check All <i>With selected:</i>
            <button type="submit" name="drop-field" style="margin: 5px 0 0 5px">Drop</button>
            </form>';
          } else {
            $sql_struc_tbl = "SHOW TABLES FROM ".$_SESSION['database'];
            $result_struc_tbl = mysql_query($sql_struc_tbl);

            if (!$result_struc_tbl) {
              echo "DB Error, could not list tables\n";
              echo 'MySQL Error: ' . mysql_error();
              exit;
            }

            echo '<form action="" method="POST">
            <table border=1 style="width:99%; margin-left:2px; text-align:center">
            <thead>
              <tr style="background-color: #00ff00">
                <th></th>
                <th>Table</th>
                <th>Action</th>
                <th>Rows</th>
              </tr>
            </thead>
            <tbody>';
            while ($row_struc_tbl = mysql_fetch_row($result_struc_tbl)) {
              $num_rows_struc_tbl = mysql_num_rows(mysql_query("SELECT * FROM {$row_struc_tbl[0]}"));
              echo "<tr>
                    <td><input type='checkbox' name='tbl_action[]' /></td>
                    <td>{$row_struc_tbl[0]}</td>
                    <td>
                      <a href='#'>Insert</a>
                      <a href='#'>Empty</a>
                      <a href='#'>Drop</a>
                    </td>
                    <td>{$num_rows_struc_tbl}</td>
                 </tr>";
            }
            echo '</tbody>
            </table>
            <input type="checkbox" onClick="'."toggle(this,'tbl_action[]')".'" /> Check All <i>With selected:</i>
            <button type="submit" name="drop-tbl" style="margin: 5px 0 0 5px">Drop</button>
            </form>';
          }
        ?>
      </div>
      <div id="sql-box" style="width: 80%; float: left; display: none">
          <h4>Run SQL query/queries <?php
            if ($_SESSION['database']) echo $_SESSION['database'];
            if ($_SESSION['table']) echo '.' . $_SESSION['table'];
          ?></h4><hr>
          <form action="" method="POST">
            <textarea id="sql_box" name="sql_box" rows="8" style="width: 99%" value="" placeholder="...coding"></textarea>
            <button type="button" id="select-all-sql" style="margin-left: 5px; float: left">SELECT *</button>
            <button type="button" id="select-sql" style="margin-left: 5px; float: left">SELECT</button>
            <button type="button" id="insert-sql" style="margin-left: 5px; float: left">INSERT</button>
            <button type="button" id="update-sql" style="margin-left: 5px; float: left">UPDATE</button>
            <button type="button" id="delete-sql" style="margin-left: 5px; float: left">DELETE</button>
            <button type="button" id="clear-sql" style="margin-left: 5px; float: left">Clear</button>
            <button type="submit" name="sql_qry" style="margin-left: 5px; float: right">Go</button>
          </form>
      </div>
      <div id="export-box" style="width: 80%; float: left; display: none">
          <h4>Exporting databases from the current server</h4><hr>
      </div>
      <div id="import-box" style="width: 80%; float: left; display: none">
          <h4>Importing into the current server</h4><hr>
      </div>
    </div>
  </body>
</html>
