<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackController\StoreRequest;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(StoreRequest $request)
    {
        Feedback::create($request->validated());
        return Response()->json([
            'message' => 'Сообщение успешно отправлено'
        ]);
    }
}
