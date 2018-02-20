<?php

namespace App\Http\Repositories;

use App\Model\Sales;
use App\Http\Repositories\Contract\InventoryInterface;

class SalesRepository implements InventoryInterface
{
	public function findById($id)
	{
		return Sales::find($id);
	}

	public function find($id, $columns)
	{
		return Sales::find($id)
			->where($columns);
	}
 
    public function findBy($field, $value, $columns)
    {
    	return Sales::where($field, $value)
			->andWhere($columns);
    }

	public function findWhere($field, $value)
	{
		return Sales::where($field, $value);
	}

	public function findAll()
	{
		return Sales::all();
	}

	public function create(array $array)
	{
		return Sales::create($array);
	}

	public function update(array $data, $id)
	{
		return Sales::find($id)
			->update($data);
	}
}