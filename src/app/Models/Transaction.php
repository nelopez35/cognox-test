<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $origin_account_number
 * @property int $destination_account_number
 * @property int $amount
 * @property int $created_at
 * @property int $updated_at
 */
class Transaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id', 'origin_account_id', 'origin_account_number', 'destination_account_id', 'external_destination_account_id', 'destination_account_number', 'amount', 'origin_user_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'origin_account_number' => 'int', 'destination_account_number' => 'int', 'amount' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    public function create(array $options = [])
    {
        $latestTransaction = self::orderBy('created_at','DESC')->first();
        $options['transaction_id'] = '#'.str_pad($latestTransaction->id ?? 0 + 1, 10, "0", STR_PAD_LEFT);
        return parent::create($options);
        // after save code
    }
    // Scopes...

    // Functions ...

    // Relations ...
}
