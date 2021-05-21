<div> 
    <nav class="flex items-center justify-between fixed z-10 w-full bg-white flex-wrap bg-teal p-4 shadow">
        <div class="flex items-center flex-no-shrink text-gray-700 mr-6">
          <svg class="h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg>
          <span class="font-semibold text-xl tracking-tight">QLCH</span>
        </div>
        <div class="block lg:hidden">
          <button class="flex items-center px-3 py-2 border rounded text-teal-lighter border-teal-light hover:text-green-600 hover:border-white">
            <svg class="h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
          </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
          <div class="text-sm lg:flex-grow">
            <a href="/" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-green-600 mr-4">
                Trang chủ
            </a>
            <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-green-600 mr-4">
                Sản phẩm
            </a>
            <a href="{{ route('trangchu.xemgiohang') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-green-600">
                Xem giỏ hàng ({{ $soLuongHang }})
            </a>
          </div>
          <div>
              <a href="{{ route('khachhang.dangnhap') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-gray-600 border-gray-200 hover:border-transperent hover:text-white hover:bg-green-400 mt-4 lg:mt-0">Đăng nhập</a>
            <a href="{{ route('khachhang.dangky') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded border-transperent text-white bg-green-400 hover:bg-green-300 mt-4 lg:mt-0">Đăng ký</a>
          </div>
        </div>
    </nav>
</div>