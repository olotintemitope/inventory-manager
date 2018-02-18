<?php

namespace App\Http\Repositories;

use App\Model\Category;
use App\Repositories\Contract\InventoryInterface;

class CategoryRepository implements InventoryInterface
{
	public function findById($id)
	{
		return Category::find($id);
	}

	public function find($id, $columns)
	{
		return Category::find($id)
			->where($columns);
	}
 
    public function findBy($field, $value, $columns)
    {
    	return Category::where($field, $value)
			->where($columns);
    }

	public function findWhere($field, $value)
	{
		return Category::where($field, $value);
	}

	public function findAll()
	{
		return Category::all();
	}

	public function create(array $array)
	{
		return Category::create($array);
	}

	public function update(array $data, $id)
	{
		return Category::find($id)
			->update($data);
	}
}