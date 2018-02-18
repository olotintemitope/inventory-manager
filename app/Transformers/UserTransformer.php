<?php

namespace App\Transformers;

use App\Model\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id'        => (int) $user->id,
            'firstname' => ucfirst($user->firstname),
            'lastname'  => ucfirst($user->lastname),
            'gender'    => $user->gender,
            'email' => $user->email,
        ];
    }

    // public function includeBusiness(User $user)
    // {
    // 	$businesses = $user->businesses;

    //     return $this->collection($businesses, new BusinessTransformer);
    // }
}