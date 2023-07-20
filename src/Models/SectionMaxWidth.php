<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionMaxWidth extends Model {

    use HasFactory;
    public $timestamps = false;

    protected $table = 'sections_max_widths';
}
