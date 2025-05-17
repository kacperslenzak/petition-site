<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetitionSignatures extends Model
{
    protected $table = 'petition_signatures';

    protected $fillable = [
        'discord_id',
        'vote'
    ];
}
