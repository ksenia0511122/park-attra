<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model {
    use HasFactory;

    protected $fillable = ['name'];

    public function types() {
        return $this->belongsToMany(Type::class, 'attraction_type');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'attraction_tag');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
}
