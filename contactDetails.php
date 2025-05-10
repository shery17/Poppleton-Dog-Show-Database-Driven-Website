<!DOCTYPE html>
<html>
    <head>
        <title>Assignment 3: A Database-Driven Website | Contact Details</title>
    </head>
    <!-- Added CSS to make contact details table look more readable -->
    <style>
        table, th, td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
    <body>
    <?php
        // Connect to database
        require_once 'connection.php';
        
        // Get owner name from previous page, run query and store table in details variable
        $name = $_GET['owner'];
        $query = "SELECT `name`, `address`, email, phone FROM owners WHERE name = '".$name."'" ;
        $details = mysqli_query($conn, $query);

        // Print contact details in a table
        echo "<table>";
        echo "<th>Name</th>";
        echo "<th>Address</th>";
        echo "<th>Email</th>";
        echo "<th>Phone Number</th>";

        while ($row = mysqli_fetch_assoc($details)) {
            echo "<tr>";
            echo "<td>".$row['name']."</td>"
            . "<td>".$row['address']."</td>"
            . "<td>".$row['email']."</td>"
            . "<td>".$row['phone']."</td>";
            echo "</tr>";
        }

        echo "</table>";
    ?>        
    </body>
</html>

