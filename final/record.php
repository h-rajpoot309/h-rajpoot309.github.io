<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "haseeb";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn){
    die("Sorry we failed to connect: " . mysqli_connect_error());
}

// Delete data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM register WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Retrieve records from the database
$sql = "SELECT * FROM register";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link
            href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"
            rel="stylesheet"
    />
    <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap"
            rel="stylesheet"
    />
    <title>Document</title>
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
<div class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1 mt-8">
    <div class="p-6 sm:p-12">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl xl:text-3xl font-extrabold">Student Records</h1>
            <button onclick="window.location.href = 'registration.php'"
                    class="px-4 py-2 bg-indigo-500 text-white rounded-lg">Add New Record
            </button>
        </div>
        <div class="overflow-x-auto mt-8">
            <table class="w-full table-fixed">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-indigo-500 text-gray-100 font-semibold">Name</th>
                    <th class="px-6 py-3 bg-indigo-500 text-gray-100 font-semibold">Gender</th>
                    <th class="px-6 py-3 bg-indigo-500 text-gray-100 font-semibold">Email</th>
                    <th class="px-6 py-3 bg-indigo-500 text-gray-100 font-semibold">Address</th>
                    <th class="px-6 py-3 bg-indigo-500 text-gray-100 font-semibold">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='px-6 py-2'>" . $row['name'] . "</td>";
                        echo "<td class='px-6 py-2'>" . $row['gender'] . "</td>";
                        echo "<td class='px-6 py-2'>" . $row['email'] . "</td>";
                        echo "<td class='px-6 py-2'>" . $row['address'] . "</td>";
                        echo "<td class='px-6 py-2'>";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='delete_id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' class='px-4 py-2 bg-indigo-500 text-white rounded-lg'>Edit</button>";
                        echo "<button type='submit' class='px-4 py-2 bg-red-500 text-white rounded-lg'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                $conn->close();
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
