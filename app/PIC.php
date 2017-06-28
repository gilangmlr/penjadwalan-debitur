<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PIC extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'p_i_cs';

    /**
     * Get the akads for the notaris.
     */
    public function akads()
    {
        return $this->hasMany('App\Akad');
    }
}
