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
    <div class="w-[70%] m-auto relative">
        <section>
            <div id="breadcrumbs"
                class="flex flex-row [&>a:not(:last-child)]:after:content-['>'] text-2xl text-gray-400 [&>*:last-child]:text-black [&>*:last-child]:font-semibold [&>*:last-child]:underline">
                <a href="/products/products.php">Women</a>
                <a href="/products/products.php">Dress</a>
            </div>
            <div class="w-full flex justify-center flex-col">
                <input type="text" alt="search-bar" placeholder="Search"
                    class="bg-gray-100 p-2 w-full md:w-[50%] mx-auto m-3">
                <div class="grid sm:grid-cols-2 md:grid-cols-4 grid-flow-row gap-4 mt-2">

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
                    <button class="bg-white p-3 w-full mx-auto border-2 border-gray-200 text-left text-sm">Price from -
                        to</button>
                    <select name="sort-by" alt="sort-by-selection-input"
                        class="bg-white p-3 w-full mx-auto border-2 border-gray-200 text-sm">
                        <option value="" disabled selected>Sort by</option>
                        <option value="price-asc" class="after:contents-['^']">price ^</option>
                        <option value="price-desc">price-desc</option>
                        <option value="title-asc">title</option>
                        <option value="title-desc">title-desc</option>

                    </select>
                </div>
            </div>
            <div class="flex flex-row flex-wrap mt-2 gap-2">
                <span>Active filters:</span>
                <button
                    class="bg-gray-100 hover:bg-gray-200 px-4 py-1 rounded-full text-left text-sm group inline-block transition ease-in-out whitespace-nowrap">Filter
                    1 <span class="hidden group-hover:inline transition ease-in-out delay-300">X</span>
                </button>
                <button
                    class="bg-gray-100 hover:bg-gray-200 px-4 py-1 rounded-full text-left text-sm group inline-block transition ease-in-out whitespace-nowrap">Filter
                    2 <span class="hidden group-hover:inline transition ease-in-out delay-300">X</span>
                </button>
                <button
                    class="bg-gray-100 hover:bg-gray-200 px-4 py-1 rounded-full text-left text-sm group inline-block transition ease-in-out whitespace-nowrap">Filter
                    2 <span class="hidden group-hover:inline transition ease-in-out delay-300">X</span>
                </button>
                <button
                    class="bg-gray-100 hover:bg-gray-200 px-4 py-1 rounded-full text-left text-sm group inline-block transition ease-in-out whitespace-nowrap">Filter
                    2 <span class="hidden group-hover:inline transition ease-in-out delay-300">X</span>
                </button>
            </div>
        </section>
        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 grid-flow-row gap-4 mt-12 ">
            <a href="/products/product-detail.php" class="w-full">
                <div aria-label="product-card"
                    class="w-full flex flex-col border-[#BFA37E] border-2 justify-center text-center hover:bg-gray-100 transition ease-in-out cursor-pointer">
                    <img src="../assets/imgs/product.jpg" alt="product-image">
                    <div class="text-center py-3">
                        <h4>Product Title</h4>
                        <h4>8888.99€</h4>
                    </div>
                </div>
            </a>
            <a href="/products/product-detail.php" class="w-full">
                <div aria-label="product-card"
                    class="w-full flex flex-col border-[#BFA37E] border-2 justify-center text-center hover:bg-gray-100 transition ease-in-out cursor-pointer">
                    <img src="../assets/imgs/product.jpg" alt="product-image">
                    <div class="text-center py-3">
                        <h4>Product Title</h4>
                        <h4>8888.99€</h4>
                    </div>
                </div>
            </a>
            <a href="/products/product-detail.php" class="w-full">
                <div aria-label="product-card"
                    class="w-full flex flex-col border-[#BFA37E] border-2 justify-center text-center hover:bg-gray-100 transition ease-in-out cursor-pointer">
                    <img src="../assets/imgs/product.jpg" alt="product-image">
                    <div class="text-center py-3">
                        <h4>Product Title</h4>
                        <h4>8888.99€</h4>
                    </div>
                </div>
            </a>
            <a href="/products/product-detail.php" class="w-full">
                <div aria-label="product-card"
                    class="w-full flex flex-col border-[#BFA37E] border-2 justify-center text-center hover:bg-gray-100 transition ease-in-out cursor-pointer">
                    <img src="../assets/imgs/product.jpg" alt="product-image">
                    <div class="text-center py-3">
                        <h4>Product Title</h4>
                        <h4>8888.99€</h4>
                    </div>
                </div>
            </a>
        </section>
        <section class="flex justify-center  py-10 md:px-10">
            <button
                class="bg-white w-full md:w-auto hover:bg-gray-100 px-5 py-2 text-center mx-auto border-2 border-gray-200 text-sm transition ease-in-out duration-100">Load
                more</button>
        </section>

    </div>
</body>

</html>