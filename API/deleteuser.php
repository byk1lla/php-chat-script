<?php

include "config.php";

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE unique_id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "deleted";
} else {
    echo "Error: " . mysqli_error($conn);
}

?>
