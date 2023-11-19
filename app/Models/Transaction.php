<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'payer_id',
        'due_on',
        'vat',
        'vat_inclusive',
    ];

    /**
     * Get all of the payments for the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the payer that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id', 'id');
    }

    public function status() {
        if(!$this->payments->sum('amount')<$this->amount) {
            return 'Paid';
        } else {
            if($this->due_on>=date('Y-m-d')) {
                return 'Outstanding';
            } else {
                return 'Overdue';
            }
        }
    }
}
