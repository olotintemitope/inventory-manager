<?php

namespace App\Http\Repositories\Contract;

interface InventoryInterface
{
	public function findById($id);

	public function find($id, $columns);
 
    public function findBy($field, $value, $columns);

	public function findWhere($field, $value);

	public function findAll();

	public function create(array $array);

	public function update(array $data, $id);
}