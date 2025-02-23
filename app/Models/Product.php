<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $primaryKey = 'product_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $appends = ['image_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'product_id',
        'product_name',
        'product_price',
    ];

    public function getImageUrlAttribute()
    {
        $media = $this->getFirstMedia('image');
        if (!$media) return null;
        return $media->getUrl();
    }
}
