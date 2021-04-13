Table CHUC_VU {
  "ID_CV" integer [not null, increment]
  "TenChucVu" nvarchar(50)
  "CapBac" integer
  "MoTa" nvarchar(250)

  Indexes {
    ID_CV [pk]
  }
}
  
Table NHAN_VIEN { 
  "ID_NV" integer  [not null, increment]
  "MaNhanVien" varchar(10) 
  "HoTenNhanVien" nvarchar(70) 
  "DienThoai" nvarchar(11)
  "DiaChi" nvarchar(100)
  "NgaySinh" date
  "GioiTinh" nvarchar(5)
  "Email" nvarchar(50)
  "TrangThai" TrangThai
  "ID_CV" integer [ref: < CHUC_VU.ID_CV]
  Indexes {
    "ID_NV" [pk]
  }
}

Table NGUOIDUNG_VAITRO {
  ID_ND numeric(18, 0) [ref: < NGUOIDUNG.ID_ND]
  ID_VT numeric(18, 0) [ref: < VAITRO.ID_VT]
}
Table VAITRO {
  ID_VT varchar(10)
  TenVT varchar(50)
  MoTa varchar(100)
}

Table NGUOIDUNG {
  "ID_ND" integer [not null, increment]
  "TenDangNhap" varchar(30) [not null]
  "MatKhau" varchar(255) [not null]
  "LanDangNhapCuoi" datetime
  "TrangThai" integer
}
Table CHITIET_KIEMKE {
  "ID_PKK" integer [not null]
  "ID_MH" integer [not null ]  
  "SoLuongThucTe" double
  "SoLuongThieu" double
  "SoLuongThua" double
  "DonGia" double 
  "GhiChu" text

  Indexes {
    (ID_PKK, ID_MH) [pk]
  }
}
Ref: CHITIET_KIEMKE.ID_MH > MAT_HANG.ID_MH

Table CHITIET_PHIEUHANG {
  "ID_CTPH" integer [not null, increment]
  "ID_PH" integer [not null, ref: < PHIEU_HANG.ID_PH] 
  "ID_MH" integer [ref: < MAT_HANG.ID_MH]
  "SoLuong" double 
  "GiaVon" double
  "GiaXuat" double
  "DonGia" double
  "PT_VAT" double
  "Tien_VAT" double
  "PT_ChieuKhau" double
  "Tien_ChietKhau" double
  "ThanhTien" double

  Indexes {
    ID_CTPH [pk]
  }
}

Table DON_VI_TINH {
  "ID_DVT" integer [not null, increment]
  "MaDonViTinh" nvarchar(10)
  "TenDonViTinh" nvarchar(50)
  "MoTa" nvarchar(500)

  Indexes {
    ID_DVT [pk]
  }
}

Table KHACH_HANG {
  "ID_KH" integer [not null, increment]

  "MaKhachHang" nvarchar(10)
  "TenKhachHang" nvarchar(100) 
  "DiaChi" nvarchar(100)
  "DienThoai" nvarchar(50)
  "Email" nvarchar(50) 
  "MaSoThue" nvarchar(50)
  "SoTaiKhoan" nvarchar(100)

  Indexes {
    ID_KH [pk]
  }
}

Table KHO {
  "ID_KHO" integer [not null, increment]

  "MaKho" nvarchar(10)
  "TenKho" nvarchar(50)
  "DiaChi" nvarchar(100)

  Indexes {
    ID_KHO [pk]
  }
}

Table LOAI_MAT_HANG {
  "ID_LoaiMH" integer [not null, increment]
  "MaLoaiMH" nvarchar(10)
  "TenLoaiMatHang" nvarchar(100)
  "MoTa" nvarchar(100)

  Indexes {
    ID_LoaiMH [pk]
  }
}

