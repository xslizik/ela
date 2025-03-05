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
                <a href="/cart/cart-detail.php" class="hidden md:inline"><span
                        class="px-4 py-2 rounded-md bg-gray-100 mr-2">1</span>Cart</a>
                <a href="/cart/cart-detail.php" class="hidden md:inline"><span
                        class="px-4 py-2 rounded-md bg-gray-100 mr-2">2</span>Shipping Address</a>
                <a href="/cart/cart-detail.php"
                    class="text-black font-semibold flex flex-wrap gap-1 justify-center items-center md:inline-block"><span
                        class="px-4 py-2 rounded-md bg-[#BFA37E] mr-2">3<span class="inline md:hidden">.
                            Step</span></span><u class="text-center">Shipping and Payment
                        methods</u></a>
            </div>
        </section>

        <section class="mt-10 max-w-3xl mx-auto">
            <form>
                <fieldset>
                    <legend class="text-2xl py-5">Select your delivery method</legend>
                    <div class="flex justify-center">
                        <div>
                            <input class="bg-gray-100 p-2 inline" type="radio" id="courier" name="courier">
                            <label class="font-semibold" for="courier">Courier ... <span>EUR 8888</span></label>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="text-2xl py-5">Select your payment method</legend>
                    <div class="flex justify-center md:justify-around flex-col gap-5 md:gap-0 md:flex-row">
                        <div class="flex justify-center gap-1 flex-row ">
                            <input class="bg-gray-100 p-2" type="radio" id="cash" name="payment" value="cash">
                            <label class="font-semibold" for="cash">Cash on delivery</label>
                        </div>
                        <div class="flex justify-center gap-1 flex-row ">
                            <input class="bg-gray-100 p-2" type="radio" id="card" name="payment" value="card">
                            <label class="font-semibold" for="card">Card</label>
                        </div>
                        <div class="flex justify-center gap-1 flex-row ">
                            <input class="bg-gray-100 p-2" type="radio" id="bank" name="payment" value="bank">
                            <label class="font-semibold" for="bank">Bank transfer</label>
                        </div>
                    </div>
                </fieldset>

                <div class="w-full flex justify-center mt-5">
                    <input type="submit" value="Proceed"
                        class="bg-black w-[30%] min-w-[150px] text-white hover:bg-white hover:text-black hover:border-black border-2 border-white  px-6 py-2 text-center text-sm transition ease-in-out duration-100">
                </div>
            </form>
        </section>


</body>

</html>