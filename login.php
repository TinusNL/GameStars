<?php
    session_start();

    if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] == true) {
        header("Location: index.php");
    }

	$error = null;

	if (isset($_POST['submit'])) {
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		if (!isset($username) || empty($username)) {
			$error = "Gebruikersnaam is niet ingevuld";
		} else if (!isset($password) || empty($password)) {
			$error = "Wachtwoord is niet ingevuld";
		} else {
            require("db.php");

            $sql = "SELECT * FROM users WHERE Username = '" . $username . "'";
            
            if ($result = $conn -> query($sql)) {
                if ($result -> num_rows > 0) {
                    $row = $result -> fetch_assoc();

                    if (password_verify($password, $row['Password'])) {
                        $_SESSION['ingelogd'] = true;
                        header("Location: index.php");
                    } else {
                        $error = "Gebruikersnaam of Wachtwoord is onjuist";
                    }
                } else {
                    $error = "Gebruikersnaam is onjuist";
                }
            }

		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./Media/Icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./CSS/login.css">

    <title>Game Stars</title>
</head>
<body>
    <main>
        <img src="./Media/Logo.png" alt="Game Stars Logo" onclick="window.location.href = 'index.php';">
        <section>
            <form method="POST">
                <?php
                    if ($error) {
                        echo "<div id='warning'>$error</div>";
                    }
                ?>
                <label>Gebruikersnaam</label>
                <input type="text" name="username" placeholder="Gebruikersnaam" required>
                <label class="margin">Wachtwoord</label>
                <input type="password" name="password" placeholder="*******************" required>
                <div>
                    <table>
                        <tr>
                            <td class="td-left">
                                <input type="submit" name="submit" value="Log In">
                            </td>
                            <td class="td-right">
                                <a href="./index.php">Wachtwoord Vergeten?</a>
                            </td>
                        </tr>
                        <tr class="tr-small">
                            <td class="td-left">
                                <div></div>
                            </td>
                            <td class="td-right">
                                <a href="./signup.php">Account Maken</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </section>
    </main>
</body>
</html>