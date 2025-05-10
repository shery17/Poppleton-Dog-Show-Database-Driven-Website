<!DOCTYPE html>
<html>
    <head>
        <title>Assignment 3: A Database-Driven Website</title>
    </head>
    <body>
        <?php 
            // Connect to Database
            require_once 'connection.php';
            
            // Stores total number of owners
            $query = "SELECT * FROM owners";
            $results = mysqli_query($conn, $query);
            $numOwners = mysqli_num_rows($results);

            // Stores total number of dogs
            $query = "SELECT * FROM dogs";
            $results = mysqli_query($conn, $query);
            $numDogs = mysqli_num_rows($results);

            // Stores total number of events
            $query = "SELECT * FROM events";
            $results = mysqli_query($conn, $query);
            $numEvents = mysqli_num_rows($results);

            // Prints Welcome message
            echo "<h1>Welcome to Poppleton Dog Show! This year " . $numOwners . " owners entered " . $numDogs . " dogs in " . $numEvents . " events</h1>";

            // Stores top 10 dogs in the show
            $query = "SELECT d.name AS `Dog name`, b.name AS `Breed`, ROUND(AVG(score), 2) AS `Average Score`, o.name AS `Owner Name`, o.email AS `Email Address`
            FROM `entries` AS e
            INNER JOIN `competitions` AS c 
              ON c.id = e.competition_id
            INNER JOIN `dogs` AS d 
              ON d.id = e.dog_id
            INNER JOIN `breeds` AS b 
              ON b.id = d.breed_id
            INNER JOIN `owners` AS o 
              ON o.id = d.owner_id
            GROUP BY dog_id
            HAVING COUNT(c.event_id) > 1
            ORDER BY `Average Score` DESC
            LIMIT 10";
            $results = mysqli_query($conn, $query);
            
            // Prints a table of top 10 dogs in the show
            echo "<table>";
            echo "<th>Dog name</th>";
            echo "<th>Breed</th>";
            echo "<th>Average Score</th>";
            echo "<th>Owner Name</th>";
            echo "<th>Email Address</th>";
            
            while ($row = mysqli_fetch_assoc($results)) {
                echo "<tr>";
                echo "<td>".$row['Dog name']."</td>" . "<td>".$row['Breed']."</td>" . "<td>".$row['Average Score']."</td>"
                // Links for seperate window pop-up containing contact details
                . "<td><a href='contactDetails.php?owner=".$row['Owner Name']."' target='_blank'>".$row['Owner Name']."</a></td>"
                // Links for default email application pop-up
                . "<td><a href = 'mailto: " .$row['Email Address']. "'>".$row['Email Address']."</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        ?>
    </body>
</html>