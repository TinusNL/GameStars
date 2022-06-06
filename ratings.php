<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./Media/Icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/ratings.css">
    
    <title>Game Stars</title>
</head>
<body>
    <main>
        <header id="header1">
            <img id="logo" src="./Media/Logo.png" alt="Game Stars Logo" onclick="window.location.href = 'index.php';">
            <div class="spacer"></div>
            <div id="socials">
                <a href="#" id="facebook"></a>
                <a href="#" id="twitter"></a>
                <a href="#" id="youtube"></a>
                <a href="#" id="instagram"></a>
            </div>
            <div id="account">
                <?php
                    session_start();

                    if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] == true) {
                        echo '<form action="./logout.php"> <input type="submit" value="Logout"> </form>';
                    } else {
                        echo '<form action="./login.php"> <input type="submit" value="Login"> </form>';
                    }
                ?>
            </div>
        </header>
        <header id="header2">
            <a href="./index.php">Home</a>
            <a href="./ratings.php">Ratings</a>
            <a href="#">Reviews</a>
            <a href="#">Merch</a>
            <a href="#">About Us</a>
            <a href="#">Contact</a>
        </header>
        <section>
            <article id="search_article">
                <form method="POST">
                    <div id="searchbox">
                        <input type="text" name="search" placeholder="Zoeken..." value="<?php if (isset($_POST["search"])) { echo $_POST["search"]; } ?>">
                        <div>
                            <input type="submit" value="">
                        </div>
                    </div>
                </form>
                <div id="platform">
                    <div id="platform_title">Platforms</div>
                    <div id="platform_options">
                        <a href="./ratings.php?platform=windows">Windows</a>
                        <a href="./ratings.php?platform=ps3">Playstation 3</a>
                        <a href="./ratings.php?platform=ps4">Playstation 4</a>
                        <a href="./ratings.php?platform=ps5">Playstation 5</a>
                        <a href="./ratings.php?platform=xbox-360">Xbox 360</a>
                        <a href="./ratings.php?platform=xbox-one">Xbox One</a>
                        <a href="./ratings.php?platform=xbox-series">Xbox Series SIX</a>
                        <a href="./ratings.php?platform=wii">Wii U</a>
                        <a href="./ratings.php?platform=switch">Nintento Switch</a>
                    </div>
                </div>
            </article>
            <article id="result_article">
                <?php 
                    function LoadGames($GamesData) {
                        while ($CurrentGame = $GamesData -> fetch_assoc()) {
                            $StarNumber = floor($CurrentGame["Stars"]);
                            $StarsAdded = 0;
                            $Stars = '';

                            for ($Index = 1; $Index <= $StarNumber; $Index++) { 
                                $StarsAdded++;
                                $Stars = $Stars . '<img src="./Media/Stars/Star2.png" alt="Star">';
                            }

                            if ($CurrentGame["Stars"] > $StarNumber) {
                                $StarsAdded++;
                                $Stars = $Stars . '<img src="./Media/Stars/Star3.png" alt="Star">'; 
                            }

                            while ($StarsAdded < 5) {
                                $StarsAdded++;
                                $Stars = $Stars . '<img src="./Media/Stars/Star1.png" alt="Star">'; 
                            }

                            echo '<div class="result_box">
                                    <img src="' . $CurrentGame["Thumbnail"] . '" alt="Game Thumbnail">
                                    <div>
                                        <h2>' . $CurrentGame["Title"] . '</h2>
                                        <div class="stars">' . $Stars . '</div>
                                    </div>
                                </div>';
                        }
                    }

                    require("db.php");

                    $sql = 'SELECT * FROM Games';

                    $url = basename($_SERVER['REQUEST_URI']);;
                    $res = parse_url($url);

                    if (array_key_exists("query", $res)) {
                        parse_str($res["query"], $params);

                        if (array_key_exists("platform", $params)) {
                            $sql = 'SELECT * FROM Games WHERE Platforms LIKE "%' . $params["platform"] . '%"';

                            echo '<script> let button = document.querySelectorAll(`a[href="./ratings.php?platform=' . $params["platform"] . '"]`)[0]; button.style.backgroundColor = "rgb(0, 221, 221)";</script>';
                        }
                    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $sql = 'SELECT * FROM Games WHERE Title LIKE "%' . $_POST["search"] . '%"';
                    }

                    $result = $conn -> query($sql);
                    if ($result and $result -> num_rows > 0) {
                        LoadGames($result);
                    } else {
                        echo '<div class="result_box noresult"> <h2>Er zijn geen resultaten gevonden!</h2> </div>';
                    }
                ?>
            </article>
        </section>
        <footer>
            <p>Copyright © GameStars 2021 | <a href="./disclaimer.html">Disclaimer</a></p>
        </footer>
    </main>
</body>
</html>