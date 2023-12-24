<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LoLong\Comment\Traits\HasComments;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\ModelStatus\HasStatuses;
use LoLong\Activity\Traits\HasActivities;
use LoLong\Task\Traits\HasTasks;
use LoLong\Category\Traits\HasCategories;
use LoLong\Lost\Traits\HasLosts;
use LoLong\Kh15\Traits\HasKh15s;
use LoLong\Video\Traits\HasVideos;

class Contact extends Model implements HasMedia
{
	use HasComments;
	use HasMediaTrait;
    use HasActivities;
    use HasTasks;
    use HasCategories;
    use HasLosts;
    use HasKh15s;
    use HasVideos;
    use HasStatuses;

    //protected $fillable = ['title','first_name','last_name','phone','email','company', 'address', 'city', 'note', 'description', 'type_id', 'user_id'];

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function quotes()
    {
        return $this->hasMany('App\Quote');
    }

    public function costcenter(){
        return $this->belongsTo('App\Costcenter');
    }
}
