<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./Media/Icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/index.css">
    
    <title>Game Stars</title>
</head>
<body>
    <?php
        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log('.json_encode($output, JSON_HEX_TAG).');';
            if ($with_script_tags) {
                $js_code = '<script>'.$js_code.'</script>';
            }
            echo $js_code;
        }
    ?>

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
            <article id="game1" class="thumb_article" onclick="window.location.href = 'ratings.php';">
                <div class="labels">
                    <div class="infolabel">Review</div>
                    <div class="gamelabel">Forza Horizon 5</div>
                </div>
                <div class="title">Door Mexico rijden was nog nooit zo leuk!</div>
            </article>
            <article id="news_article">
                <div id="news_title">Nieuws</div>
                <div class="news_item">
                    <a href="#">Nieuwe merch drop!</a>
                </div>
                <div class="news_item">
                    <a href="#">GTA Online nieuwe DLC?</a>
                </div>
            </article>
        </section>
        <article id="row_title">
            <h3>Top 3 Reviews</h3>
        </article>
        <section id="toplist">
            <?php 
                function LoadTop($GamesData) {
                    while ($CurrentGame = $GamesData -> fetch_assoc()) {
                        echo '<article class="thumb_article_s" onclick="window.location.href = `ratings.php`;" style="background-image: url(' . $CurrentGame["Thumbnail"] . ');">
                                <div class="labels">
                                    <div class="infolabel">Review</div>
                                    <div class="gamelabel">' . $CurrentGame["Title"] . '</div>
                                </div>
                                <div class="title">Alle grote fouten nog steeds niet opgelost?</div>
                            </article>';
                    }
                }
            
                require("db.php");

                $sql = 'SELECT * FROM Games ORDER BY Stars DESC LIMIT 3';
                $result = $conn -> query($sql);
                if ($result and $result -> num_rows > 0) {
                    LoadTop($result);
                }
            ?>
        </section>
        <footer>
            <p>Copyright © GameStars 2021 | <a href="#">Disclaimer</a></p>
        </footer>
    </main>
</body>
</html>