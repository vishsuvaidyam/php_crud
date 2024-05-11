<?php
require_once "../Backend/config.php";

// Define items per page and current page
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset
$offset = ($currentPage - 1) * $itemsPerPage;

// Retrieve data from the GET parameters
$name = $_GET["name"];
$username = $_GET["username"];
$email = $_GET["email"];
$password = $_GET["password"];
$DB = connect_to_database();

// Function to fetch users from the database with pagination
function fetchUsers($DB, $offset, $itemsPerPage)
{
    $query = "SELECT * FROM user LIMIT $offset, $itemsPerPage";

    // Execute the query
    $result = $DB->query($query);

    // Check if there are rows returned
    if ($result->num_rows > 0) {

        $id_count = 1;
        // Loop through each row
        while ($row = $result->fetch_assoc()) {
            // Display user data in table rows
            echo "<tr class='hover'>";
            echo "<th scope='row' class='text-center'>" . $id_count . "</th>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td class='text-center fw-bold'>......</td>";
            // Adding a button for an action  
            echo "<td class='text-center'>
                            <button class='btn-info px-4 rounded-pill'>
                            <a class='text-decoration-none text-dark' href='../Backend/User/update.php?id=" . $row['id'] . "'> 
                                <i class='bi bi-pencil-square'></i>
                            </a>
                        </button> 
                        <button class='btn-secondary px-4 rounded-pill'> 
                            <a class='text-dark text-decoration-none' href='../Backend/User/delete.php?id=" . $row['id'] . "'>
                                <i class='bi bi-trash3'></i>
                            </a>
                        </button>
                            </td>";
            echo "</tr>";
            $id_count++;
        }
    } else {
        // If no records found
        echo "<tr>
                        <td colspan='6'>No records found</td>
                     </tr>";
    }
}

fetchUsers($DB, $offset, $itemsPerPage);

// Pagination links
$query = "SELECT COUNT(*) as total FROM user";
$result = $DB->query($query);
$row = $result->fetch_assoc();
$totalPages = ceil($row['total'] / $itemsPerPage);
echo "<tr>
                     <td colspan='6'>";
echo "<nav aria-label='Page navigation'>
                <ul class='pagination justify-content-center'>";
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<li class='page-item'>
                        <a class='page-link' href='?page=$i'>$i</a>
                    </li>";
}
echo "</ul></nav></td></tr>";
?>