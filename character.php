<?php
header("Content-Type: text/html; charset=utf-8");


$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "Walkthrough_system";

$mydb = new mysqli($db_server, $db_user, $db_password, $db_name);

if ($mydb->connect_error) {
    die("連接失敗 " . $mydb->connect_error);
}

if (!$mydb->set_charset("utf8mb4")) {
    die("設置字體失敗: " . $mydb->error);
}


try {
    $pdo = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch characters
    $stmt = $pdo->query("SELECT CharterName FROM charter");
    $characters = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $stmt = $pdo->query("SELECT CharterId  FROM charter");
    $charactersid = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>角色拖曳小隊組成</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
  <style>
    * {
      margin: 0;
      padding: 0;
    }
    body {
      margin: 0; /* 移除默認的邊距 */
      border: 5px solid black; /* 設置邊界的寬度和顏色 */
      padding: 10px; /* 給內容加內邊距，避免內容緊貼邊框 */
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
      flex-direction: column;  /* 垂直排列內容 */
      background-color: #f4f4f4;
    }

    .container {
      display: flex;
      width: 80%;
      justify-content: space-between;
      flex: 1;  /* 使容器區域占滿頁面剩餘空間 */
    }

    .team-section {
      width: 48%;
    }

    #characters, #enemy-characters {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .character-row {
      display: flex;
      gap: 10px;
    }

    .character {
      width: 80px;
      height: 80px;
      background-color: #a3d2ca;
      border: 1px solid #2d6a4f;
      text-align: center;
      line-height: 80px;
      cursor: grab;
    }

    #team, #enemy-team {
      margin-top: 20px;
      width: 100%;
      height: 150px;
      border: 2px dashed #2d6a4f;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .title {
      text-align: center;
      margin-bottom: 10px;
    }

    button {
      display: block;
      margin: 20px auto;
    }
    #submitTeam {
      margin: 20px auto 40px;  /* 設置按鈕距離上下邊距 */
      padding: 10px 20px;
      font-size: 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
    }

    #submitTeam:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="team-section">
          <div class="title">我方(進攻)隊伍</div>
          <div id="characters">
              <?php
              $count = 0;
              foreach ($characters as $character) {
                  if ($count % 5 === 0) echo '<div class="character-row">';
                  echo "<div class='character' draggable='true' id='$character'>$character</div>";
                  if ($count % 5 === 4) echo '</div>';
                  $count++;
              }
              if ($count % 5 !== 0) echo '</div>'; // Close last row if not complete
              ?>
          </div>
          <p style="border-bottom: 2px dotted; text-align: center;">拖曳角色到這裡來組成小隊</p>
          <div id="team"></div>
      </div>
    
    <!-- 敵方隊伍 -->
    <div class="team-section">
      <div class="title">敵方(防守)隊伍</div>
        <div id="enemy-characters">
              <?php
              $count = 0;
              foreach ($characters as $character) {
                  if ($count % 5 === 0) echo '<div class="character-row">';
                  echo "<div class='character' draggable='true' id='$character'>$character</div>";
                  if ($count % 5 === 4) echo '</div>';
                  $count++;
              }
              if ($count % 5 !== 0) echo '</div>'; // Close last row if not complete
              ?>
          </div>
          <p style="border-bottom: 2px dotted; text-align: center;">拖曳角色到這裡來組成小隊</p>
        <div id="enemy-team"></div>
      </div>
   
    </div>
  <div><button id="submitTeam">提交小隊</button><a href="index.php" style='text-align:center'>回首頁</a></div>
  
  

  <script>
    // 通用的拖曳邏輯
    const characters = document.querySelectorAll('.character');
    const team = document.getElementById('team');
    const enemyTeam = document.getElementById('enemy-team');

    characters.forEach((character) => {
      character.addEventListener('dragstart', (event) => {
        event.dataTransfer.setData('text/plain', character.id);
      });
    });

    function handleDrop(teamElement) {
      teamElement.addEventListener('dragover', (event) => {
        event.preventDefault(); // 允許放置
      });

      teamElement.addEventListener('drop', (event) => {
        event.preventDefault();
        const characterId = event.dataTransfer.getData('text/plain');
        const draggedCharacter = document.getElementById(characterId);
        if (teamElement.children.length < 5) { // 限制五個角色
          teamElement.appendChild(draggedCharacter);
        } else {
          alert('小隊已滿！');
        }
      });
    }

    handleDrop(team);
    handleDrop(enemyTeam);

    document.getElementById('submitTeam').addEventListener('click', () => {
      const teamMembers = Array.from(team.children)
        .filter(child => child.id) // 過濾掉非角色元素
        .map(member => member.id); // 提取角色 ID

      const enemyMembers = Array.from(enemyTeam.children)
        .filter(child => child.id) // 過濾掉非角色元素
        .map(member => member.id); // 提取角色 ID 
      
      if (teamMembers.length < 5 || enemyMembers.length < 5) {
        alert('小隊尚未組成！');
        return;
      }

      // 使用 fetch 發送 AJAX 請求
      fetch('process_team.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ team: teamMembers, enemyTeam: enemyMembers }),
      })
        .then(response => response.text())
        .then(data => {
          alert('提交成功！伺服器回應：' + data);
        })
        .catch(error => {
          console.error('提交失敗：', error);
        });
    });
  </script>
</body>
</html>
