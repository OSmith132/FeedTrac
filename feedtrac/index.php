<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FeedTrac</title>

    <link rel="icon" type="image/x-icon" href="assets/icon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="stylesheets/main.css">

    <script src="https://kit.fontawesome.com/7e1870387e.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <a class="logo" title="Homepage" href="index.php">
            <img src="assets/icon.png" alt="FeedTrac Icon" height="32">

            <h1>FeedTrac</h1>
        </a>

        <div class="header-right">
            <button title="Light Mode">
                <i class="fa-regular fa-lightbulb"></i>
            </button>

            <button title="Inbox">
                <i class="fa-solid fa-inbox"></i>
            </button>

            <a title="Profile" href="#">
                <img class="avatar" src="assets/avatar.jpg" alt="User Avatar" height="32">
            </a>
        </div>
    </div>

    <div class="main">
        <div class="list-header">
            <input class="search-bar" type="text" placeholder="Filter existing Feedback...">

            <button>New Feedback</button>
        </div>

        <table>
            <tr>
                <th>Status</th>
                <th>Priority</th>
                <th>Title</th>
                <th>Author</th>
                <th>Tags</th>
                <th>Engagement</th>
            </tr>
            <tr>
                <td><button>Open</button></td>
                <td><button>High</button></td>
                <td><a href="feedback.php">Lights keep flickering during lecture</a></td>
                <td><a href="#">Archie Baldry (26411141)</a></td>
                <td>
                    <button>CMP1010</button>
                    <button>Lecture</button>
                    <button>Room</button>
                    <button>Lighting</button>
                </td>
                <td>+69 (12 comments)</td>
            </tr>
            <tr>
                <td><button>Closed</button></td>
                <td><button>Medium</button></td>
                <td><a href="feedback.php">Example 2</a></td>
                <td><a href="#">Archie Baldry (26411141)</a></td>
                <td>
                    <button>CMP1010</button>
                    <button>Lecture</button>
                    <button>Room</button>
                    <button>Lighting</button>
                </td>
                <td>+69 (12 comments)</td>
            </tr>
            <tr>
                <td><button>Closed</button></td>
                <td><button>Low</button></td>
                <td><a href="feedback.php">Example 3</a></td>
                <td><a href="#">Archie Baldry (26411141)</a></td>
                <td>
                    <button>CMP1010</button>
                    <button>Lecture</button>
                    <button>Room</button>
                    <button>Lighting</button>
                </td>
                <td>+69 (12 comments)</td>
            </tr>
        </table>

        <div class="footer">
            <p>© 2024 The FeedTrac Team</p>

            <a href="#">Terms</a>

            <a href="#">Privacy</a>

            <a href="https://github.com/OSmith132/FeedTrac/">Source</a>

            <a href="#">Contact</a>
        </div>
    </div>

    <script src="scripts/main.js"></script>
</body>
</html>
