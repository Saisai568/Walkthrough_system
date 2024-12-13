<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle Record Query</title>
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
        .filter-form {
            margin-bottom: 20px;
            text-align: center;
        }
        .filter-form label {
            margin-right: 10px;
            font-weight: bold;
        }
        .filter-form select, .filter-form input {
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
    </style>
</head>
<body>
    <header>
        <h1>Battle Record Query</h1>
    </header>
    <nav>
        <a href="#">Home</a>
    </nav>
    <main>
        <form class="filter-form">
            <label for="character">Character:</label>
            <select id="character" name="character">
                <option value="">--Select Character--</option>
                <option value="1">Character 1</option>
                <option value="2">Character 2</option>
                <option value="3">Character 3</option>
            </select>

            <label for="player">Player Name:</label>
            <input type="text" id="player" name="player">

            <label for="time">Time Range:</label>
            <select id="time" name="time">
                <option value="">--Select Range--</option>
                <option value="week">Last Week</option>
                <option value="month">Last Month</option>
            </select>

            <button type="button" onclick="searchRecords()">Search</button>
        </form>

        <div id="records">
            <p>No records found.</p>
        </div>
    </main>
    <script>
        function searchRecords() {
            const character = document.getElementById('character').value;
            const player = document.getElementById('player').value;
            const time = document.getElementById('time').value;

            const bodyData = {};
            if (character) bodyData.character = character;
            if (player) bodyData.player = player;
            if (time) bodyData.time = time;

            fetch('searchrecord.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(bodyData)
            })
            .then(response => response.json())
            .then(data => {
                const recordsDiv = document.getElementById('records');
                recordsDiv.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(record => {
                        const card = document.createElement('div');
                        card.className = 'card';
                        card.innerHTML = `
                            <h3>Record #${record.Recordid}</h3>
                            <p>Player: ${record.playerName}</p>
                            <p>Characters: ${record.allyCharacters}, ${record.enemyCharacters}</p>
                            <p>Date: ${record.createdAt}</p>
                            <a href="#">View Details</a>
                        `;
                        recordsDiv.appendChild(card);
                    });
                } else {
                    recordsDiv.innerHTML = '<p>No records found.</p>';
                }
            })
            .catch(error => console.error('Error fetching records:', error));
        }
    </script>
</body>
</html>

