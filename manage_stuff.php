<?php
require "load.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理角色、道具、武器</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            width: 100%;
        }
        nav {
            background: #333;
            color: white;
            text-align: right;
            padding: 5px;
            width: 100%;
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
        .container {
            width: 80%;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>管理角色、道具、武器</h1>
    </header>
    <nav>
        <a href="index.php">回首頁</a>
    </nav>
    <div class="container" id="manage-container">
        <div id="character-section">
            <h2>角色列表</h2>
            <table>
                <thead>
                <tr>
                        <th>角色名稱</th>
                        <th>等級</th>
                        <th>HP</th>
                        <th>MP</th>
                        <th>職業ID</th>
                        <th>武器ID</th>
                        <th>操作</th>
                    </tr>
                <?php
                    $sql = "SELECT * FROM charter"; // 假設資料表名稱為 "characters"
                    $result = $mydb->query($sql);

                    if ($result->num_rows > 0) {
                        // 輸出資料
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["CharterName"] . "</td>";
                            echo "<td>" . $row["LV"] . "</td>";
                            echo "<td>" . $row["HP"] . "</td>";
                            echo "<td>" . $row["MP"] . "</td>";
                            echo "<td>" . $row["OccuptionId"] . "</td>";
                            echo "<td>" . $row["weaponId"] . "</td>";
                            echo "<td>
                                    <a href='editcharter.php?id=" . $row["CharterId"] . "'>修改</a> |
                                    <a href='deletecharter.php?id=" . $row["CharterId"] . "'>刪除</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>

                </thead>
                <tbody id="character-table">
                    <!-- 動態內容 -->
                </tbody>
            </table>
        </div>

        <div id="item-section">
            <h2>道具列表</h2>
            <table>
                <thead>
                <tr>
                        <th>道具名稱</th>
                        <th>道具屬性</th>
                        <th>可用職業</th>
                        <th>操作</th>
                    </tr>
                <?php
                    $sql = "SELECT * FROM item"; 
                    $result = $mydb->query($sql);

                    if ($result->num_rows > 0) {
                        // 輸出資料
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["ItemName"] . "</td>";
                            echo "<td>" . $row["ItemProper"] . "</td>";
                            echo "<td>" . $row["OccuptionId"] . "</td>";
                            echo "<td>
                                    <a href='edititem.php?id=" . $row["ItemId"] . "'>修改</a> |
                                    <a href='deleteitem.php?id=" . $row["ItemId"] . "'>刪除</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                    
                </thead>
                <tbody id="item-table">
                    <!-- 動態內容 -->
                </tbody>
            </table>
        </div>

        <div id="weapon-section">
            <h2>武器列表</h2>
            <table>
                <thead>
                    <tr>
                        <th>武器名稱</th>
                        <th>武器加成</th>
                        <th>操作</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM Weapon"; 
                    $result = $mydb->query($sql);

                    if ($result->num_rows > 0) {
                        // 輸出資料
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["weaponName"] . "</td>";
                            echo "<td>" . $row["WeaponMultiplier"] . "</td>";

                            echo "<td>
                                    <a href='editweapon.php?id=" . $row["weaponId"] . "'>修改</a> |
                                    <a href='deleteweapon.php?id=" . $row["weaponId"] . "'>刪除</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </thead>
                <tbody id="weapon-table">
                    <!-- 動態內容 -->
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
