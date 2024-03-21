<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $statuses = [
            'wait' => ['label' => 'Ожидание оплаты', 'class' => 'text-warning'],
            'fail' => ['label' => 'Не оплачено', 'class' => 'text-danger'],
            'done' => ['label' => 'Успешно оплачен', 'class' => 'text-success']
        ];
        $sales = Payment::orderBy('created_at', 'DESC')->get();
        return view('sales', compact('sales', 'statuses'));
    }

    public function period(string $period)
    {
        $statuses = [
            'wait' => ['label' => 'Ожидание оплаты', 'class' => 'text-warning'],
            'fail' => ['label' => 'Не оплачено', 'class' => 'text-danger'],
            'done' => ['label' => 'Успешно оплачен', 'class' => 'text-success']
        ];
        $salesQuery = (new \App\Http\Controllers\Admin\SaleController())->period($period);
        $count = $salesQuery['count'];
        $totalPrice = $salesQuery['totalPrice'];
        $sales = $salesQuery['payments'];
        return view('sales', compact('sales', 'count', 'totalPrice', 'statuses'));
    }
}
