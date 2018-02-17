<?php

namespace App\Repository;

use App\Model\Sale;
use App\Repository\Contract\InventoryInterface;

class SaleRepository implements InventoryInterface
{
	public function findById($id)
	{
		return Sale::find($id);
	}

	public function find($id, $columns)
	{
		return Sale::find($id)
			->update($columns);
	}
 
    public function findBy($field, $value, array $columns)
    {
    	return Sale::where($field, $value)
			->update($columns);
    }

	pubic function findWhere($field, $value)
	{
		return Sale::where($field, $value);
	}

	public function findAll()
	{
		return Sale::all();
	}

	public function create(array $columns)
	{
		return Sale::create($columns);
	}

	public function update(array $data, $id)
	{
		return Sale::update($data);
	}
}