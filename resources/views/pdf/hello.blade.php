<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>A simple, clean, and responsive HTML invoice template</title>

        <style>
            body {
                font-family: 'DejaVu Sans'
            }
            .invoice-box {
                max-width: 100%;
                margin: auto;
                padding: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                font-size: 16px;
                line-height: 24px; 
                color: #555;
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
            <h2>Phiếu nhập kho</h2> 
            <table>
                <tbody>
                    <td style="float: right; text-align: right;">
                        Mã PN #: 123<br />
                        Ngày lập: 23/01/2000<br /> 
                        Nhân viên lập: Lực Cui<br /> 
                    </td>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td style="max-width: 70px;">Nhà cung cấp</td>
                        <td style="border-bottom: 1px dashed #ccc">Công ty cổ phần Hoàng Anh Gia Lai</td>
                    </tr>
                    <tr>
                        <td style="max-width: 70px">Địa chỉ: </td>
                        <td style="border-bottom: 1px dashed #ccc"> Tầng 8, Tòa nhà Sannam, số 78 Duy Tân, Dịch Vọng Hậu, Cầu Giấy, Hà Nội</td>
                    </tr>
                    <tr>
                        <td style="max-width: 70px">Số điện thoại: </td>
                        <td style="border-bottom: 1px dashed #ccc">024366880205</td>
                    </tr>
                </tbody> 
            </table> 
            <table style="margin-top: 20px; border-spacing: 0; padding: 1px;" class="main_table" > 
                <thead>
                    <tr>
                        <th >Mã MH</th>
                        <th >Tên MH</th>
                        <th >Số lượng</th>
                        <th >Đơn giá</th> 
                        <th >Giảm giá</th> 
                        <th>Thành tiền</th>
                    </tr>
                    
                </thead>
                <tbody>  
                    <tr>
                        <td>001</td>
                        <td style="float: left; width: 150px">Xiaomi</td>
                        <td>1</td>
                        <td>3.000.000đ</td>  
                        <td>0đ</td>  
                        <td style="float: right;">3.000.000đ</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td style="float: left; width: 150px">Lorem ipsum dolor sit amet,</td>
                        <td>1</td>
                        <td>3.000.000đ</td>  
                        <td>0đ</td>  
                        <td style="float: right;">3.000.000đ</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td style="float: left; width: 150px">Xiaomi</td>
                        <td>1</td>
                        <td>3.000.000đ</td>  
                        <td>0đ</td>  
                        <td style="float: right;">3.000.000đ</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td style="float: left; width: 150px">Xiaomi</td>
                        <td>1</td>
                        <td>3.000.000đ</td>  
                        <td>0đ</td>  
                        <td style="float: right;">3.000.000đ</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td style="float: left; width: 150px">Xiaomi</td>
                        <td>1</td>
                        <td>3.000.000đ</td>  
                        <td>0đ</td>  
                        <td style="float: right;">3.000.000đ</td>
                    </tr> 
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
                                        <td>Tổng VAT</td>
                                        <td style="text-align: right;">0đ</td>
                                    </tr>
                                    <tr>
                                        <td>Tổng VAT</td>
                                        <td style="text-align: right;">1.000.000đ</td>
                                    </tr>
                                    <tr>
                                        <td>Tổng thanh toán</td>
                                        <td style="text-align: right;">10.000.000đ</td>
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
                                        <td > Nguyễn Văn Hạnh</td>
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