<?php

namespace App\Repository;

use App\Model\Business;
use App\Repository\Contract\InventoryInterface;

class UserRepository implements InventoryInterface
{
	public function findById($id)
	{
		return Business::find($id);
	}

	public function find($id, $columns)
	{
		return Business::find($id)
			->update($columns);
	}
 
    public function findBy($field, $value, array $columns)
    {
    	return Business::where($field, $value)
			->update($columns);
    }

	pubic function findWhere($field, $value)
	{
		return Business::where($field, $value);
	}

	public function findAll()
	{
		return Business::all();
	}

	public function create(array $columns)
	{
		return Business::create($columns);
	}

	public function update(array $data, $id)
	{
		return Business::update($data);
	}
}