Table NHA_CUNG_CAP {
  "ID_NCC" integer [not null, increment]

  "MaNhaCungCap" nvarchar(10)
  "TenNhaCungCap" nvarchar(100)
  "DiaChi" nvarchar(100)
  "DienThoai" nvarchar(11)
  "Fax" nvarchar(50)
  "Email" nvarchar(50)
  "MaSoThue" nvarchar(30)
  "SoTaiKhoan" nvarchar(30)

  Indexes {
    ID_NCC [pk]
  }
}
  
enum HinhThucThanhToan {
  thanh_toan_khi_nhan_hang
  chuyen_khoan
  thanh_toan_bu_tru 
}
Table PHIEU_HANG {
  "ID_PH" integer [not null, increment]
  "SoPhieu" nvarchar(50)
  "NgayLap" datetime
  "MaNhanVien" integer [ref: < NHAN_VIEN.MaNhanVien]
  "ID_NCC" integer [ref: < NHA_CUNG_CAP.ID_NCC]
  "ID_KH" integer [ref: < KHACH_HANG.ID_KH]
  "ID_KHO" integer [ref: < KHO.ID_KHO] 
  "MoTa" nvarchar(100)
  "LyDo" text
  "TongTien" double
  "Tong_VAT" double
  "Tong_ChietKhau" double
  "Tong_ThanhToan" double
  "HinhThucThanhToan" HinhThucThanhToan 
  "TrangThai" integer  

  Indexes {
    ID_PH [pk]
  }
}

Table PHIEU_KIEM_KE {
  "ID_PKK" integer [not null, increment]

  "MaPhieuKiemKe" nvarchar(50)
  "NgayLap" datetime
  "ID_NV" integer [ref: < NHAN_VIEN.ID_NV]
  "ID_KHO" integer [ref: < KHO.ID_KHO]
  "MoTa" nvarchar(100) 

  Indexes {
    ID_PKK [pk]
  }
}

Table PHIEUXUAT {
  "ID_PX" integer [not null, increment] 

  "MaPhieuXuat" nvarchar(10) 
  "ID_PH" integer [ref: < PHIEU_HANG.ID_PH]
  "NgayLap" datetime
  "ChungTuKemTheo" nvarchar(100)
  "MaNhanVien" integer [ref: < NHAN_VIEN.MaNhanVien] 
  "ID_NCC" integer [ref: < NHA_CUNG_CAP.ID_NCC]
  "ID_KH" integer [ref: < KHACH_HANG.ID_KH]
  "MoTa" nvarchar(100)
  "NguoiGiaoNhan" nvarchar(100) [null]
  "TongTien" double
  "HinhThucThanhToan" HinhThucThanhToan

  Indexes {
    ID_PX [pk]
  }
}

Table MAT_HANG {
  "ID_MH" integer [not null, increment]
  "MaMatHang" nvarchar(50)  
  "TenMatHang" nvarchar(100) 
  "ID_LoaiMH" integer [not null, ref: < LOAI_MAT_HANG.ID_LoaiMH]
  "ID_DVT" integer [not null, ref: < DON_VI_TINH.ID_DVT] 
  "ThongSo" nvarchar(500) 
  "BaoHanh" nvarchar(50)
  "ID_NCC" integer [ref: < NHA_CUNG_CAP.ID_NCC] 
  "GiaNhap" double
  "GiaXuat" double 
  "TRANG_THAI" integer

  Indexes {
    ID_MH [pk]
  }
}

Table MATHANG_KHO {
  "ID_MH" integer [not null, ref: < MAT_HANG.ID_MH] 
  "ID_KHO" integer [not null, ref: < KHO.ID_KHO]
  "SoLuong" integer
  "SoLuongCanhBao" integer

  Indexes {
    (ID_MH, ID_KHO) [pk]
  }
}

Table TON_KHO {
  "ID_MH" integer [not null, ref: < MAT_HANG.ID_MH]
  "ID_KHO" integer [ref: < KHO.ID_KHO]
  "NgayTinh" datetime [not null]
  "SoLuong" double
  "GiaTrungBinh" double
}
 
   