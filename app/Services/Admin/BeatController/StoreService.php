<?php

namespace App\Services\Admin\BeatController;

use App\Models\Beat;
use App\Models\File;

class StoreService
{
    public function store(array $data)
    {
        $demoFile = $data['demo_file'];
        $fullFile = $data['full_file'];

        unset($data['demo_file']);
        unset($data['full_file']);

        $beat = Beat::create($data);

        $demo = File::create([
            'fileable_type' => 'App\Models\Beat',
            'fileable_id'   => $beat->id,
            'src' => '/storage/'.$demoFile->storeAs('beats', $demoFile->getClientOriginalName(), 'public'),
            'category' => 'demo'
        ]);

        $full = File::create([
            'fileable_type' => 'App\Models\Beat',
            'fileable_id'   => $beat->id,
            'src' => '/storage/'.$fullFile->storeAs('beats', $fullFile->getClientOriginalName(), 'public'),
            'category' => 'full'
        ]);

        return Response()->json(['beat' => ['beat' => $beat, 'demo' => $demo, 'full' => $full], 'message' => 'true']);
    }
}
