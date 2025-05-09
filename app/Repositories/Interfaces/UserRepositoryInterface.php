<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function index();

    public function find($id);
    public function findByEmail($email);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

}
