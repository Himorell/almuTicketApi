<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Booking
 *
 * @property $id
 * @property $user_id
 * @property $area_id
 * @property $location_id
 * @property $state_id
 * @property $date
 * @property $startTime
 * @property $endTime
 * @property $numPeople
 * @property $room
 * @property $description
 * @property $comment
 * @property $created_at
 * @property $updated_at
 *
 * @property Area $area
 * @property Location $location
 * @property State $state
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Booking extends Model
{
    
    static $rules = [
		'user_id' => 'required',
		'area_id' => 'required',
		'location_id' => 'required',
		'state_id' => 'required',
		'date' => 'required',
		'startTime' => 'required',
		'endTime' => 'required',
		'numPeople' => 'required',
		'room' => 'required',
		'description' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','area_id','location_id','state_id','date','startTime','endTime','numPeople','room','description','comment'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function area()
    {
        return $this->hasOne('App\Models\Area', 'id', 'area_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->hasOne('App\Models\Location', 'id', 'location_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function state()
    {
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
