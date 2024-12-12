<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增新角色</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
        .switch {
            text-align: center;
            margin-top: 10px;
        }
        .switch a {
            color: #4CAF50;
            text-decoration: none;
        }
        .switch a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container" id="form-container">
        <div id="newcharacter-form">
            <h2>新增角色</h2>
            <form action="add_character.php" method="POST">
                <label for="name">角色名稱：<input type="text" id="name" name="CharterName" maxlength="20" required></label>
                
                <label for="lv">等級：<input type="number" id="lv" name="LV" required></label>
                
                <label for="hp">HP：<input type="number" id="hp" name="HP" required></label>
                
                <label for="mp">MP：<input type="number" id="mp" name="MP" required></label>
                
                <label for="physiAtt">物理攻擊：<input type="number" id="physiAtt" name="PhysiAtt" required></label>
                
                <label for="magicAtt">魔法攻擊：<input type="number" id="magicAtt" name="MagicAtt" required></label>
                
                <label for="physiDef">物理防禦：<input type="number" id="physiDef" name="PhysiDef" required></label>
                
                <label for="magicDef">魔法防禦：<input type="number" id="magicDef" name="MagicDef" required></label>
                
                <label for="occupation">職業：<input type="text" id="occupation" name="Occupation" maxlength="20" required></label>

                <button type="submit">新增</button>
                <div class="switch">
                <a href="#" onclick="switchToItem()">新增道具</a>
                </div>
                <a href="index.php" style='text-align:center'>回首頁</a>
            </form>
        </div>
        <div id="newitem-form"  style="display: none;">
            <h2>新增道具</h2>
            <form action="add_item.php" method="POST">
                <label for="name">道具名稱：<input type="text" id="name" name="ItemName" maxlength="20" required></label>
                <label for="occaption" required>可用職業：</label>
                    <select id="occaption" name="Occaption">
                        <option value="戰士">戰士</option>
                        <option value="法師">法師</option>
                        <option value="坦克">坦克</option>
                        <option value="刺客">刺客</option>
                    </select>
                <label for="proper">道具屬性：<input type="text" id="proper" name="ItemProper" maxlength="20" required></label>
                <button type="submit">新增</button>
            </form>
            <div class="switch">
                <a href="#" onclick="switchToCharacter()">新增角色</a>
            </div>
            <a href="index.php" style='text-align:center'>回首頁</a>
        </div>
    </div>
    <script>
        function switchToItem() {
            document.getElementById('newcharacter-form').style.display = 'none';
            document.getElementById('newitem-form').style.display = 'block';
        }

        function switchToCharacter() {
            document.getElementById('newitem-form').style.display = 'none';
            document.getElementById('newcharacter-form').style.display = 'block';
        }
    </script>
</body>
</html>