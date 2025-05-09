<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Cara Instalasi

- Clone / Download projek ke direktori <b>www</b> jika menggunakan laragon, atau ke direktori <b>htdocs</b> jika menggunakan XAMPP.
- Masuk kedalam folder projek, kemudian salin file <i>.env.example</i> dan beri nama file yang baru disalin dengan nama <i>.env</i>
- sesuaikan konfigurasi database didalam file <i>.env</i> tersebut.
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=rekam_medis
    DB_USERNAME=root
    DB_PASSWORD=
    ```
- jalankan perintah  ``` composer install ``` pada terminal, untuk menginstall vendor/packages
- jalankan perintah  ``` php artisan migrate ``` pada terminal, untuk memigrasi data blueprint ke database mysql.
- jalankan perintah  ``` php artisan db:seed ``` pada terminal, untuk mennginsertkan sample data pada seeder ke dalam database.
- jika menggunakan laragon, silahkan restart apache pada laragon, kemudian akses rekam-medis.test pada browser.
- namun jika menggunakan XAMPP, pastikan untuk menjalankan service laravel dengan mengetikan perintah ``` php artisan serve ``` kemudian akses <b>localhost:8000</b> pada browser.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# medix
