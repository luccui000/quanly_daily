<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>A simple, clean, and responsive HTML invoice template</title>

        <style>
            body {
                font-family: 'DejaVu Sans'
            } 

            .invoice-box table  {
                width: 100%;
                line-height: inherit;
                text-align: left;
            }
 
 
            .invoice-box h2 {
                text-align: center;
                text-transform: uppercase;
            } 
            .main_table thead tr {
                background-color: #ccc;
                padding: 0;  
            }
            .main_table thead tr th:nth-child(1) {
                border-top-left-radius: 4px;
                padding-left: 4px;
            } 
            .main_table thead tr th:nth-child(6) { 
                border-top-right-radius: 4px;
                text-align: right;
                padding-right: 4px;
            }
        </style>
    </head>

    <body> 
        <div class="invoice-box">
            <h2>{{  $tenphieu }}</h2> 
            <table>
                <tbody>
                    <td style="float: right; text-align: right;">
                        Mã PX: #{{ $phieuxuat->ma_phieu_xuat }}<br />
                        Ngày lập: {{ $phieuxuat->ngay_lap }}<br /> 
                        Nhân viên lập: {{ $phieuxuat->nhanvien->HoTenNV }}<br /> 
                    </td>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td style="width: 200px;">Khách Hàng: </td>
                        <td style="border-bottom: 1px dashed #ccc">{{ $phieuxuat->khachhang->HoTenKH}}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Địa chỉ: </td>
                        <td style="border-bottom: 1px dashed #ccc"> {{ $phieuxuat->khachhang->DiaChi}}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Số điện thoại: </td>
                        <td style="border-bottom: 1px dashed #ccc">{{ $phieuxuat->khachhang->DienThoai}}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Phương thức thanh toán: </td>
                        <td style="border-bottom: 1px dashed #ccc">{{ $phieuxuat->ten_hinh_thuc_thanh_toan }}</td>
                    </tr>
                </tbody> 
            </table> 
            <table style="margin-top: 20px; border-spacing: 0; padding: 1px;" class="main_table" > 
                <thead>
                    <tr> 
                        <th style="width: 400px;" >Tên MH</th>
                        <th >Số lượng</th>
                        <th >Đơn giá</th> 
                        <th >Giảm giá</th> 
                        <th>Thành tiền</th>
                    </tr> 
                </thead>
                <tbody>  
                    @foreach ($phieuxuat->mathang as $item)
                        <tr> 
                            <td style="width: 400px;">{{ $item->TenMH}}</td>
                            <td style="width: 90px; text-align: center">{{ $item->pivot->SoLuong}}</td>
                            <td style="text-align: right; font-size: 15px">{{ money_format('%.0n', $item->pivot->DonGia )}}</td>  
                            <td style="text-align: right;font-size: 15px">{{ money_format('%.0n', $item->pivot->TienChietKhau )}}</td>  
                            <td style="text-align: right ;font-size: 15px">{{ money_format('%.0n', $item->pivot->ThanhTien )}}</td>  
                        </tr>
                    @endforeach    
                </tbody>
            </table>
            <table style="margin-top: 10px;">
                <tbody>
                    <tr>
                        <td></td>
                        <td style="border-top: 1px solid #ccc"></td>
                    </tr>
                    <tr>
                        <td style="width: 300px;"></td>
                        <td>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Tổng Tiền Hàng</td>
                                        <td style="text-align: right;">{{ money_format('%.0n', $phieuxuat->TongTien )}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tổng VAT</td> 
                                        <td style="text-align: right;">{{ money_format('%.0n', $phieuxuat->TongVAT )}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tổng VAT</td> 
                                        <td style="text-align: right;">{{ money_format('%.0n', $phieuxuat->TongChietKhau )}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tổng giá trị đơn hàng </td> 
                                        <td style="text-align: right; font-weight: bold;">{{ money_format('%.0n', $phieuxuat->TongThanhToan )}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="text-align: right; margin-top: 20px;">
                                <tbody>
                                    <tr>
                                        <td>Nguời lập phiếu</td>
                                    </tr>
                                    <tr >
                                        <td style="height: 40px;"></td>
                                    </tr>
                                    <tr>
                                        <td >{{ $phieuxuat->nhanvien->HoTenNV }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>