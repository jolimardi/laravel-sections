<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Section extends Model implements HasMedia {
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'sections_content';

    // Sert pour les vidéos (stockées en json)
    protected function video(): Attribute {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
        );
    }

    public function template(): BelongsTo {
        return $this->belongsTo(SectionTemplate::class, 'template_name', 'name');
    }

    public function max_width_relationship(): BelongsTo {
        return $this->belongsTo(SectionMaxWidth::class, 'max_width', 'class');
    }


    // Custom fields (attention, ne marche pas avec key_classname par exemple)
    public function getkeyClassnameAttribute() {
        return str_replace('.', '-', $this->key);
    }


    // Ajout &nbsp; before save
    public function setPAttribute($value) {
        $this->attributes['p'] = str_replace([' ?', ' !', ' :'], ['&nbsp;?', '&nbsp;!', '&nbsp;:'], $value);
    }


    // Ajout pour la media library (et mutliple image uploads Nova)
    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('thumb')
            ->width(460)
            ->height(260);
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('image')->singleFile();
        $this->addMediaCollection('photos');
    }
}
