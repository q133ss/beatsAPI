<?php

namespace App\Console\Commands;

use App\Models\Beat;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GetBeats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:cats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создает категории';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Создаем две основные категории
        $groupCategory = Category::create([
            'name' => 'Group',
            'parent_id' => null,
        ]);

        $individualCategory = Category::create([
            'name' => 'Individual',
            'parent_id' => null,
        ]);

        // Путь к папке с файлами
        $directory = storage_path('app/beats/Individual/demo');

        // Получаем список папок внутри указанной директории
        $folders = glob($directory . '/*', GLOB_ONLYDIR);

        foreach ($folders as $folder) {
            // Извлекаем имя папки
            $folderName = basename($folder);

            // Создаем категорию с parent_id равным id категории "Individual"
            $newCategory = Category::create([
                'name' => $folderName,
                'parent_id' => $individualCategory->id,
            ]);

            $this->info("Category {$folderName} created successfully.");
        }

        $this->info('Categories created successfully.');
    }
}
