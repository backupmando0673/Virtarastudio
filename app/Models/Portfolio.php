<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'service_id',
        'category_id',
        'category',
        'title',
        'slug',
        'client_name',
        'description',
        'image_url',
        'gallery_images',
        'demo_url',
        'technologies',
        'is_featured',
        'sort_order',
    ];

    /**
     * Get the service category for this portfolio item.
     */
    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'gallery_images' => 'array',
            'technologies' => 'array',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Get the service that owns the portfolio item.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
