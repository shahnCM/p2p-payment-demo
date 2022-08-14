<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryBuilder
{
    public function setModel(): void;
    public function getModel(): Model;
}
