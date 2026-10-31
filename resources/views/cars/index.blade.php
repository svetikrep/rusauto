@extends('layouts.app')

@section('title', 'Каталог автомобилей — RUSAUTO')

@section('content')
<section style="padding: 40px 0 60px;">
  <div class="container">
    <div style="margin-bottom: 30px;">
      <a href="{{ route('home') }}" style="color: var(--muted-light); font-size: 13px;">&larr; На главную</a>
      <h1 style="font-family: var(--font-display); font-size: clamp(26px, 3.2vw, 42px); margin-top: 8px;">
        Каталог автомобилей в наличии
      </h1>
      <p style="color: var(--muted-light); margin-top: 6px;">
        Широкий выбор проверенных автомобилей с гарантией и возможностью доставки.
      </p>
    </div>

    <form action="{{ route('cars.index') }}" method="GET" class="filter-bar">
      <div class="filter-item">
        <label class="form-label" for="filter-brand">Марка</label>
        <select name="brand" id="filter-brand" class="form-select">
          <option value="">Все марки</option>
          @foreach($brands as $brand)
            <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
              {{ $brand }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="filter-item">
        <label class="form-label" for="filter-year">Год выпуска</label>
        <select name="year" id="filter-year" class="form-select">
          <option value="">Любой год</option>
          @foreach($years as $yr)
            <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>
              {{ $yr }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="filter-item" style="flex: 2 1 250px;">
        <label class="form-label" for="filter-search">Поиск по модели</label>
        <input 
          type="text" 
          name="search" 
          id="filter-search" 
          class="form-input" 
          placeholder="Например: Audi Q5 или RS6" 
          value="{{ request('search') }}"
        >
      </div>

      <div style="display: flex; gap: 8px;">
        <button type="submit" class="btn btn--red" style="height: 48px; padding-inline: 24px;">
          Найти
        </button>
        @if(request()->hasAny(['brand', 'year', 'search']))
          <a href="{{ route('cars.index') }}" class="btn btn--dark" style="height: 48px;">
            Сбросить
          </a>
        @endif
      </div>
    </form>

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
          <p class="card__year">{{ $car->year }} &bull; {{ $car->engine ?? 'Бензин' }}</p>
          <div class="card__bottom">
            <span class="card__price">{{ $car->formatted_price }}</span>
            <a class="btn btn--red" href="{{ route('cars.show', $car->slug) }}">Подробнее</a>
          </div>
        </article>
      @empty
        <div style="grid-column: 1 / -1; background: var(--bg-dark-2); padding: 50px; text-align: center; border-radius: 4px;">
          <h3 style="font-family: var(--font-display); margin-bottom: 8px;">Автомобили не найдены</h3>
          <p style="color: var(--muted-light); margin-bottom: 20px;">Попробуйте изменить параметры поиска или оставьте заявку на индивидуальный подбор.</p>
          <a href="{{ route('cars.index') }}" class="btn btn--white">Сбросить все фильтры</a>
        </div>
      @endforelse
    </div>

    @if($cars->hasPages())
      <div class="pagination-wrapper">
        {{ $cars->links() }}
      </div>
    @endif
  </div>
</section>

@include('partials.lead-form')
@endsection
