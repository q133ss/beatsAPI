<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BeatController\StoreBeatRequest;
use App\Http\Requests\Admin\BeatController\UpdateBeatRequest;
use App\Models\Beat;
use App\Services\Admin\BeatController\StoreService;
use App\Services\Admin\BeatController\UpdateService;
use Illuminate\Support\Facades\Storage;

class BeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Beat::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBeatRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new StoreService())->store($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Beat $beat)
    {
        return $beat->load('demoFile', 'fullFile');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBeatRequest $request, Beat $beat)
    {
        return (new UpdateService())->update($request->validated(), $beat);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beat $beat)
    {
        $beat->delete();
        Storage::disk('public')->delete(str_replace('/storage', '', $beat->demoFile->src));
        Storage::disk('public')->delete(str_replace('/storage', '', $beat->fullFile->src));
        return Response()->json(['message' => 'true']);
    }
}
