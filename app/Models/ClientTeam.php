<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Country
 * @mixin Builder
 */
class ClientTeam extends Model
{
    protected $table = 'client_team';
    protected $guarded = [];

}
