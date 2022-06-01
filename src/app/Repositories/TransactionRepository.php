<?php
namespace App\Repositories;

use Lab2view\RepositoryGenerator\BaseRepository;
use App\Models\Transaction;

class TransactionRepository extends BaseRepository
{
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }
}
