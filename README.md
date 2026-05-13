kalau api.php gaada di routes, bikin sendiri di folder routes, terus pada bagian app.php tambahkan  api: __dir__.'/../routes/api.php',

CREATE DATABASE expense_tracker; di cmd xampp
udah setting semua, langsung coba php artisan migrate

instal scantum. composer require laravel/sanctum 
ini configuration nya php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
udah configuration, langsung php artisan migrate

ini untuk isi api.php
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API berjalan dengan baik'
    ]);
});
php artisan make:controller API/AuthController

php artisan make:model Transaction -m

php artisan make:controller API/TransactionController


GET /api/transactions
json untuk POST /api/transaction
{
  "title": "Beli Makan",
  "amount": 20000,
  "type": "expense",
  "description": "Makan siang",
  "transaction_date": "2026-05-13"
}

GET /api/transactions/1 untuk ambil data transaction 1
PUT /api/transactions/1 ini untuk update
DELETE /api/transactions/1

{
  "title": "Gaji Bulanan",
  "amount": 500000,
  "type": "income",
  "description": "Freelance",
  "transaction_date": "2026-05-13"
}