<?php 
include 'db_connect.php';

$conn = OpenCon();

echo $_GET['search_field'];

$id = $_GET['id'];
$search = $_GET['search_field'];
$minPrice = $_GET['minPrice'];
$maxPrice  = $_GET['maxPrice'];
$model  = $_GET['model'];

$sql = "UPDATE saved_search SET searchField='$search', minPrice='$minPrice', maxPrice='$maxPrice', model='$model'  WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
    header('Location: ./savedsearch.php');

} else {
    echo "Error deleting record: " . $conn->error;
}
CloseCon($conn);
?>