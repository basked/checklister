<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ChecklistGroup
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Checklist[] $checklists
 * @property-read int|null $checklists_count
 * @method static \Illuminate\Database\Eloquent\Builder|ChecklistGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChecklistGroup newQuery()
 * @method static \Illuminate\Database\Query\Builder|ChecklistGroup onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ChecklistGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChecklistGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChecklistGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChecklistGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChecklistGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChecklistGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ChecklistGroup withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ChecklistGroup withoutTrashed()
 * @mixin \Eloquent
 */
class ChecklistGroup extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=['name'];

    public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }
}
