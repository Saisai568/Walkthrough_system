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
    <!-- 我方隊伍 -->
    <div class="team-section">
      <div class="title">我方(進攻)隊伍</div>
      <div id="characters">
      <div class="character-row">
        <div class="character" draggable="true" id="艾德華">艾德華</div>
        <div class="character" draggable="true" id="阿爾法">阿爾法</div>
        <div class="character" draggable="true" id="龍傲天">龍傲天</div>
        <div class="character" draggable="true" id="天行者">天行者</div>
        <div class="character" draggable="true" id="雪莉">雪莉</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="烈焰狼">烈焰狼</div>
        <div class="character" draggable="true" id="神秘術士">神秘術士</div>
        <div class="character" draggable="true" id="劍聖">劍聖</div>
        <div class="character" draggable="true" id="夜刃">夜刃</div>
        <div class="character" draggable="true" id="雷霆女王">雷霆女王</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="暗影大師">暗影大師</div>
        <div class="character" draggable="true" id="晨曦守護者">晨曦守護者</div>
        <div class="character" draggable="true" id="冰封獵人">冰封獵人</div>
        <div class="character" draggable="true" id="秘術弓箭手">秘術弓箭手</div>
        <div class="character" draggable="true" id="天使之羽">天使之羽</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="黑魔導士">黑魔導士</div>
        <div class="character" draggable="true" id="鋼鐵雄心">鋼鐵雄心</div>
        <div class="character" draggable="true" id="聖光女武神">聖光女武神</div>
        <div class="character" draggable="true" id="月光劍客">月光劍客</div>
        <div class="character" draggable="true" id="烈火戰士">烈火戰士</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="碧海忍者">碧海忍者</div>
        <div class="character" draggable="true" id="破碎者">破碎者</div>
        <div class="character" draggable="true" id="魔法獵人">魔法獵人</div>
        <div class="character" draggable="true" id="巫師領主">巫師領主</div>
        <div class="character" draggable="true" id="霜火焰使">霜火焰使</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="神箭手">神箭手</div>
        <div class="character" draggable="true" id="風暴之靈">風暴之靈</div>
        <div class="character" draggable="true" id="戰歌領主">戰歌領主</div>
        <div class="character" draggable="true" id="白狼">白狼</div>
        <div class="character" draggable="true" id="天籟歌者">天籟歌者</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="破碎之心">破碎之心</div>
        <div class="character" draggable="true" id="龍之勇者">龍之勇者</div>
        <div class="character" draggable="true" id="魅影刺客">魅影刺客</div>
        <div class="character" draggable="true" id="幻影之刃">幻影之刃</div>
        <div class="character" draggable="true" id="雪狼領主">雪狼領主</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="疾風刺客">疾風刺客</div>
        <div class="character" draggable="true" id="黑翼天使">黑翼天使</div>
        <div class="character" draggable="true" id="暗月教主">暗月教主</div>
        <div class="character" draggable="true" id="雷霆法師">雷霆法師</div>
        <div class="character" draggable="true" id="銀月弓箭手">銀月弓箭手</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="星光守衛">星光守衛</div>
        <div class="character" draggable="true" id="極寒法王">極寒法王</div>
        <div class="character" draggable="true" id="燃燒之魂">燃燒之魂</div>
        <div class="character" draggable="true" id="神龍武士">神龍武士</div>
        <div class="character" draggable="true" id="元素使者">元素使者</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="火焰刺客">火焰刺客</div>
        <div class="character" draggable="true" id="風之舞者">風之舞者</div>
        <div class="character" draggable="true" id="暗黑騎士">暗黑騎士</div>
        <div class="character" draggable="true" id="雪影魔女">雪影魔女</div>
        <div class="character" draggable="true" id="雷霆巨獸">雷霆巨獸</div>
    </div>
      </div>
      <p style="border-bottom: 2px dotted; text-align: center;">拖曳角色到這裡來組成小隊</p>
      <div id="team"></div>
    </div>
    
    <!-- 敵方隊伍 -->
    <div class="team-section">
      <div class="title">敵方(防守)隊伍</div>
      <div id="enemy-characters">
      <div class="character-row">
        <div class="character" draggable="true" id="艾德華">艾德華</div>
        <div class="character" draggable="true" id="阿爾法">阿爾法</div>
        <div class="character" draggable="true" id="龍傲天">龍傲天</div>
        <div class="character" draggable="true" id="天行者">天行者</div>
        <div class="character" draggable="true" id="雪莉">雪莉</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="烈焰狼">烈焰狼</div>
        <div class="character" draggable="true" id="神秘術士">神秘術士</div>
        <div class="character" draggable="true" id="劍聖">劍聖</div>
        <div class="character" draggable="true" id="夜刃">夜刃</div>
        <div class="character" draggable="true" id="雷霆女王">雷霆女王</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="暗影大師">暗影大師</div>
        <div class="character" draggable="true" id="晨曦守護者">晨曦守護者</div>
        <div class="character" draggable="true" id="冰封獵人">冰封獵人</div>
        <div class="character" draggable="true" id="秘術弓箭手">秘術弓箭手</div>
        <div class="character" draggable="true" id="天使之羽">天使之羽</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="黑魔導士">黑魔導士</div>
        <div class="character" draggable="true" id="鋼鐵雄心">鋼鐵雄心</div>
        <div class="character" draggable="true" id="聖光女武神">聖光女武神</div>
        <div class="character" draggable="true" id="月光劍客">月光劍客</div>
        <div class="character" draggable="true" id="烈火戰士">烈火戰士</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="碧海忍者">碧海忍者</div>
        <div class="character" draggable="true" id="破碎者">破碎者</div>
        <div class="character" draggable="true" id="魔法獵人">魔法獵人</div>
        <div class="character" draggable="true" id="巫師領主">巫師領主</div>
        <div class="character" draggable="true" id="霜火焰使">霜火焰使</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="神箭手">神箭手</div>
        <div class="character" draggable="true" id="風暴之靈">風暴之靈</div>
        <div class="character" draggable="true" id="戰歌領主">戰歌領主</div>
        <div class="character" draggable="true" id="白狼">白狼</div>
        <div class="character" draggable="true" id="天籟歌者">天籟歌者</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="破碎之心">破碎之心</div>
        <div class="character" draggable="true" id="龍之勇者">龍之勇者</div>
        <div class="character" draggable="true" id="魅影刺客">魅影刺客</div>
        <div class="character" draggable="true" id="幻影之刃">幻影之刃</div>
        <div class="character" draggable="true" id="雪狼領主">雪狼領主</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="疾風刺客">疾風刺客</div>
        <div class="character" draggable="true" id="黑翼天使">黑翼天使</div>
        <div class="character" draggable="true" id="暗月教主">暗月教主</div>
        <div class="character" draggable="true" id="雷霆法師">雷霆法師</div>
        <div class="character" draggable="true" id="銀月弓箭手">銀月弓箭手</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="星光守衛">星光守衛</div>
        <div class="character" draggable="true" id="極寒法王">極寒法王</div>
        <div class="character" draggable="true" id="燃燒之魂">燃燒之魂</div>
        <div class="character" draggable="true" id="神龍武士">神龍武士</div>
        <div class="character" draggable="true" id="元素使者">元素使者</div>
    </div>
    <div class="character-row">
        <div class="character" draggable="true" id="火焰刺客">火焰刺客</div>
        <div class="character" draggable="true" id="風之舞者">風之舞者</div>
        <div class="character" draggable="true" id="暗黑騎士">暗黑騎士</div>
        <div class="character" draggable="true" id="雪影魔女">雪影魔女</div>
        <div class="character" draggable="true" id="雷霆巨獸">雷霆巨獸</div>
    </div>
      </div>
      <p style="border-bottom: 2px dotted; text-align: center;">拖曳角色到這裡來組成小隊</p>
      <div id="enemy-team"></div>
    </div>
  </div>
  <div><button id="submitTeam">提交小隊</button></div>
  

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
