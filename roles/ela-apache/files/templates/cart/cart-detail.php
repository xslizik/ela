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
                <a href="/cart/cart-detail.php"
                    class="text-black font-semibold flex flex-wrap gap-1 justify-center items-center md:inline-block"><span
                        class="px-4 py-2 rounded-md bg-[#BFA37E] mr-2">1<span class="inline md:hidden">.
                            Step</span></span><u class="text-center">Cart</u></a>
                <a href="/cart/cart-detail.php" class="hidden md:inline"><span
                        class="px-4 py-2 rounded-md bg-gray-100 mr-2">2</span>Shipping Address</a>
                <a href="/cart/cart-detail.php" class="hidden md:inline"><span
                        class="px-4 py-2 rounded-md bg-gray-100 mr-2">3</span>Shipping and Payment methods</a>
            </div>
        </section>

        <section class="mt-10">
            <table class="table-fixed w-full gap-6">
                <thead class="hidden md:table-header-group">
                    <tr class="border-b-2 border-black">
                        <th></th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody class="[&>tr]:border-b-2 md:[&>tr]:border-none">
                    <tr>
                        <td class="h-[100px] py-2 w-[100px] md:w-auto">
                            <div class="h-[100px] flex justify-center"><img src="../../assets/imgs/cart-product.jpg"
                                    alt="cart-product-image" class="w-auto h-[100%]"></div>
                        </td>
                        <td class="text-center w-[80%] md:w-auto">
                            <div aria-label="amount-select" class="flex flex-col gap-1 justify-left">
                                <p>The Sliding Mr. Bones (Next Stop, Pottersville)</p>
                                <p class="md:hidden"><b>EUR 899999999</b></p>
                                <div aria-label="amount-select" class="md:hidden flex flex-row gap-4
                                    justify-center">
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

                            </div>
                        </td>
                        <td class="hidden md:table-cell">
                            <div aria-label="amount-select" class="flex flex-row gap-4 justify-center">
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
                        </td>
                        <td class="text-center hidden md:table-cell">EUR 899999999</td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr class="hidden md:table-row border-t-2 border-black">
                        <td colspan="3"></td>
                        <td class="text-center py-10 flex flex-wrap justify-center gap-1"><b>Total:</b><span>EUR
                                888888</span>
                        </td>
                    </tr>
                    <tr class="md:hidden border-t-2 border-black">
                        <td class="text-left py-10"><b>Total:</b></td>
                        <td class="text-right"><span>EUR 888888</span>
                        </td>
                    </tr>
                </tfoot>
            </table>

        </section>
        <section aria-label="buttons" class="flex flex-row justify-center md:justify-end gap-5">
            <button
                class="bg-white hover:bg-gray-100 px-5 py-2 border-2 border-gray-200 text-left text-sm transition ease-in-out duration-100">Link
                my account</button>
            <button
                class="bg-black text-white hover:bg-white hover:text-black  hover:border-black border-2 border-white  px-6 py-2 text-center text-sm transition ease-in-out duration-100">Enter
                shipping credentials</button>
        </section>


</body>

</html>