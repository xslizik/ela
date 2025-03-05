<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json');
        http_response_code(501);

        $response = [
            'success' => false,
            'message' => 'Not implemented'
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
            <h1 class="text-4xl font-bold">Register</h1>
        </div>
        <section class="mt-10 max-w-3xl mx-auto">
            <form class="w-full" action="/user/create-account.php" method="POST">
                <label class="font-semibold block" for="name">Name:</label>
                <input class="block w-full  bg-gray-100 p-2" type="text" id="name" name="name" required><br>

                <label class="font-semibold block" for="email">Email:</label>
                <input class="block w-full  bg-gray-100 p-2" type="email" id="email" name="email" required><br>

                <label class="font-semibold block" for="password">Password:</label>
                <input class="block w-full  bg-gray-100 p-2" type="password" id="password" name="password" required><br>

                <div class="flex flex-col md:flex-row gap-2 w-full flex-grow">
                    <div>
                        <label class="font-semibold block" for="town">Town:</label>
                        <input class="block w-full md:min-w-[400px] bg-gray-100 p-2" type="text" id="town"
                            name="town"><br>
                    </div>
                    <div class="w-full">
                        <label class="font-semibold" for="zip">ZIP:</label>
                        <input class="block w-full bg-gray-100 p-2" type="text" type="text" id="zip" name="zip"><br>
                    </div>
                </div>
                <label class="font-semibold block" for="street">Street Address:</label>
                <input class="block w-full  bg-gray-100 p-2" type="text" id="street" name="street">

                <div class="w-full flex justify-center mt-5">
                    <input type="submit" value="Proceed"
                        class="bg-black w-[30%] min-w-[150px] text-white hover:bg-white hover:text-black  hover:border-black border-2 border-white  px-6 py-2 text-center text-md transition ease-in-out duration-100">
                </div>
            </form>
        </section>
    </div>


</body>

</html>