<?php
namespace Tests\Feature;

use App\Models\Decor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\DecorController;




class DecorControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user); 
    }

    /** @test */
    public function it_can_display_the_index_page()
    {
        ob_end_clean();  
    
        $response = $this->actingAs($this->user)->get(route('decors.index'));
    
        $response->assertStatus(200);
        $response->assertViewIs('decors.index');
    }
    

    /** @test */
    public function it_can_store_a_new_decor()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('decor.jpg');

        $response = $this->actingAs($this->user)->post(route('decors.store'), [
            'name' => 'Décor Test',
            'description' => 'Description Test',
            'price' => 100,
            'image' => $file,
        ]);

        $response->assertRedirect(route('decors.index'));
        $this->assertDatabaseHas('decors', [
            'name' => 'Décor Test',
        ]);

        Storage::disk('public')->assertExists('decors/' . $file->hashName());
    }

    /** @test */
    public function it_can_update_an_existing_decor()
    {
        Storage::fake('public');

        $decor = Decor::factory()->create();

        $file = UploadedFile::fake()->image('new_decor.jpg');

        $response = $this->actingAs($this->user)->put(route('decors.update', $decor), [
            'name' => 'Updated Name',
            'description' => 'Updated Description',
            'price' => 150,
            'image' => $file,
        ]);

        $response->assertRedirect(route('decors.index'));
        $this->assertDatabaseHas('decors', [
            'id' => $decor->id,
            'name' => 'Updated Name',
        ]);

        Storage::disk('public')->assertExists('decors/' . $file->hashName());
    }

    /** @test */
    public function it_can_destroy_an_existing_decor()
    {
        Storage::fake('public');

        $decor = Decor::factory()->create([
            'image' => 'decors/test_image.jpg'
        ]);

        $response = $this->actingAs($this->user)->delete(route('decors.destroy', $decor));

        $response->assertRedirect(route('decors.index'));
        $this->assertDatabaseMissing('decors', [
            'id' => $decor->id,
        ]);

        Storage::disk('public')->assertMissing('decors/test_image.jpg');
    }


    /** @test */
    
}
