<div>
    <nav class="flex items-center bg-white w-full z-10 fixed uppercase font-semibold justify-between flex-col-reverse p-3 shadow">
        <div class="block lg:hidden">
            <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto right">
            <div class="text-sm lg:flex-grow">
                <a href="/" class="p-2 block mt-4 lg:inline-block lg:mt-0 mr-4">
                    Trang chủ
                </a>
                <a href="/mathang" class="p-2 block mt-4 lg:inline-block lg:mt-0 mr-4">
                    Sản phẩm
                </a>
                <a href="{{ route('trangchu.xemgiohang') }}" class=" p-2 block mt-4 lg:inline-block lg:mt-0 mr-4">
                    Xem giỏ hàng ({{ $soLuongHang }})
                </a>
            </div>
        </div>
    </nav>
</div>