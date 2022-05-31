<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'projects';

    protected $guarded = [];

    public function client(){
      return $this->belongsTo(Client::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtoupper($value);
    }

    public function getTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst(strtolower($value));
    }

}
