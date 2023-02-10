<?php
include('database.php');

$db = $conn;
$tableName = "ddo";
$columns = ['CaseID','Department','Subject','CreatedBy','CreationDate','Remarks','Documents','Status','CurrentDepartment','DestinationDepartment'];
$fetchDataRejected = fetch_data_rejected($db, $tableName, $columns);
function fetch_data_rejected($db, $tableName, $columns)
{
  if (empty($db)) {
    $msg = "Database connection error";
  } elseif (empty($columns) || !is_array($columns)) {
    $msg = "columns Name must be defined in an indexed array";
  } elseif (empty($tableName)) {
    $msg = "Table Name is empty";
  } else {
    $columnName = implode(",", $columns);
    $query = "SELECT " . $columnName . " FROM $tableName" . " WHERE Status='Rejected'";
    // $query = "SELECT * FROM ddo ORDER BY id DESC";
    $result = $db->query($query);
    if ($result == true) {
      if ($result->num_rows > 0) {
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $msg = $row;
      } else {
        $msg = "No Data Found";
      }
    } else {
      $msg = mysqli_error($db);
    }
  }
  return $msg;
}

?>