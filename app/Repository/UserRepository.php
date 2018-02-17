<?php

namespace App\Repository;

use App\Model\User;
use App\Repository\Contract\InventoryInterface;

class UserRepository implements InventoryInterface
{
	public function findById($id)
	{
		return User::find($id);
	}

	public function find($id, $columns)
	{
		return User::find($id)
			->update($columns);
	}
 
    public function findBy($field, $value, array $columns)
    {
    	return User::where($field, $value)
			->update($columns);
    }

	pubic function findWhere($field, $value)
	{
		return User::where($field, $value);
	}

	public function findAll()
	{
		return User::all();
	}

	public function create(array $columns)
	{
		return User::create($columns);
	}

	public function update(array $data, $id)
	{
		return User::update($data);
	}
}