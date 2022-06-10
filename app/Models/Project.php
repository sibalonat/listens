<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    // protected $guarded = [];

    protected $appends = ['url'];

    protected $fillable = [
        'title',
        'description',
        'color',
        'icon_name'
    ];

    public static function getAvailableTextColors()
    {
        $elements = json_decode(
            File::get(resource_path('json/costumization.json'))
        );
        return $elements->texts;
    }


    public function getUrlAttribute()
    {
        $hasMedia = $this->getFirstMedia('service');
        // dd($hasMedia);
        return $hasMedia != null ? $hasMedia->getUrl() : "";
    }


    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('service')
            ->singleFile();
    }


}
