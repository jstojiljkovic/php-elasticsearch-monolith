<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Random
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\RandomFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Random newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Random newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Random query()
 * @mixin \Eloquent
 */
class Random extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'randomness';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'company',
        'phone_number',
        'description',
        'type',
        'iban',
        'pan',
        'cvv',
        'expiration',
        'country',
        'latitude',
        'longitude',
        'birthday'
    ];

    /**
     * The users that belong to the random thing.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
