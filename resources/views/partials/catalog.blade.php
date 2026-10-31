<section class="catalog" id="catalog">
  <div class="container">
    <div class="section-head">
      <h2>Новые поступления</h2>
      <a class="btn btn--dark btn--lg" href="{{ route('cars.index') }}">Все предложения ({{ \App\Models\Car::where('is_available', true)->count() }})</a>
    </div>

    <div class="cards">
      @forelse($cars as $car)
        <article class="card">
          <div class="card__photo">
            <img src="{{ asset($car->image) }}" alt="{{ $car->title }}">
            @if($car->badge)
              <span class="badge">{{ $car->badge }}</span>
            @endif
          </div>
          <h3>{{ $car->title }}</h3>
          <p class="card__year">{{ $car->year }} @if($car->mileage) &bull; {{ $car->mileage }} @endif</p>
          <div class="card__bottom">
            <span class="card__price">{{ $car->formatted_price }}</span>
            <a class="btn btn--red" href="{{ route('cars.show', $car->slug) }}">Подробнее</a>
          </div>
        </article>
      @empty
        <p style="grid-column: 1 / -1; text-align: center; color: var(--muted-light); padding: 40px;">Автомобили временно отсутствуют.</p>
      @endforelse
    </div>
  </div>
</section>
