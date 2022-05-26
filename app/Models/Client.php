<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    protected $table = 'clients';
    protected $guarded = [];

    use HasFactory;
    use SoftDeletes;

    public function project(){
        return $this->hasOne(Project::class);
    }
}
