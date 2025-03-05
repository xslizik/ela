<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    if (!isset($_COOKIE['admin']) || $_COOKIE['admin'] !== 'true') {
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
            <h1 class="text-4xl font-bold">Admin</h1>
        </div>
        <section class="mt-10 max-w-3xl mx-auto">
            <form class="w-full ">
                <label class="font-semibold block" for="name">Name:</label>
                <input class="block w-full bg-gray-100 p-2" type="text" id="name" name="name" required><br>

                <label class="font-semibold block" for="text">Description:</label>
                <textarea class="block w-full min-h-[80px] resize-y h-[auto] bg-gray-100 p-2" id="description"
                    name="description" required></textarea><br>

                <div class="grid grid-cols-1 md:grid-cols-2 grid-flow-row gap-4 mt-2">
                    <select name="brands" alt="brand-selection-input"
                        class="bg-white p-3 w-full mx-auto border-2 border-gray-200 text-sm">
                        <option value="" disabled selected>Brand</option>
                        <option value="Gucci">Gucci</option>
                        <option value="Adidas">Adidas</option>
                        <option value="Versace">Versace</option>
                        <option value="Sandic">Sandic</option>
                    </select>
                    <select name="colors" alt="color-selection-input"
                        class="bg-white p-3 w-full mx-auto border-2 border-gray-200 text-sm">
                        <option value="" disabled selected>Color</option>
                        <option value="red">Red</option>
                        <option value="navy">Navy</option>
                        <option value="white">White</option>
                        <option value="black">Black</option>
                        <option value="yellow">Yellow</option>
                        <option value="green">Green</option>
                    </select>
                </div>
                <br>

                <div class="grid grid-cols-1 md:grid-cols-2 grid-flow-row gap-4 mt-2">
                    <input
                        class="font-semibold block w-full mb-5 text-sm text-black-900 border border-gray-200 cursor-pointer bg-gray-50"
                        id="image1" type="file">
                    <input
                        class="font-semibold block w-full mb-5 text-sm text-black-900 border border-gray-200 cursor-pointer bg-gray-50"
                        id="image2" type="file">
                </div>

                <label class="font-semibold block" for="quantity">Quantity:</label>
                <input class="block w-full bg-gray-100 p-2" type="number" id="quantity" name="quantity" min="1"
                    max="9999" required><br>

                <label class="font-semibold block" for="price">Price:</label>
                <input class="block w-full bg-gray-100 p-2" type="number" id="price" name="price" min="1"
                    max="999999999999" required><br>

                <div class="flex flex-col items-center justify-center gap-3 mt-5">
                    <input type="submit" value="Add item"
                        class="bg-black w-full md:w-auto text-white hover:bg-white hover:text-black hover:border-black px-6 py-2 mr-2 border-2 border-gray-200 text-center text-md transition ease-in-out duration-100">
                    <button
                        class="bg-white w-full md:w-auto text-black hover:bg-gray-100 px-6 py-2 mr-2 border-2 border-gray-200 text-center text-md transition ease-in-out duration-100">
                        Log Out
                    </button>
                </div>
            </form>
        </section>
    </div>

</body>

</html>