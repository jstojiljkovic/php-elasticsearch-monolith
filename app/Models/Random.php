<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Random
 *
 * @property int $id
 * @property int $user_id
 * @property string $company
 * @property string $phone_number
 * @property string|null $description
 * @property string $type
 * @property string $iban
 * @property string $pan
 * @property int $cvv
 * @property string $expiration
 * @property string $hex_color
 * @property string|null $country
 * @property float $latitude
 * @property float $longitude
 * @property string $birthday
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\RandomFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Random newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Random newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Random query()
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereCvv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereExpiration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereHexColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereIban($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random wherePan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Random whereUserId($value)
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
     * Enable or disable model timestamp
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The users that belong to the random thing.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
