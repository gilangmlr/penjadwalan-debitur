<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    /**
     * Get the akad that owns the komentar.
     */
    public function akad()
    {
        return $this->belongsTo('App\Akad');
    }

    /**
     * Get the user that owns the komentar.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
