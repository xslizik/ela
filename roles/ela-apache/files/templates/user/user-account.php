<?php
    session_start();

    if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
        if (!isset($_COOKIE['user']) || $_COOKIE['user'] !== 'true') {
            http_response_code(403); 
            echo "Access Denied: You do not have permission to view this page.";
            exit();
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
            <h1 class="text-4xl font-bold text-center">Account Information</h1>
        </div>

        <section class="mt-10 w-max-3xl mx-auto">
            <form class="w-full ">
                <label class="font-semibold block" for="name">Name:</label>
                <input class="block w-full bg-gray-100 p-2" type="text" id="name" name="name" placeholder="John Doe"
                    required><br>

                <label class="font-semibold block" for="email">Email:</label>
                <input class="block w-full bg-gray-100 p-2" type="email" id="email" name="email"
                    placeholder="johndoe@mail.com" required><br>

                <label class="font-semibold block" for="password">Password:</label>
                <input class="block w-full bg-gray-100 p-2" type="text" id="password" name="password" placeholder="1234"
                    required><br>

                <div class="flex flex-col md:flex-row gap-2 w-full flex-grow">
                    <div>
                        <label class="font-semibold block" for="town">Town:</label>
                        <input class="block w-full md:min-w-[400px] bg-gray-100 p-2" type="text" id="town" name="town"
                            placeholder="Bratislava"><br>
                    </div>
                    <div class="w-full">
                        <label class="font-semibold" for="zip">ZIP:</label>
                        <input class="block w-full bg-gray-100 p-2" type="text" type="text" id="zip" name="zip"
                            placeholder="97404"><br>
                    </div>
                </div>
                <label class="font-semibold block" for="street">Street Address:</label>
                <input class="block w-full bg-gray-100 p-2" type="text" id="street" name="street"
                    placeholder="Hlavna 14">

                <div class="w-full flex flex-col md:flex-row justify-center mt-5">
                    <button type="button"
                        class="bg-white w-full min-w-[150px] md:w-auto text-black hover:bg-gray-100 px-6 py-2 mr-2 border-2 border-gray-200 text-center text-md transition ease-in-out duration-100">Log
                        Out</button>
                    <input type="submit" value="Change"
                        class="bg-black min-w-[150px] text-white hover:bg-white hover:text-black hover:border-black border-2 border-white px-6 py-2 text-center text-md transition ease-in-out duration-100">

                </div>
            </form>
        </section>
    </div>


</body>

</html>