<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Beat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function demoFile(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->where('category', 'demo');
    }

    public function fullFile(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->where('category', 'full');
    }

    public function scopeWithFilters($query, Request $request)
    {
        return $query
            ->when($request->query('category'), function (Builder $query, $category) {
                $query->where('category_id', $category);
            });
    }
}
