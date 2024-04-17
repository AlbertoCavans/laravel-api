<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Technology;

class Project extends Model
{
    use HasFactory/* , SoftDeletes */;

    protected $fillable = ['type_id',"name_project", "description"];

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function redDescription($n_chars = 20)
    {
        return(strlen($this->description) > $n_chars) ? substr($this->description, 0, $n_chars) . "..." : $this->description;
    }

    public function getTechnologies()
    {
        return implode(', ', $this->technologies->pluck('name')->toArray());
    }
}
