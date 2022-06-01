<?php
namespace App\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Lab2view\RepositoryGenerator\BaseRepository;
use App\Models\UserAccount;

class UserAccountRepository extends BaseRepository
{
    public function __construct(UserAccount $model)
    {
        parent::__construct($model);
    }

    public function getActiveAccounts($userId)
    {
        try {
            $query = $this->model->where('account_status', 1)->where('account_user_id', $userId);
            return $query->get();
        } catch (QueryException $exc) {
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }
    }

    public function existsActiveAccount($userId, $accountId): bool
    {
        try {
            $query = $this->model
                ->where('id', $accountId)
                ->where('account_user_id', $userId)
                ->where('account_status', 1);
            return $query->exists();
        } catch (QueryException $exc) {
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }
    }
}
