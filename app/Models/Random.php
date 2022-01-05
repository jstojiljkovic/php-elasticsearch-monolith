<?php

namespace App\Models;

use Database\Factories\RandomFactory;
use ElasticScoutDriverPlus\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
 * @property-read Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\RandomFactory factory(...$parameters)
 * @method static Builder|Random newModelQuery()
 * @method static Builder|Random newQuery()
 * @method static Builder|Random query()
 * @method static Builder|Random whereBirthday($value)
 * @method static Builder|Random whereCompany($value)
 * @method static Builder|Random whereCountry($value)
 * @method static Builder|Random whereCvv($value)
 * @method static Builder|Random whereDescription($value)
 * @method static Builder|Random whereExpiration($value)
 * @method static Builder|Random whereHexColor($value)
 * @method static Builder|Random whereIban($value)
 * @method static Builder|Random whereId($value)
 * @method static Builder|Random whereLatitude($value)
 * @method static Builder|Random whereLongitude($value)
 * @method static Builder|Random wherePan($value)
 * @method static Builder|Random wherePhoneNumber($value)
 * @method static Builder|Random whereType($value)
 * @method static Builder|Random whereUserId($value)
 * @mixin \Eloquent
 */
class Random extends Model
{
    use HasFactory, Searchable;

    /**
     * Enable or disable model timestamp
     *
     * @var bool
     */
    public $timestamps = false;
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
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs(): string
    {
        return 'randomness';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
        $array = $this->toArray();

        $array['location'] = [
            'lat' => $array['latitude'],
            'lon' => $array['longitude']
        ];

        unset($array['latitude'], $array['longitude']);

        return $array;
    }

    /**
     * The users that belong to the random thing.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
