<?php

namespace Tests\Feature;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminTestimonialTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_testimonials_index(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.testimonials.index'));

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_create_testimonial(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $avatar = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)->post(route('admin.testimonials.store'), [
            'client_name' => 'Budi Santoso',
            'client_role' => 'CEO',
            'company' => 'PT Maju Bersama',
            'avatar' => $avatar,
            'rating' => 5,
            'content' => 'Pelayanan luar biasa dan sangat profesional!',
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.testimonials.index'));
        $this->assertDatabaseHas('testimonials', [
            'client_name' => 'Budi Santoso',
            'company' => 'PT Maju Bersama',
            'rating' => 5,
        ]);
    }

    public function test_authenticated_user_can_update_testimonial(): void
    {
        $user = User::factory()->create();
        $testimonial = Testimonial::create([
            'client_name' => 'Klien Lama',
            'rating' => 4,
            'content' => 'Konten lama',
        ]);

        $response = $this->actingAs($user)->put(route('admin.testimonials.update', $testimonial->id), [
            'client_name' => 'Klien Perbarui',
            'rating' => 5,
            'content' => 'Konten baru yang lebih bagus',
            'is_featured' => true,
            'sort_order' => 2,
        ]);

        $response->assertRedirect(route('admin.testimonials.index'));
        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'client_name' => 'Klien Perbarui',
            'rating' => 5,
        ]);
    }

    public function test_authenticated_user_can_delete_testimonial(): void
    {
        $user = User::factory()->create();
        $testimonial = Testimonial::create([
            'client_name' => 'Klien Dihapus',
            'rating' => 5,
            'content' => 'Konten dihapus',
        ]);

        $response = $this->actingAs($user)->delete(route('admin.testimonials.destroy', $testimonial->id));

        $response->assertRedirect(route('admin.testimonials.index'));
        $this->assertDatabaseMissing('testimonials', [
            'id' => $testimonial->id,
        ]);
    }
}
