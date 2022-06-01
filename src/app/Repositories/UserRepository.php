<?php
namespace App\Repositories;

use Lab2view\RepositoryGenerator\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
