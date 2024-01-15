<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
		header('location: loggedin.php');
		exit;
}

require_once 'assets/dbhandler.php';

$username = $password = $username_err = $password_err = $login_err = '';

$accCheck = "SELECT * FROM `accounts`";
$accCheckQuery = mysqli_query($connection, $accCheck);
$accCheckResult = mysqli_num_rows($accCheckQuery);

if ($accCheckResult > 0) {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (empty(trim($_POST['username']))) {
			$username_err = 'Please enter username.';
		} else {
			$username = trim($_POST['username']);
		}
		
		if (empty(trim($_POST['password']))) {
			$password_err = 'Please enter your password.';
		} else {
			$password = trim($_POST['password']);
		}

		if (empty($username_err) && empty($password_err)) {
			$sql = "SELECT id, username, password, privilege, given_name, surname, is_done_voting FROM `accounts` WHERE username = ?";

			if ($stmt = mysqli_prepare($connection, $sql)) {
				mysqli_stmt_bind_param($stmt, "s", $param_username);

				$param_username = $username;
				if (mysqli_stmt_execute($stmt)) {
					mysqli_stmt_store_result($stmt);

					if (mysqli_stmt_num_rows($stmt) == 1) {
						mysqli_stmt_bind_result($stmt, $id, $username, $passwordDB, $privilege, $given_name, $surname, $is_done_voting);
            if(mysqli_stmt_fetch($stmt)) {
              if ($password == $passwordDB) {
                session_start();

                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['privilege'] = $privilege;
                $_SESSION['given_name'] = $given_name;
                $_SESSION['surname'] = $surname;
				$_SESSION['is_done_voting'] = $is_done_voting;


                header('location: loggedin.php');
              } else {
                $login_err = 'Invalid username or password.';
              }
            }
          } else {
            $login_err = 'Invalid username or password.';
          }
        } else {
          echo 'Oops! Something went wrong. Please try again later.';
        }

        mysqli_stmt_close($stmt);
      }
    }

    mysqli_close($connection);
  }
} else {
  header('location: register.php');
  exit;
}
?>

<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title><?php echo WEBSITE_TITLE ?></title>
			<link rel="stylesheet" href="assets/login.css">
			<link rel="preconnect" href="https://fonts.googleapis.com">
			<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
			<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
		</head>
		<body>
			<div class="form-box">
				
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> " autocomplete="off" method="post">
					<h2 class="form-h">Online Voting System</h2>
          
					<div class="content">
						<div class="input-box">
							<label for="username">Username</label><br>
							<input type="text" name="username" value="<?php echo $username; ?>" class="form-input" required>
						</div>
						<div class="input-box">
							<label for="password">Password</label><br>
							<input type="password" name="password" value="<?php echo $password; ?>" class="form-input" required>
						</div>
						<div class="button-container">
							<button type="submit" name="login" class="form-button">Login</button>
						</div>
					</div>
					<?php
            		if (!empty($login_err)) {
						echo '<div class="error">' . $login_err . '</div>';
            		}
					?>
				</form>
			</div>
		</body>
	</html>