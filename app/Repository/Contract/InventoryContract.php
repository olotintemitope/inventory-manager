<?php

namespace App\Repository\Contract;

interface InventoryInterface
{
	public function findById($id);

	public function find($id, $columns = array('*'));
 
    public function findBy($field, $value, $columns = array('*'));

	pubic function findWhere($field, $value);

	public function findAll();

	public function create(array $array);

	public function update(array $data, $id);
}