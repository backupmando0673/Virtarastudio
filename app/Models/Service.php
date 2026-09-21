<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'description',
        'icon_name',
        'features',
        'starting_price',
        'whatsapp_template',
        'sort_order',
        'is_featured',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Get portfolios associated with the service.
     */
    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    /**
     * Generate WhatsApp direct link for this service.
     */
    public function getWhatsAppUrl(string $phoneNumber): string
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phoneNumber);
        $message = $this->whatsapp_template ?: "Halo Virtarastudio, saya tertarik dengan layanan {$this->name}. Bisa tolong berikan informasi paket dan penawarannya?";

        return 'https://wa.me/'.$cleanPhone.'?text='.rawurlencode($message);
    }
}
