<?php

namespace Tests\Feature;

use App\Models\Decor;
use App\Models\User; // Ensure you have the User model
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DecorsExport;
use App\Imports\DecorsImport;

class DecorControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(); // Create a user for authentication
    }

    /** @test */
    public function it_can_display_the_index_page()
    {
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
    public function it_can_import_decors_from_excel_file()
    {
        Storage::fake('local');

        Excel::fake();

        $file = UploadedFile::fake()->create('decors.xlsx');

        $response = $this->actingAs($this->user)->post(route('decors.import'), [
            'file' => $file,
        ]);

        $response->assertRedirect(route('decors.index'));
        $response->assertSessionHas('success', 'Décors importés avec succès.');

        Excel::assertImported('decors.xlsx');
    }

    /** @test */
    public function it_can_export_decors_to_excel_file()
    {
        Excel::fake();
    
        $response = $this->actingAs($this->user)->get(route('decors.export'));
    
        $response->assertStatus(200);
        $response->assertHeader('Content-Disposition', 'attachment; filename=decors.xlsx');
    
        Excel::assertDownloaded('decors.xlsx', function (DecorsExport $export) {
            return true;
        });
    }
}