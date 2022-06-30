<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Class User
 * @property int     $id
 * @property string  $name
 * @property string  $email
 * @property string  $password
 * @property Note[]  $notes
 * @property Tag[]   $tags
 * @property Event[] $events
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
class User extends Model
{
    protected $hidden = [
        'password',
    ];

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /*--------------------------------------------------------------------------
    | Auth
    --------------------------------------------------------------------------*/
    public function getAuthIdentifier(): int
    {
        return $this->id;
    }
}
