<div>
    @livewire('trang-chu.header')
    <form >
        @csrf   
        <div class="max-w-md mx-auto rounded-lg md:max-w-7xl">
            <div class="col-span-2 p-5 "> 
                <table class="w-full text-sm lg:text-base mt-12" cellspacing="0">
                    <thead>
                      <tr class="h-6">
                        <th class="hidden p-2 md:table-cell"><h1 class="text-xl font-medium text-left">Giỏ hàng</h1></th>
                        <th class="text-left">Tên sản phẩm</th>
                        <th class="lg:text-right text-left pl-5 lg:pl-0">Số lượng</th>
                        <th class="hidden text-right md:table-cell">Đơn giá</th>
                        <th class="text-right  pr-2">Thành tiền</th>
                      </tr>
                    </thead>
                    <tbody>   
                        @forelse ($danhsachGioHang as $index => $giohang)
                            @if($loop->odd) 
                                <tr class="bg-gray-100 rounded"> 
                            @else
                                <tr> 
                            @endif 
                                <td class="hidden pb-4 md:table-cell p-2">
                                    <img src="{{ URL::asset('img/'.$giohang->HinhAnh) }}" class="max-h-10 w-20 rounded" alt="Thumbnail">
                                </td>
                                <td> 
                                    <p class="mb-2 ">{{ $giohang->TenMH}}</p> 
                                    <button type="button" wire:click="xoaHang({{ $giohang->id }})" class="text-blue-700 text-sm">Xóa</button>  
                                </td>
                                
                                <td class="justify-center md:justify-end md:flex mt-3">
                                    <div class="w-20 h-10">
                                        <div class="relative flex flex-row w-full h-8">
                                        <input type="number" min="1" wire:model="danhsachSoLuong.{{ $index }}"
                                            class="w-full rounded font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" />
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden text-right md:table-cell">
                                    <span class="text-sm lg:text-base font-medium">
                                    {{ money_format('%.0n', $giohang->GiaXuat) }}
                                    </span>
                                </td>
                                <td class="text-right pr-2">
                                    <span class="font-bold text-blue-500 lg:text-base font-medium">
                                        {{ money_format('%.0n', $giohang->GiaXuat * $danhsachSoLuong[$index]) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                          <tr>Chưa có mặt hàng nào trong giỏ.</tr>
                        @endforelse
                    </tbody>
                </table>  
                @json($danhsachSoLuong)
                <div class="my-4 mt-6 -mx-2 lg:flex">
                    <div class="lg:px-2 lg:w-1/2">
                      <div class="p-4 bg-gray-100 rounded">
                        <h1 class="ml-2 font-bold uppercase">Mã giảm giá</h1>
                      </div>
                      <div class="p-4">
                        <p class="mb-4 italic">Nhập mã khuyến mãi</p>
                        <div class="justify-center md:flex">
                          <form action="" method="POST">
                              <div class="flex items-center w-full h-10 pl-3 bg-white bg-gray-100 border rounded">
                                <input type="coupon" name="code" id="coupon" readonly placeholder="Tính năng chưa hoàn thành" 
                                    class="w-full bg-gray-100 outline-none appearance-none focus:outline-none active:outline-none"/> 
                              </div>
                          </form>
                        </div>
                      </div> 
                    </div>
                    <div class="lg:px-2 lg:w-1/2">
                      <div class="p-4 bg-gray-100 rounded">
                        <h1 class="ml-2 font-bold uppercase">Chi tiết đặt hàng</h1>
                      </div>
                      <div class="p-4"> 
                          <div class="flex justify-between border-b">
                            <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                              Tổng tiền hàng
                            </div>
                            <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                               {{ money_format('%.0n', $tienHang) }}
                            </div>
                          </div> 
                            <div class="flex justify-between pt-4 border-b">
                              <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                Giảm giá
                              </div>
                              <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                {{ money_format('%.0n', 0)}}
                              </div>
                            </div> 
                            <div class="flex justify-between pt-4 border-b">
                              <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                Tổng thanh toán
                              </div>
                              <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                {{ money_format('%.0n', $tienHang) }}
                              </div>
                            </div> 
                            <button type="button" wire:click="thanhtoan" class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                              <svg aria-hidden="true" data-prefix="far" data-icon="credit-card" class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"/></svg>
                              <span class="ml-2 mt-5px">Tiến hành đặt hàng</span>
                            </button>  
                      </div>
                    </div>
                  </div>
            </div>  
        </div>  
    </form>   
</div>
