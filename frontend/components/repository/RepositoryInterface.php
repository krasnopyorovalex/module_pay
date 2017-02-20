<?php

namespace frontend\components\repository;

interface RepositoryInterface
{
    public function getAll();
    public function getById($id);
}