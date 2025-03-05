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
        <section>
            <div id="breadcrumbs"
                class="flex flex-row justify-around md:[&>a:not(:last-child)]:after:content-['->'] text-2xl md:text-base text-gray-400">
                <a href="#" class="hidden md:inline"><span
                        class="px-4 py-2 rounded-md bg-gray-100 mr-2">1</span>Cart</a>
                <a href="#"
                    class="text-black font-semibold flex flex-wrap gap-1 justify-center items-center md:inline-block"><span
                        class="px-4 py-2 rounded-md bg-[#BFA37E] mr-2">2<span class="inline md:hidden">.
                            Step</span></span><u class="text-center">Shipping Address</u></a>
                <a href="#" class="hidden md:inline"><span
                        class="px-4 py-2 rounded-md bg-gray-100 mr-2">3</span>Shipping and Payment methods</a>
            </div>
        </section>

        <section class="mt-10 max-w-3xl mx-auto">
            <form class="w-full">
                <label class="font-semibold block" for="name">Name:</label>
                <input class="block w-full  bg-gray-100 p-2" type="text" id="name" name="name" required><br>

                <label class="font-semibold block" for="email">Email:</label>
                <input class="block w-full  bg-gray-100 p-2" type="email" id="email" name="email" required><br>


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


</body>

</html>