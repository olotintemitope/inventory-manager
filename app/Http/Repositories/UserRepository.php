<?php

namespace App\Http\Repositories;

use App\Model\User;
use App\Http\Repositories\Contract\InventoryInterface;

class UserRepository implements InventoryInterface
{
	public function findById($id)
	{
		return User::find($id);
	}

	public function find($id, $columns)
	{
		return User::findOrFail($id)
			->where($columns);
	}
 
    public function findBy($field, $value, $columns)
    {
    	return User::where($field, $value)
			->andWhere($columns);
    }

	public function findWhere($field, $value)
	{
		return User::where($field, $value);
	}

	public function findAll()
	{
		return User::all();
	}

	public function create(array $array)
	{
		return User::create($array);
	}

	public function update(array $data, $id)
	{
		return User::find($id)
			->update($data);
	}
}