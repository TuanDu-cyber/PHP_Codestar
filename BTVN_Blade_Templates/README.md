## Góc Nhỏ - Bài tập Laravel Blade

## Giới thiệu

Blog cá nhân xây dựng bằng Laravel, ban đầu là bài tập chia layout Blade, sau đó mở rộng thành một blog có đăng ký, đăng nhập, quản lý bài viết và bình luận.

Giao diện dựa trên mẫu News Website Template của Frivizn Studio.

## Tính năng

- Trang chủ và trang chi tiết bài viết (công khai)
- Đăng ký, đăng nhập, đăng xuất
- Quên mật khẩu và đặt lại mật khẩu qua email
- Gửi email chào mừng sau khi đăng ký
- Người dùng đã đăng nhập: viết bài, sửa, xóa bài của mình
- Xóa mềm bài viết: thùng rác, khôi phục, xóa vĩnh viễn
- Bình luận bài viết
- Phân quyền bằng Policy (chỉ chủ bài viết, chủ bình luận mới được sửa, xóa)
- Ghi log đăng ký, đăng nhập, đổi mật khẩu

## Luồng quên mật khẩu

1. Người dùng vào `/forgot-password`, nhập email.
2. Hệ thống gửi email chứa liên kết đặt lại mật khẩu, có hiệu lực 60 phút.
3. Người dùng bấm liên kết, vào `/reset-password/{token}` và nhập mật khẩu mới.
4. Đổi mật khẩu xong thì quay về trang đăng nhập.

Trang quên mật khẩu luôn báo kết quả giống nhau dù email có tồn tại hay không, để không lộ email nào đã đăng ký.

## Log

Các sự kiện xác thực được ghi vào kênh `auth`, mỗi ngày một file tại `storage/logs/auth-YYYY-MM-DD.log`. Mỗi dòng có thời gian, email và IP.

| Sự kiện                  | Khi nào ghi                 |
| ------------------------ | --------------------------- |
| Đăng ký                  | Tạo tài khoản thành công    |
| Đăng nhập                | Đăng nhập thành công        |
| Đăng nhập thất bại       | Sai email hoặc mật khẩu     |
| Yêu cầu cấp lại mật khẩu | Gửi mail đặt lại mật khẩu   |
| Đổi mật khẩu             | Đặt lại mật khẩu thành công |

Múi giờ ứng dụng là `Asia/Ho_Chi_Minh` (cấu hình trong `config/app.php`).

## Cấu trúc chính

- `routes/web.php`: khai báo các route
- `app/Http/Controllers/`: `HomeController`, `AuthController`, `PasswordResetController`, `PostController`, `CommentController`
- `app/Http/Requests/`: validate dữ liệu (`RegisterRequest`, `LoginRequest`, `ForgotPasswordRequest`, `ResetPasswordRequest`, `StorePost`, `UpdatePost`, `StoreComment`)
- `app/Policies/`: phân quyền bài viết và bình luận
- `app/Mail/WelcomeMail.php`: email chào mừng
- `app/Notifications/ResetPasswordNotification.php`: email cấp lại mật khẩu
- `resources/views/`: `layouts`, `partials`, `auth`, `posts`, `mail`

## Các directive Blade đã sử dụng

@extends: Kế thừa layout.

@section: Khai báo nội dung trang.

@yield: Hiển thị nội dung từ section.

@include: Nhúng header, footer và các thành phần giao diện.

@if: Kiểm tra điều kiện.

@foreach và @forelse: Lặp danh sách bài viết.

@auth và @guest: Hiển thị theo trạng thái đăng nhập.

@error: Hiển thị lỗi validate dưới từng ô nhập.

@csrf: Chống tấn công CSRF trong form.

## Cách chạy dự án

Cài đặt thư viện:

```bash
composer install
```

Tạo file `.env` và khóa ứng dụng:

```bash
cp .env.example .env
php artisan key:generate
```

Cấu hình trong file `.env`:

- Database: `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- Gửi mail (có thể dùng Mailtrap để thử): `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_FROM_ADDRESS`

Tạo bảng và dữ liệu mẫu:

```bash
php artisan migrate --seed
```

Chạy dự án:

```bash
php artisan serve
```

Mở trình duyệt tại http://127.0.0.1:8000.

## Cách kiểm tra nhanh tính năng mới

1. Vào `/register` và đăng ký tài khoản, kiểm tra hộp thư (Mailtrap) có email chào mừng.
2. Đăng xuất, vào `/forgot-password`, nhập email và bấm liên kết trong thư để đặt mật khẩu mới.
3. Mở `storage/logs/auth-<ngày hôm nay>.log` để xem các dòng log.
