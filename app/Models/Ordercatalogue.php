<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;
use App\Models\User;

class Ordercatalogue extends Model
{
    use DatePresenter;

    protected $table = 'ordercatalogues';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
