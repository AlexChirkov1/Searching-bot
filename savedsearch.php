<?php
include "header.php";
include 'db_connect.php';

$conn = OpenCon();
$sql = "SELECT * FROM saved_search";
$result = $conn->query($sql);
CloseCon($conn);

if (isset($_GET['list_me'])) {
    removeSearch();
}

echo "<div class='col-lg-12'><h4 >Saved searches:</h4></div>";

function removeSearch()
{
    $conn = OpenCon();
    $itemId = (int) $_GET['id'];
    $sqlreq = "DELETE FROM saved_search WHERE id = '$itemId'";

    if (mysqli_query($conn, $sqlreq)) {
        echo "Record deleted successfully";
        header('Location: ./savedsearch.php');

    } else {
        echo "Error deleting record: " . $conn->error;
    }
    CloseCon($conn);
}

echo "<div class=col-lg-12>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card w-75'><div class='card-body'>";
        echo "<h5 class='card-title'>Car name:&nbsp;" . $row["searchField"] . "</h5>";
        if (strlen($row["minPrice"]) == 0) {
            echo "<p class='card-text'><b>Min price:</b>&nbsp; -</p>";
        } else {
            echo "<p class='card-text'><b>Min price:</b>&nbsp; " . $row["minPrice"] . "$</p>";
        }
        if (strlen($row["minPrice"]) == 0) {
            echo "<p class='card-text'><b>Max price:</b>&nbsp; -</p>";
        } else {
            echo "<p class='card-text'><b>Max price:</b>&nbsp; " . $row["maxPrice"] . "$</p>";
        }
        if (strlen($row["model"]) == 0) {
            echo "<p class='card-text'><b>Model:</b>&nbsp; -</p>";
        } else {
            echo "<p class='card-text'><b>Model:</b>&nbsp; " . $row["model"] . "</p>";
        }

        echo "<p class='card-text'><b>Date created:</b>&nbsp; " . date("F j, Y, g:i a", $row["dateCreated"]) .
        "<a class='remove' href='?list_me&id=" . $row['id'] . "'>Remove</a>".
        "<span class='edit' onClick='start(". json_encode($row) .")'>Edit</span></p>";
            
        echo "</div></div>";
    }
} else {
    echo "0 results";
}
echo "</div>";
include "footer.php";
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit search</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="id" style="overflow:hidden"></span>
                <div class="form-group">
                    <label for="carName">Car name</label>
                    <input type="text" class="form-control" id="carName" value="" placeholder="Car name">
                </div>
                <div class="form-group">
                    <label for="carName">Min price</label>
                    <input type="text" class="form-control" id="minPrice" value="" placeholder="Min price">
                </div>
                <div class="form-group">
                    <label for="carName">Max price</label>
                    <input type="text" class="form-control" id="maxPrice" value="" placeholder="Max price">
                </div>
                <div class="form-group">
                    <label for="carName">Model</label>
                    <input type="text" class="form-control" id="model" value="" placeholder="Model">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onClick="save()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
function start(id, event) {
    $('#myModal').modal('show');
    $("#carName").val(id['searchField']);
    $("#minPrice").val(id['minPrice']);
    $("#maxPrice").val(id['maxPrice']);
    $("#model").val(id['model']);
    $("#id").val(id['id']);
}

function save() {
    $.ajax({
        url: 'AJAX.php',
        type: 'GET',
        data: ({
            id: $("#id").val(),
            search_field: $("#carName").val(),
            minPrice: $("#minPrice").val(),
            maxPrice: $("#maxPrice").val(),
            model: $("#model").val()
        }),
        success: function(results) {
            reload();
        }
    });
}

function reload() {
    location.reload(true);
}
</script>