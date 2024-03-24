<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        'accountName',
        'accountNumber',
        'bank',
    ];
}
