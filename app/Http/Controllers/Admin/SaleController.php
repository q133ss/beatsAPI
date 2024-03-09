<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return Payment::orderBy('created_at', 'DESC')->get();
    }

    public function period(string $period)
    {
        $startDate = null;
        $endDate = null;

        switch ($period) {
            case 'day':
                $startDate = Carbon::now()->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                break;
            case 'week':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
            case 'month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
            case 'year':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            default:
                abort(404); // Возвращает ошибку 404 для неизвестного периода
        }

        $payments = Payment::whereBetween('created_at', [$startDate, $endDate])->get();
        $totalPrice = $payments->where('status', 'done')->whereBetween('created_at', [$startDate, $endDate])->sum('price');
        $count = $payments->where('status', 'done')->whereBetween('created_at', [$startDate, $endDate])->count();

        return ['totalPrice' => $totalPrice, 'count' => $count, 'payments' => $payments];
    }
}
