class TheNavigation extends HTMLElement {
  visible = false;
  connectedCallback() {
    const isIndex = window.location.pathname.endsWith("index.php");

    const imgSrc = isIndex ? "./assets/imgs/logo_colored.png" : "../assets/imgs/logo_colored.png";

    this.innerHTML = `<navbar>
      <nav class="bg-white py-4">
        <div class="flex w-auto justify-between">
          <a href="/index.php" class="flex items-center">
            <img src="${imgSrc}" class="max-h-12 pl-8" />
          </a>

        <div class="w-auto">
          <ul class="flex flex-row items-center space-x-5 p-4 pr-10">
            <li class="group py-2">
              <a href="/products/products.php" class="hidden sm:inline font-semibold uppercase">Categories</a>

              <div id="menu" class="absolute inset-x-0 z-10 hidden group-hover:block pointer-events-none sm:pointer-events-auto">
                <div class="mt-10 bg-gray-300 px-20 sm: py-10 sm:py-6 pointer-events-auto">
                  <div class="mx-auto max-w-5xl">
                    <div class="grid grid-cols-1 sm:grid-cols-4 sm:space-x-10 space-y-5 sm:space-y-0 gap-0 items-center">
                      <div class="flex flex-col space-y-0 sm:space-y-1">
                        <p class="mb-2 text-2xl md:text-3xl font-semibold text-center sm:text-left text-yellow-800">Man</p>
                        <a href="/products/products.php" class="text-md md:text-xl text-center sm:text-left w-auto inline-block hover:text-yellow-800 ">Polo shirts</a>
                        <a href="/products/products.php" class="text-md md:text-xl text-center sm:text-left w-auto inline-block hover:text-yellow-800">Shirts</a>
                        <a href="/products/products.php" class="text-md md:text-xl text-center sm:text-left w-auto inline-block hover:text-yellow-800">Jeans</a>
                      </div>
                      <div class="flex flex-col justify-center sm:justify-start space-y-0 sm:space-y-1 m-0">
                        <p class="mb-2 text-2xl md:text-3xl font-semibold text-center sm:text-left text-yellow-800">Woman</p>
                        <a href="/products/products.php" class="text-md md:text-xl text-center sm:text-left hover:text-yellow-800">Shirts</a>
                        <a href="/products/products.php" class="text-md md:text-xl text-center sm:text-left hover:text-yellow-800">Dresses</a>
                        <a href="/products/products.php" class="text-md md:text-xl text-center sm:text-left hover:text-yellow-800">Skirts</a>
                      </div>
                      <div class="ml-10 col-span-2 hidden sm:block">
                        <img class="max-h-40 sm:max-h-56" src="../assets/imgs/navbar_image.png" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <div class="px-3">
              <div class="h-8 w-0.5 bg-yellow-800 text-3xl"></div>
            </div>

            <li class="py-2">
              <a href="/cart/cart-detail.php">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="h-6 w-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
              </a>
            </li>

            <li class="py-2">
              <a href="/user/log-in.php">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="h-6 w-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
              </a>
            </li>

            <button class="inline sm:hidden w-10 h-10 space-y-1" id="hamburgerButton">
              <div class="w-2/3 h-0.5 bg-black"></div>
              <div class="w-2/3 h-0.5 bg-black"></div>
              <div class="w-2/3 h-0.5 bg-black"></div>
            </button>
          </ul>
        </div>
      </div>
    </nav>
  </navbar>`;
    const button = this.querySelector('#hamburgerButton');
    const menu = this.querySelector('#menu');

    window.onresize = () => {
      if (window.innerWidth > 640 && this.visible) {
        this.visible = false;
        menu.classList.add('hidden');
      }
    };

    button.onclick = () => {
      if (this.visible) {
        menu.classList.add('hidden');
        this.visible = false;
      } else {
        menu.classList.remove('hidden');
        this.visible = true;
      }
    };
  }
}
class ArrowDown extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" />
  </svg>`;
  }
}

customElements.define('arrow-down', ArrowDown);
customElements.define('custom-navbar', TheNavigation);
