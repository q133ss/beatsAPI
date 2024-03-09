<?php

namespace App\Services\Admin\BeatController;

use App\Models\Beat;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class UpdateService
{
    public function update(array $data, Beat $beat): \Illuminate\Http\JsonResponse
    {
        $demoFile = $data['demo_file'] ?? null;
        $fullFile = $data['full_file'] ?? null;

        unset($data['demo_file']);
        unset($data['full_file']);

        $beat->update($data);

        if($demoFile != null) {
            Storage::disk('public')->delete(str_replace('/storage', '', $beat->demoFile->src));
            $beat->demoFile->delete();
            $demo = File::create([
                'fileable_type' => 'App\Models\Beat',
                'fileable_id' => $beat->id,
                'src' => '/storage/' . $demoFile->storeAs('beats', $demoFile->getClientOriginalName(), 'public'),
                'category' => 'demo'
            ]);
        }else{
            $demo = $beat->demoFile;
        }

        if($fullFile != null) {
            Storage::disk('public')->delete(str_replace('/storage', '', $beat->fullFile->src));
            $beat->fullFile->delete();
            $full = File::create([
                'fileable_type' => 'App\Models\Beat',
                'fileable_id' => $beat->id,
                'src' => '/storage/' . $fullFile->storeAs('beats', $fullFile->getClientOriginalName(), 'public'),
                'category' => 'full'
            ]);
        }else{
            $full = $beat->fullFile;
        }

        return Response()->json(['beat' => ['beat' => $beat, 'demo' => $demo, 'full' => $full], 'message' => 'true']);
    }
}
