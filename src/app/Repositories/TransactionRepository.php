<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Lab2view\RepositoryGenerator\BaseRepository;
use App\Models\Transaction;

class TransactionRepository extends BaseRepository
{
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }

    public function getPaginateWithSearch(int $n, Request $request)
    {
        $search =  $request->input('q');
        if($search!=""){
            $results = $this->model->where(function ($query) use ($search){
                $query->where('origin_account_number', 'like', '%'.$search.'%')
                    ->orWhere('destination_account_number', 'like', '%'.$search.'%');
            })
                ->paginate($n);
            $results->appends(['q' => $search]);
        }
        else{
            $results = $this->model->paginate($n);
        }
        return $results;
    }
}
