<?php

namespace App\Repository;

use App\Model\Category;
use App\Repository\Contract\InventoryInterface;

class CategoryRepository implements InventoryInterface
{
	public function findById($id)
	{
		return Category::find($id);
	}

	public function find($id, $columns)
	{
		return Category::find($id)
			->update($columns);
	}
 
    public function findBy($field, $value, array $columns)
    {
    	return Category::where($field, $value)
			->update($columns);
    }

	pubic function findWhere($field, $value)
	{
		return Category::where($field, $value);
	}

	public function findAll()
	{
		return Category::all();
	}

	public function create(array $columns)
	{
		return Category::create($columns);
	}

	public function update(array $data, $id)
	{
		return Category::update($data);
	}
}