<?php

namespace App\Contracts\Tenants;

/**
* @var QuestionBankContract
*/
interface QuestionBankContract
{
    public function index();
    public function store($data);
    public function show($id);
    public function update($data,$id);
    public function delete($id);
}
