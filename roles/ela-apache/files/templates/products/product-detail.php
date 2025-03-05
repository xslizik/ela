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
    <div class="flex justify-center">
        <div class="w-[70%] pb-20">
            <section>
                <div id="breadcrumbs"
                    class="flex flex-row [&>a:not(:last-child)]:after:content-['>'] text-2xl text-gray-400 [&>*:last-child]:text-black [&>*:last-child]:font-semibold [&>*:last-child]:underline">
                    <a href="/products/products.php">Women</a>
                    <a href="/products/products.php">Dress</a>
                    <a href="/products/products.php" class="whitespace-nowrap overflow-hidden text-ellipsis">Kucci dress premium</a>
                </div>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-2 grid-flow-row gap-4 mt-12 ">
                <div aria-label="product-image" class="w-full">
                    <img src="../assets/imgs/product.jpg" alt="product-image">
                </div>
                <div class="flex items-center ">
                    <div class="flex flex-col gap-4">
                        <h2 class="sm:text-3xl lg:text-5xl">Product title</h2>
                        <h4 class="sm:text-xl lg:text-2xl">EUR 899999,99</h4>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta fugiat nisi architecto
                            debitis!
                            Aliquam, nostrum. Ipsam eius, maiores dolorum quasi qui fuga maxime facilis? Dolorum quod
                            voluptas
                            totam sequi ut.</p>
                        <div aria-label="color-selection" class="flex flex-row gap-1 flex-wrap [&>*]:m-0">
                            <span class="border-2 border-gray-100 py-2 px-6 inline-block text-sm">
                                In stock: 1000
                            </span>
                            <button
                                class="bg-white hover:bg-gray-100 px-6 py-2 mx-auto border-2 border-gray-200 text-left text-sm transition ease-in-out duration-100">Red</button>
                            <button
                                class="bg-white hover:bg-gray-100 px-6 py-2 mx-auto border-2 border-gray-200 text-left text-sm transition ease-in-out duration-100">Navy</button>
                            <button
                                class="bg-white hover:bg-gray-100 px-6 py-2 mx-auto border-2 border-gray-200 text-left text-sm transition ease-in-out duration-100">Navy</button>
                            <button
                                class="bg-white hover:bg-gray-100 px-6 py-2 mx-auto border-2 border-gray-200 text-left text-sm transition ease-in-out duration-100">Navy</button>
                        </div>
                        <div aria-label="amount-and-add-to-cart-section"
                            class="flex flex-col md:flex-row items-center justify-center gap-2 md:gap-10 md:ml-5">
                            <p class="md:hidden">Amount</p>
                            <div aria-label="amount-select" class="flex flex-row gap-4 ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>1</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>



                            </div>
                            <button
                                class="w-full bg-black text-white hover:bg-white  hover:text-black  hover:border-black border-2 border-white  px-6 py-2 text-chitespace-nowrapenter text-sm transition ease-in-out duration-100">Add
                                to cart</button>
                        </div>
                    </div>
                </div>
            </section>

        </div>

</body>

</html>