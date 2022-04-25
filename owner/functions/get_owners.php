<?php
require("../../db_config.php");

$sql = "SELECT id,names,contact,nin,bank FROM owners";
$query = mysqli_query($conn, $sql);
$number = 0;
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $number += 1;
        echo '<tr><th scope="">' . $number . '</th>
        <td>' . $row['names'] . '</td>
        <td>20</td>
        <td>' . $row['contact'] . '</td>
        <td>' . $row['nin'] . '</td>
        <td>' . $row['bank'] . '</td>
        <td><button onclick="deleteOwner(' . $row['id'] . ')" type="button" class="btn btn-danger btn-sm" id="deletebutton">
        <i class="fa fa-trash" aria-hidden="true"></i> DELETE</button>
        <button id="updatebutton" data-id="' . $row['id'] . '" data-names="' . $row['names'] . '" data-contact="' . $row['contact'] . '" data-nin="' . $row['nin'] . '" data-bank="' . $row['bank'] . '" type="button" class="binto btn btn-primary btn-sm">
        <i class="fa fa-edit" aria-hidden="true"></i> MODIFY</button>
        </td>	
		</tr>';
    }
}
else {
    echo "<h2>No ownerss to display,please add new</h2>";
//echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);

?>