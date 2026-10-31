@if(isset($recentlyViewedCars) && $recentlyViewedCars->isNotEmpty())
<section class="catalog" id="recently-viewed" style="background: #25262a; padding: 50px 0;">
  <div class="container">
    <div class="section-head">
      <div>
        <h2>Недавно просмотренные</h2>
        <p style="color: var(--muted-light); margin-top: 6px;">Сохранены в вашей сессии браузера</p>
      </div>
      <form action="{{ route('session.clear-viewed') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn--dark" style="font-size: 13px;">Очистить историю</button>
      </form>
    </div>

    <div class="cards">
      @foreach($recentlyViewedCars as $car)
        <article class="card">
          <div class="card__photo">
            <img src="{{ asset($car->image) }}" alt="{{ $car->title }}">
            @if($car->badge)
              <span class="badge">{{ $car->badge }}</span>
            @endif
          </div>
          <h3>{{ $car->title }}</h3>
          <p class="card__year">{{ $car->year }} &bull; {{ $car->engine ?? 'В наличии' }}</p>
          <div class="card__bottom">
            <span class="card__price">{{ $car->formatted_price }}</span>
            <a class="btn btn--red" href="{{ route('cars.show', $car->slug) }}">Подробнее</a>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif
