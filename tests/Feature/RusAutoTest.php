<?php

namespace Tests\Feature;

use App\Events\LeadCreated;
use App\Models\Car;
use App\Models\Lead;
use App\Models\Review;
use Database\Seeders\CarSeeder;
use Database\Seeders\ReviewSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RusAutoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CarSeeder::class);
        $this->seed(ReviewSeeder::class);
    }

    public function test_home_page_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('RUSAUTO');
        $response->assertSee('Купите автомобиль');
        $response->assertSee('Новые поступления');
        $response->assertSee('Отзывы наших клиентов');
    }

    public function test_catalog_page_renders_and_filters(): void
    {
        $response = $this->get('/catalog');

        $response->assertStatus(200);
        $response->assertSee('Каталог автомобилей');
        $response->assertSee('Audi Q5 L III (GU)');
    }

    public function test_car_show_page_and_session_recently_viewed(): void
    {
        $car = Car::first();
        $this->assertNotNull($car);

        $response = $this->get('/catalog/' . $car->slug);

        $response->assertStatus(200);
        $response->assertSee($car->title);
        $response->assertSee($car->formatted_price);

        $this->assertTrue(in_array($car->id, session('recently_viewed', [])));
    }

    public function test_lead_validation_fails_with_invalid_data(): void
    {
        $response = $this->post('/leads', [
            'name'  => '',
            'phone' => 'invalid-phone-string',
        ]);

        $response->assertSessionHasErrors(['name', 'phone']);
        $this->assertEquals(0, Lead::where('name', '')->count());
    }

    public function test_lead_submission_creates_record_dispatches_event_and_sets_session(): void
    {
        Event::fake([LeadCreated::class]);

        $car = Car::first();

        $formData = [
            'name'    => 'Алексей Тестовый',
            'phone'   => '+7 (999) 777-66-55',
            'car_id'  => $car->id,
            'message' => 'Интересует покупка автомобиля в кредит.',
        ];

        $response = $this->post('/leads', $formData);

        $response->assertRedirect();
        
        $response->assertSessionHas('success');
        $response->assertSessionHas('client_name', 'Алексей Тестовый');
        $response->assertSessionHas('leads_submitted_count', 1);

        $this->assertDatabaseHas('leads', [
            'name'   => 'Алексей Тестовый',
            'phone'  => '+7 (999) 777-66-55',
            'car_id' => $car->id,
        ]);

        Event::assertDispatched(LeadCreated::class, function ($event) use ($car) {
            return $event->lead->name === 'Алексей Тестовый' && $event->lead->car_id === $car->id;
        });
    }

    public function test_review_submission_creates_record_and_flashes_session(): void
    {
        $response = $this->post('/reviews', [
            'author_name' => 'Дмитрий В.',
            'comment'     => 'Отличный автосалон, быстро оформили сделку!',
            'rating'      => 5,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('review_success');
        $response->assertSessionHas('has_reviewed', true);

        $this->assertDatabaseHas('reviews', [
            'author_name' => 'Дмитрий В.',
            'rating'      => 5,
        ]);
    }
}
