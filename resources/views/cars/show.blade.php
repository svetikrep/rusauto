@extends('layouts.app')

@section('title', $car->title . ' — купить в RUSAUTO')

@section('content')
<div class="car-detail">
  <div class="container">
    <div style="margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between;">
      <a href="{{ route('cars.index') }}" style="color: var(--muted-light); font-size: 14px;">
        &larr; Назад в каталог
      </a>
      <span class="session-info-badge">
        Просмотр авто &bull; ID #{{ $car->id }}
      </span>
    </div>

    <div class="car-detail__grid">
      <div>
        <div class="car-gallery">
          <img src="{{ asset($car->image) }}" alt="{{ $car->title }}" style="max-height: 380px; object-fit: contain;">
        </div>

        @if($car->description)
          <div style="background: var(--bg-dark-2); padding: 24px; border-radius: 4px; margin-top: 24px;">
            <h3 style="font-family: var(--font-display); font-size: 18px; margin-bottom: 12px;">Описание автомобиля</h3>
            <p style="color: #ccc; line-height: 1.6;">{{ $car->description }}</p>
          </div>
        @endif
      </div>

      <div>
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
          @if($car->badge)
            <span class="badge" style="position: static;">{{ $car->badge }}</span>
          @endif
          <span style="color: var(--muted-light); font-size: 14px;">Год: {{ $car->year }}</span>
        </div>

        <h1 style="font-family: var(--font-display); font-size: clamp(26px, 2.8vw, 36px); margin-bottom: 8px;">
          {{ $car->title }}
        </h1>

        <div class="car-price-block">
          {{ $car->formatted_price }}
        </div>

        <table class="car-specs-table">
          <tbody>
            <tr>
              <th>Марка и модель</th>
              <td>{{ $car->brand }} {{ $car->model }}</td>
            </tr>
            <tr>
              <th>Год выпуска</th>
              <td>{{ $car->year }}</td>
            </tr>
            <tr>
              <th>Пробег</th>
              <td>{{ $car->mileage ?? '0 км (Новый)' }}</td>
            </tr>
            <tr>
              <th>Двигатель</th>
              <td>{{ $car->engine ?? '2.0 л TFSI / 245 л.с.' }}</td>
            </tr>
            <tr>
              <th>Коробка передач</th>
              <td>{{ $car->transmission ?? 'Роботизированная (S tronic)' }}</td>
            </tr>
            <tr>
              <th>Привод</th>
              <td>{{ $car->drive ?? 'Полный (quattro)' }}</td>
            </tr>
            <tr>
              <th>Цвет кузова</th>
              <td>{{ $car->color ?? 'Красный металлик' }}</td>
            </tr>
            <tr>
              <th>Статус</th>
              <td><span style="color: #52b788;">В наличии с ПТС</span></td>
            </tr>
          </tbody>
        </table>

        <div style="display: flex; gap: 12px; margin-top: 24px;">
          <a href="#lead-form" class="btn btn--red btn--lg" style="flex: 1;">
            Забронировать автомобиль
          </a>
          <a href="tel:+74951234567" class="btn btn--dark btn--lg">
            Позвонить
          </a>
        </div>
      </div>
    </div>

    @if($similarCars->isNotEmpty())
      <div style="margin-top: 70px;">
        <div class="section-head">
          <h2>Похожие предложения</h2>
          <a class="btn btn--dark" href="{{ route('cars.index') }}">Смотреть все</a>
        </div>
        <div class="cards">
          @foreach($similarCars as $simCar)
            <article class="card">
              <div class="card__photo">
                <img src="{{ asset($simCar->image) }}" alt="{{ $simCar->title }}">
                @if($simCar->badge)
                  <span class="badge">{{ $simCar->badge }}</span>
                @endif
              </div>
              <h3>{{ $simCar->title }}</h3>
              <p class="card__year">{{ $simCar->year }}</p>
              <div class="card__bottom">
                <span class="card__price">{{ $simCar->formatted_price }}</span>
                <a class="btn btn--red" href="{{ route('cars.show', $simCar->slug) }}">Подробнее</a>
              </div>
            </article>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</div>

@include('partials.lead-form', ['selectedCarId' => $car->id])
@endsection
