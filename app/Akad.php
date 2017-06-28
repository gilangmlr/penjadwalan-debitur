<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akad extends Model
{
    /**
     * Get the notaris that owns the akad.
     */
    public function notaris()
    {
        return $this->belongsTo('App\Notaris');
    }

    /**
     * Get the fasilitas that owns the akad.
     */
    public function fasilitas()
    {
        return $this->belongsTo('App\Fasilitas');
    }

    /**
     * Get the pendamping that owns the akad.
     */
    public function pendamping()
    {
        return $this->belongsTo('App\Pendamping');
    }

    /**
     * Get the pic that owns the akad.
     */
    public function pic()
    {
        return $this->belongsTo('App\PIC');
    }

    /**
     * Get the ruangan that owns the akad.
     */
    public function ruangan()
    {
        return $this->belongsTo('App\Ruangan');
    }
}
