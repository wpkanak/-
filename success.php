<?php
// Display success message
echo "Thank you, " . $_SESSION['name'] . "! Your information has been saved.";

// Display contents of users.csv file in a table
$users_file = fopen("users.csv", "r");
echo "<table>";
echo "<tr><th>Name</th><th>Email</th><th>Profile Picture</th></tr>";
while (($data = fgetcsv($users_file, 1000, ",")) !== FALSE) {
    echo "<tr>";
    foreach ($data as $value) {
        echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
fclose($users_file);
?>
