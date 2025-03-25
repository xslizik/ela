<?php
require_once '../config/database.php';

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$email || !$password) {
        http_response_code(400); // Bad Request
        $errorMessage = "Error 400: Missing email or password.";
    } else {
        try {
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", "$db_user", "$db_password");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT password FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($password == $user['password']) {
                http_response_code(200);
                header("Location: /user/user-account.php");
                exit;
            } else {
                http_response_code(401); // Unauthorized
                $errorMessage = "Error 401: Wrong email or password.";
            }
        } catch (PDOException $e) {
            http_response_code(500); // Internal Server Error
            $errorMessage = "Error 500: Database error. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <script src="../js/components.js"></script>
    <script src="https://cdn.tailwindcss.com"></script> 
</head>

<body>
    <custom-navbar></custom-navbar>
    <div class="w-[80%] m-auto relative mt-5">
        <div class="flex justify-center items-center">
            <h1 class="text-4xl font-bold">Log in</h1>
        </div>
        <section class="mt-10 max-w-3xl mx-auto">
            <form class="w-full" action="/user/log-in.php" method="POST">

                <label class="font-semibold block mt-4" for="email">Email:</label>
                <input class="block w-full bg-gray-100 p-2" type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email ?? ''); ?>"><br>

                <label class="font-semibold block" for="password">Password:</label>
                <input class="block w-full bg-gray-100 p-2" type="password" id="password" name="password" required>

                <!-- Error message display -->
                <div id="errorMessage" class="text-red-500 text-sm text-center mt-2 hidden"><?php echo $errorMessage; ?></div>

                <div class="relative flex justify-center w-full mt-5 gap-4">
                    <label class="font-semibold block">Show Password:</label>
                    <input type="checkbox" id="showPasswordCheckBox" class="h-5 w-5 border-grey-300 rounded">
                </div>

                <div class="flex flex-col items-center justify-center gap-3 mt-5 w-full">
                    <input type="submit" value="Login"
                        class="bg-black text-white hover:bg-white hover:text-black hover:border-black px-6 py-2 border-2 border-gray-200 text-center text-md transition ease-in-out duration-100 w-full md:w-auto block">
                </div>
            </form>

            <div class="flex flex-col items-center justify-center gap-3 mt-3 w-full">
                <a href="/user/create-account.php">
                    <button
                        class="bg-white text-black hover:bg-gray-100 px-6 py-2 border-2 border-gray-200 text-center text-md transition ease-in-out duration-100 w-full md:w-auto block">
                        Create Account
                    </button>
                </a>
            </div>  
        </section>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const showPasswordCheckBox = document.getElementById('showPasswordCheckBox');
        const errorMessageDiv = document.getElementById('errorMessage');

        showPasswordCheckBox.oninput = () => {
            passwordInput.type = showPasswordCheckBox.checked ? 'text' : 'password';
        }

        // Show the error message if there is one
        if (errorMessageDiv.innerText.trim() !== "") {
            errorMessageDiv.classList.remove("hidden");
        }
    </script>
</body>
</html>