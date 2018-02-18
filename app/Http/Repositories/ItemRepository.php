<?php

namespace App\Http\Repositories;

use App\Model\Item;
use App\Http\Repositories\Contract\InventoryInterface;

class ItemRepository implements InventoryInterface
{
	public function findById($id)
	{
		return Item::find($id);
	}

	public function find($id, $columns)
	{
		return Item::find($id)
			->where($columns);
	}
 
    public function findBy($field, $value, $columns)
    {
    	return Item::where($field, $value)
			->andWhere($columns);
    }

	public function findWhere($field, $value)
	{
		return Item::where($field, $value);
	}

	public function findAll()
	{
		return Item::all();
	}

	public function create(array $array)
	{
		return Item::create($array);
	}

	public function update(array $data, $id)
	{
		return Item::find($id)
			->update($data);
	}
}