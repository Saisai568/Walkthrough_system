<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>角色拖曳小隊組成</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
  <style>
    #characters {
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

    #team {
      margin-top: 20px;
      width: 300px;
      height: 150px;
      border: 2px dashed #2d6a4f;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
  </style>
</head>
<body>
  <div id="characters">
    <div class="character" draggable="true" id="character1">角色 1</div>
    <div class="character" draggable="true" id="character2">角色 2</div>
    <div class="character" draggable="true" id="character3">角色 3</div>
    <div class="character" draggable="true" id="character4">角色 4</div>
    <div class="character" draggable="true" id="character5">角色 5</div>
  </div>

  <div id="team">
    <p>拖曳角色到這裡來組成小隊</p>
  </div>

  <button id="submitTeam">提交小隊</button>

  <script>
    const characters = document.querySelectorAll('.character');
    const team = document.getElementById('team');

    characters.forEach((character) => {
      character.addEventListener('dragstart', (event) => {
        event.dataTransfer.setData('text/plain', character.id);
      });
    });

    team.addEventListener('dragover', (event) => {
      event.preventDefault(); // 允許放置
    });

    team.addEventListener('drop', (event) => {
      event.preventDefault();
      const characterId = event.dataTransfer.getData('text/plain');
      const draggedCharacter = document.getElementById(characterId);
      if (team.children.length <= 5) { // 限制五個角色
        team.appendChild(draggedCharacter);
      } else {
        alert('小隊已滿！');
      }
    });

    document.getElementById('submitTeam').addEventListener('click', () => {
      const teamMembers = Array.from(team.children)
        .filter(child => child.id) // 過濾掉非角色元素
        .map(member => member.id); // 提取角色 ID

      if (teamMembers.length < 5) {
        alert('小隊尚未組成！');
        return;
      }

      // 使用 fetch 發送 AJAX 請求
      fetch('process_team.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ team: teamMembers }),
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
