## Frivizn News - Bài tập Laravel Blade

## Giới thiệu

Bài tập thực hành Laravel Blade, xây dựng giao diện trang tin tức và chia layout để tái sử dụng các thành phần giao diện.

Giao diện được dựa trên mẫu News Website Template của Frivizn Studio.

## Các directive Blade đã sử dụng

@extends: Kế thừa layout.

@section: Khai báo nội dung trang.

@yield: Hiển thị nội dung từ section.

@include: Nhúng header, footer và các thành phần giao diện.

@if: Kiểm tra điều kiện.

@foreach và @forelse: Lặp danh sách bài viết.

## Cách chạy dự án

## Cài đặt thư viện:

composer install

## Tạo file .env và khóa ứng dụng:

cp .env.example .env
php artisan key:generate

## Cấu hình database trong file .env nếu dự án có sử dụng database.

Tạo bảng và dữ liệu mẫu nếu dự án có migration và seeder:

php artisan migrate --seed

## Chạy dự án:

php artisan serve

Mở trình duyệt tại http://127.0.0.1:8000.