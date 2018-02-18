<?php

namespace App\Http\Repositories;

use App\Model\Sale;
use App\Repositories\Contract\InventoryInterface;

class SaleRepository implements InventoryInterface
{
	public function findById($id)
	{
		return Sale::find($id);
	}

	public function find($id, $columns)
	{
		return Sale::find($id)
			->where($columns);
	}
 
    public function findBy($field, $value, array $columns)
    {
    	return Sale::where($field, $value)
			->andWhere($columns);
    }

	public function findWhere($field, $value)
	{
		return Sale::where($field, $value);
	}

	public function findAll()
	{
		return Sale::all();
	}

	public function create(array $array)
	{
		return Sale::create($array);
	}

	public function update(array $data, $id)
	{
		return Sale::find($id)
			->update($data);
	}
}