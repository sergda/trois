<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;
use App\Models\User;

class Collection extends Model
{
    use DatePresenter;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
