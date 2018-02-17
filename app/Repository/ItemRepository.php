<?php

namespace App\Repository;

use App\Model\Item;
use App\Repository\Contract\InventoryInterface;

class ItemRepository implements InventoryInterface
{
	public function findById($id)
	{
		return Item::find($id);
	}

	public function find($id, $columns)
	{
		return Item::find($id)
			->update($columns);
	}
 
    public function findBy($field, $value, array $columns)
    {
    	return Item::where($field, $value)
			->update($columns);
    }

	pubic function findWhere($field, $value)
	{
		return Item::where($field, $value);
	}

	public function findAll()
	{
		return Item::all();
	}

	public function create(array $columns)
	{
		return Item::create($columns);
	}

	public function update(array $data, $id)
	{
		return Item::update($data);
	}
}