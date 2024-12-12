<?php
    require "load.php";
    if (!isset($_SESSION['username'])) {
        $hideCard = 'style="display:none;"'; // 如果已經登入，隱藏該元素
        $logoutdisplay = 'style="display:block;';
        
    } 
    else {
        $hideCard = ''; // 如果沒有登入，顯示該元素
        $logoutdisplay = 'style="display:none;"';
    }
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>遊戲攻略系統</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
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
        nav {
            background: #333;
            color: white;
            display: block;
            justify-content: flex-start;
            text-align:right;   
            
        }
        nav a {
            background: #333;
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-size: 16px;
             
        }
        nav a:hover {
            text-decoration: underline;
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
        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .card a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>遊戲攻略系統</h1>
    </header>
    <nav>
        <a href=""></a>
        <!-- <div>
            <button herf="logout.php">登出</button> 
        </div>   -->
    </nav>
    <main>
        <div>
            <div class="card" >
                <img src="img/edit.png"/>
                <h3>戰鬥上傳</h3>
                <a href="character.php">進入</a>   
            </div>
            <div class="card">
                <img src="img/swords.png"/>
                <h3>競技場對戰查詢</h3>
                <a href="fightdata.php">進入</a>
            </div>
            <div class="card">
                <img src="img/warrior.png"/>
                <h3>角色登場率</h3>
                <a href="characterpercent.php">進入</a>
            </div>
        </div>
        <div>
            <div class="card">
                <img src="img/magic-wand.png"/>
                <h3>道具介紹</h3>
                <a href="itemintro.php">進入</a>
            </div>
            <div class="card">
                <img src="img/numbers.png"/>
                <h3>角色數值計算器</h3>
                <a href="charactercal.php">進入</a>
            </div>
            <div class="card">
                <img src="img/witch.png"/>
                <h3>新增角色/道具</h3>
                <a href="new-character.php">進入</a>
            </div>
        </div>
        <div>
            <div class="card">
                <img src="img/user.png"/>
                <h3>我的資料</h3>
                <a href="mydata.php">進入</a>
            </div>
        </div>
        
    </main>
</body>
</html>
