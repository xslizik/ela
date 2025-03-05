<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json');
        http_response_code(401);

        $response = [
            'success' => false,
            'message' => 'Wrong password'
        ];

        echo json_encode($response);
        exit;
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

                <label class="font-semibold block" for="email">Email:</label>
                <input class="block w-full bg-gray-100 p-2" type="email" id="email" name="email" required value=""><br>

                <label class="font-semibold block" for="password">Password:</label>
                <input class="block w-full bg-gray-100 p-2" type="password" id="password" name="password" required value="">

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
        const passwordInput = document.getElementById('password')
        const showPasswordCheckBox = document.getElementById('showPasswordCheckBox')

        showPasswordCheckBox.oninput = () => {
            passwordInput.type = showPasswordCheckBox.checked ? 'text' : 'password'
        }
    </script>

</body>
</html>