<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;
use App\Models\User;

class Findus extends Model
{
    use DatePresenter;

    protected $table = 'finduss';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
