<?php

declare(strict_types=1);

/*
 * This file is part of Laravel CMR.
 *
 * (c) Lo Long <longlv@noithatzip.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LoLong\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use LoLong\Activity\Traits\HasActivities;
use LoLong\Task\Traits\HasTasks;
use LoLong\Category\Traits\HasCategories;
use LoLong\Lost\Traits\HasLosts;
use LoLong\Kh15\Traits\HasKh15s;
use LoLong\Video\Traits\HasVideos;
use LoLong\Comment\Traits\HasComments;


class Lead extends Model
{
    use HasComments;
    use HasActivities;
    use HasTasks;
    use HasCategories;
    use HasVideos;
    use SoftDeletes;
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @return mixed
     */
    public function creator(): MorphTo
    {
        return $this->morphTo('creator');
    }

    /**
     * @param Model $commentable
     * @param $data
     * @param Model $creator
     *
     * @return static
     */

    /**
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    public function updateLead($id, $data): bool
    {
        return (bool) static::find($id)->update($data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteLead($id): bool
    {
        return (bool) static::find($id)->delete();
    }
}
