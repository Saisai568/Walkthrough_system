<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>道具介紹</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        main {
            padding: 20px;
            text-align: center;
        }
        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: inline-block;
            margin: 10px;
            padding: 20px;
            width: 250px;
        }
        .card h3 {
            margin-top: 0;
            color: #333;
        }
        .card p {
            color: #555;
        }
        nav {
            background: #333;
            color: white;
            text-align: right;
            padding: 5px;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-size: 16px;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>道具介紹</h1>
    </header>
    <nav>
        <a href="index.php">回首頁</a>
    </nav>
    <main>
        <?php
        require "load.php";       

        // Fetch data from database
        $sql = "SELECT ItemId, ItemName, ItemProper, Occuptionid FROM Item";
        $result = $mydb->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<h3>" . htmlspecialchars($row["ItemName"]) . "</h3>";
                echo "<p><strong>職業</strong>:" . htmlspecialchars($row["Occuptionid"]) . "</p>";
                echo "<p><strong>屬性</strong>: " . htmlspecialchars($row["ItemProper"]) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No items found</p>";
        }
        $mydb->close();
        ?>
    </main>
</body>
</html>
