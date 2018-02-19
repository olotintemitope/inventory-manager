<?php

namespace App\Transformers;

use App\Model\User;
use League\Fractal\TransformerAbstract;
use App\Transformers\BusinessTransformer;

class UserTransformer extends TransformerAbstract
{
	/**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'businesses'
    ];

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

    public function includeBusinesses(User $user)
    {
    	$businesses = $user->businesses;

        return $this->collection($businesses, new BusinessTransformer);
    }
}