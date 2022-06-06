<?php
    session_start();

    if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] == true) {
        header("Location: index.php");
    }

	$error = null;

	if (isset($_POST['submit'])) {
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$password2 = trim($_POST['password2']);

		if (!isset($username) || empty($username)) {
			$error = "Gebruikersnaam is niet ingevuld";
		} else if (!isset($password) || empty($password)) {
			$error = "Wachtwoord is niet ingevuld";
        } else if (!isset($password2) || empty($password2)) {
			$error = "Herhaal Wachtwoord is niet ingevuld";
        } else if ($password != $password2) {
			$error = "Wachtwoorden komen niet overeen";
		} else {
            require("db.php");

            $sql = "SELECT * FROM users WHERE Username = '" . $username . "'";
            
            if ($result = $conn -> query($sql)) {
                if ($result -> num_rows > 0) {
                    $error = "Gebruikersnaam is niet beschikbaar";
                } else {
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);

                    $sql = "INSERT INTO users (Username, Password) VALUES ('$username', '$passwordHash')";
                    $conn -> query($sql);
                    header("Location: login.php");
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
                <label class="margin">Herhaal Wachtwoord</label>
                <input type="password" name="password2" placeholder="*******************" required>
                <div>
                    <table>
                        <tr>
                            <td class="td-left">
                                <input type="submit" name="submit" value="Registreer">
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
                                <a href="./login.php">Inloggen</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </section>
    </main>
</body>
</html>