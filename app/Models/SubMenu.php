<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SubMenu
 *
 * @property int $id
 * @property string $name
 * @property int $priority
 * @property int $menu_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|SubMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubMenu whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubMenu wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubMenu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SubMenu extends Model
{
    protected $guarded = [];
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
