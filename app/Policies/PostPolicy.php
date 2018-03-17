<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\Testblock;
use App\Models\Worldtc;
use App\Models\User;
use App\Models\Collection;
use App\Models\Customerservice;
use App\Models\Findus;
use App\Models\Ordercatalogue;

class PostPolicy
{
    public function before(User $user, $ability)
    {
        if (session('statut') == 'admin') {
            return true;
        }
    }
    
    public function change(User $user, Post $post)
    {
        return $user->id == $post->user_id;
    }

    public function changeTestblock(User $user, Testblock $post)
    {
        return $user->id == $post->user_id;
    }

    public function changeWorldtc(User $user, Worldtc $post)
    {
        return $user->id == $post->user_id;
    }

    public function changeCollection(User $user, Collection $post)
    {
        return $user->id == $post->user_id;
    }
    public function changeCustomerservice(User $user, Customerservice $post)
    {
        return $user->id == $post->user_id;
    }
    public function changeFindus(User $user, Findus $post)
    {
        return $user->id == $post->user_id;
    }
    public function orderCatalogue(User $user, Findus $post)
    {
        return $user->id == $post->user_id;
    }
}
