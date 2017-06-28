<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    /**
     * Get the akads for the notaris.
     */
    public function akads()
    {
        return $this->hasMany('App\Akad');
    }
}
