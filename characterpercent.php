<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>角色登場率查詢</title>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <h1>角色登場率查詢</h1>
    </header>
    <main>
        <div class="card">
            <form class="filter-form" id="queryForm">
                <label for="charterName">角色名稱：</label>
                <input type="text" id="charterName" name="charterName" required>
                <button type="button" onclick="fetchData()">查詢</button>
            </form>
            <div id="result" class="result"></div>
        </div>
        <div style="width: 50%; margin: auto;" class="centered-div">
        <canvas id="myChart"></canvas>
    </div>
    </main>

    <script>
        function fetchData() {
            const charterName = document.getElementById('charterName').value;
            if (!charterName) {
                alert('請輸入角色名稱！');
                return;
            }

            fetch('querycharacter.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ charterName })
            })
            .then(response => response.json())
            .then(data => {
                const resultDiv = document.getElementById('result');
                if (data.error) {
                    resultDiv.innerHTML = `<p style='color: red;'>${data.error}</p>`;
                } else {
                    resultDiv.innerHTML = `<p>角色 <strong>${charterName}</strong> 的登場率為：<strong>${data.appearanceRate}%</strong></p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('result').innerHTML = '<p style="color: red;">發生錯誤，請稍後再試。</p>';
            });
        }
    </script>
    <script>
        // 取得畫布元素
        const ctx = document.getElementById('myChart').getContext('2d');

        // 建立圖表
        const myChart = new Chart(ctx, {
            type: 'bar', // 圖表類型：柱狀圖
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'], // X軸標籤
                datasets: [{
                    label: 'Sample Dataset', // 資料集標籤
                    data: [12, 19, 3, 5, 2, 3], // 資料
                    backgroundColor: [ // 每個柱子的顏色
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [ // 每個柱子的邊框顏色
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1 // 邊框寬度
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Y軸從 0 開始
                    }
                }
            }
        });
    </script>
</body>
</html>
