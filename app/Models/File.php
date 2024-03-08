<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function toArray()
    {
        return [
            'id' => $this->id,
            'src' => $this->src,
            'category' => $this->category,
            'created_at' => $this->created_at
        ];
    }
}
