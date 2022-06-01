<?php
namespace App\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Lab2view\RepositoryGenerator\BaseRepository;
use App\Models\UserExternalAccount;

class UserExternalAccountsRepository extends BaseRepository
{
    public function __construct(UserExternalAccount $model)
    {
        parent::__construct($model);
    }

    public function getActiveAccounts()
    {
        try {
            $query = $this->model->where('account_status', 1)->where('can_transfer', 1);
            return $query->get();
        } catch (QueryException $exc) {
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }
    }

    public function existsActiveAccount($accountId): bool
    {
        try {
            $query = $this->model
                ->where('id', $accountId)
                ->where('account_status', 1)
                ->where('can_transfer', 1);
            return $query->exists();
        } catch (QueryException $exc) {
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }
    }
}
