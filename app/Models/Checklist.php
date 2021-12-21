<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Checklist
 *
 * @property int $id
 * @property int $checklist_group_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $user_id
 * @property int|null $checklist_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder|Checklist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Checklist newQuery()
 * @method static \Illuminate\Database\Query\Builder|Checklist onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Checklist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Checklist whereChecklistGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Checklist whereChecklistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Checklist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Checklist whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Checklist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Checklist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Checklist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Checklist whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Checklist withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Checklist withoutTrashed()
 * @mixin \Eloquent
 */
class Checklist extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=['checklist_group_id','name','user_id','checklist_id'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
