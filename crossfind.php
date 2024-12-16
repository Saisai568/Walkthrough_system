<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>交叉查詢</title>
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
            margin: 10px auto;
            padding: 20px;
            max-width: 600px;
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
        .filter-form {
            margin-bottom: 20px;
            text-align: center;
        }
        .filter-form label {
            margin-right: 10px;
            font-weight: bold;
        }
        .filter-form input {
            margin-right: 20px;
            padding: 5px;
        }
        .filter-form button {
            padding: 5px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .filter-form button:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
        }
        /* 置中的 div */
        .centered-div {
            width: 300px;
            height: 200px;
            background-color: #FFFFFF;
            color: white;
            display: flex;
            justify-content: center; /* 內容水平置中 */
            align-items: center; /* 內容垂直置中 */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <h1>交叉查詢</h1>
    </header>
    <nav>
        <a href="index.php">回首頁</a>
    </nav>
    <main>
        <div class="card">
            <form class="filter-form" id="queryForm">
                <h3>職業有多少角色</h3>
                <label for="occuptionname" required>職業：</label>
                    <select id="occuptionname" name="occuptionname">
                        <option value="1">戰士</option>
                        <option value="2">法師</option>
                        <option value="3">坦克</option>
                        <option value="4">刺客</option>
                    </select>
                <button type="button" onclick="fetchOccuptionData()">查詢</button>
            </form>
            <div id="result" class="result"></div>
        </div>
        <div class="card">
            <form class="filter-form" id="queryForm">
                <h3>角色分布位置</h3>
                <label for="charterposition">角色名稱：</label>
                <input type="text" id="charterposition" name="charterposition" required>
                <button type="button" onclick="fetchPositionData()">查詢</button>
            </form>
            <div id="positionresult" class="positionresult"></div>
        </div>
        <div class="card">
            <form class="filter-form" id="queryForm">
                <h3>使用過的角色</h3>
                <label for="username">使用者名稱：</label>
                <input type="text" id="username" name="username" required>
                <button type="button" onclick="fetchUserData()">查詢</button>
            </form>
            <div id="userresult" class="userresult"></div>
        </div>
        <div class="card">
            <form class="filter-form" id="queryForm">
                <h3>角色與職業</h3>
                <label for="charoccu"></label>
                <button type="button" onclick="fetchCharOccuData()">查詢</button>
            </form>
            <div id="charoccuresult" class="charoccuresult"></div>
        </div>
        <div class="card">
            <form class="filter-form" id="queryForm">
                <h3>職業與物品數量</h3>
                <label for="itemoccu"></label>
                <button type="button" onclick="fetchItemOccuData()">查詢</button>
            </form>
            <div id="itemoccuresult" class="itemoccuresult"></div>
        </div>
        <div class="card">
            <form class="filter-form" id="queryForm">
                <h3>角色所搭配武器的傷害</h3>
                <label for="weapondamage"></label>
                <button type="button" onclick="fetchDamageData()">查詢</button>
            </form>
            <div id="damageresult" class="damageresult"></div>
        </div>
        <!-- <div style="width: 50%; margin: auto;" class="centered-div">
        <canvas id="myChart"></canvas>
    </div> -->
    </main>

    <script>
        function fetchOccuptionData() {
        const occuptionname = document.getElementById('occuptionname').value;
        if (!occuptionname) {
            alert('請輸入職業名稱！');
            return;
        }

        fetch('queryoccuption.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ occuptionname })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {       
            const resultElement = document.getElementById('result');
        
            if (Array.isArray(data) && data.length > 0) {
                // 清空內容並顯示多筆資料
                resultElement.innerHTML = '<ul>' + 
                    data.map(item => 
                        `<li>角色名稱: ${item.CharterName}, 職業名稱: ${item.OccuptionName}</li>`
                    ).join('') + 
                    '</ul>';
            } else {
                resultElement.innerHTML = '<p style="color: red;">未找到相關資料。</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('result').innerHTML = '<p style="color: red;">發生錯誤，請稍後再試。</p>';
        });
    }
    function fetchPositionData() {
        const chartername = document.getElementById('charterposition').value;
        if (!charterposition) {
            alert('請輸入角色名稱！');
            return;
        }

        fetch('querycharterposition.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ chartername })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {       
            const resultElement = document.getElementById('positionresult');
        
            if (Array.isArray(data) && data.length > 0) {
                // 清空內容並顯示多筆資料
                resultElement.innerHTML = '<ul>' + 
                    data.map(item => 
                        `<li>角色名稱: ${item.CharterName}, 戰鬥位置: ${item.Position}, 出現次數: ${item.AppearanceCount}, 出現機率: ${item.AppearanceProbability}</li>`
                    ).join('') + 
                    '</ul>';
            } else {
                resultElement.innerHTML = '<p style="color: red;">未找到相關資料。</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('positionresult').innerHTML = '<p style="color: red;">發生錯誤，請稍後再試。</p>';
        });
    }
    function fetchUserData() {
        const username = document.getElementById('username').value;
        if (!username) {
            alert('請輸入使用者名稱！');
            return;
        }

        fetch('queryuserchar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {       
            const resultElement = document.getElementById('userresult');
        
            if (Array.isArray(data) && data.length > 0) {
                // 清空內容並顯示多筆資料
                resultElement.innerHTML = '<ul>' + 
                    data.map(item => 
                        `<li>使用者名稱: ${item.UserName}, 使用角色: ${item.CharterName}</li>`
                    ).join('') + 
                    '</ul>';
            } else {
                resultElement.innerHTML = '<p style="color: red;">未找到相關資料。</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('userresult').innerHTML = '<p style="color: red;">發生錯誤，請稍後再試。</p>';
      
        });
    }
    function fetchCharOccuData() {
        fetch('querycharoccu.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {       
            const resultElement = document.getElementById('charoccuresult');
        
            if (Array.isArray(data) && data.length > 0) {
                // 清空內容並顯示多筆資料
                resultElement.innerHTML = '<ul>' + 
                    data.map(item => 
                        `<li>角色名稱: ${item.chartername}, 職業名稱: ${item.OccuptionName}</li>`
                    ).join('') + 
                    '</ul>';
            } else {
                resultElement.innerHTML = '<p style="color: red;">未找到相關資料。</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('charoccuresult').innerHTML = '<p style="color: red;">發生錯誤，請稍後再試。</p>';
      
        });
    }
    function fetchItemOccuData() {
        fetch('queryitemoccu.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {       
            const resultElement = document.getElementById('itemoccuresult');
        
            if (Array.isArray(data) && data.length > 0) {
                // 清空內容並顯示多筆資料
                resultElement.innerHTML = '<ul>' + 
                    data.map(item => 
                        `<li>職業名稱: ${item.OccuptionName}, 物品數: ${item.ItemCount}</li>`
                    ).join('') + 
                    '</ul>';
            } else {
                resultElement.innerHTML = '<p style="color: red;">未找到相關資料。</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('itemoccuresult').innerHTML = '<p style="color: red;">發生錯誤，請稍後再試。</p>';
      
        });
    }
    function fetchDamageData() {
        fetch('querydamage.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {       
            const resultElement = document.getElementById('damageresult');
        
            if (Array.isArray(data) && data.length > 0) {
                // 清空內容並顯示多筆資料
                resultElement.innerHTML = '<ul>' + 
                    data.map(item => 
                        `<li>角色名稱: ${item.CharterName}, 武器名稱: ${item.weaponname}, 傷害數: ${item.damage}</li>`
                    ).join('') + 
                    '</ul>';
            } else {
                resultElement.innerHTML = '<p style="color: red;">未找到相關資料。</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('damageresult').innerHTML = '<p style="color: red;">發生錯誤，請稍後再試。</p>';
      
        });
    }
    </script>
</body>
</html>
