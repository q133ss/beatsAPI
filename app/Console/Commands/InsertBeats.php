<?php

namespace App\Console\Commands;

use App\Models\Beat;
use App\Models\Category;
use App\Models\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class InsertBeats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:beats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавляет биты';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Путь к папкам
        $demoDirectory = storage_path('app/beats/Individual/demo');
        $originalDirectory = storage_path('app/beats/Individual/original');

        // Получаем список папок внутри указанных директорий
        $demoFolders = glob($demoDirectory . '/*', GLOB_ONLYDIR);

        foreach ($demoFolders as $folder) {
            $categoryName = basename($folder);
            $category = Category::where('name', $categoryName)->first();

            // Перебираем файлы в папке
            $files = glob($folder . '/*.mp3');

            foreach ($files as $file) {
                $fileName = basename($file);
                $beatName = str_replace('Track - ', '', $fileName);

                // Создаем Beat
                $beat = Beat::create([
                    'author_id' => 1,
                    'category_id' => $category->id,
                    'name' => $beatName,
                    'price' => 0,
                ]);

                // Создаем File для категории 'demo'
                File::create([
                    'fileable_type' => 'App\Models\Beat',
                    'fileable_id' => $beat->id,
                    'src' => $file,
                    'category' => 'demo',
                ]);

                // Создаем File для категории 'full'
                $originalFile = str_replace('/demo/', '/original/', $file);
                $originalFile = str_replace('Track - ', '', $originalFile);
                File::create([
                    'fileable_type' => 'App\Models\Beat',
                    'fileable_id' => $beat->id,
                    'src' => $originalFile,
                    'category' => 'full',
                ]);
            }
        }

        $this->info('Beats and files created successfully.');
    }
}
