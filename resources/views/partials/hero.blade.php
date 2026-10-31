<section class="hero" id="top">
  <div class="container">
    <div class="hero__top">
      <div class="hero__lead">
        <h1>Купите автомобиль<br class="br-desktop"> своей мечты сегодня</h1>
        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
          <a class="btn btn--red btn--lg" href="{{ route('cars.index') }}">Выбрать в каталоге</a>
          <a class="btn btn--dark btn--lg" href="#lead-form">Быстрая заявка</a>
        </div>
      </div>
      <p class="hero__text">Предлагаем новые автомобили и проверенные машины с пробегом с гарантией качества. Также осуществляем параллельный импорт уникальных моделей из-за границы.</p>
    </div>

    <div class="hero__stage">
      <div class="hero__watermark" aria-hidden="true">RUSAUTO</div>
      <div class="hero__scene">
        <div class="hero__shadow" aria-hidden="true"></div>
        <img class="hero__car" src="{{ asset('img/hero-car.png') }}" alt="Audi Q5 L красного цвета">
        <img class="hero__reflection" src="{{ asset('img/hero-car.png') }}" alt="" aria-hidden="true">
      </div>
      <ul class="hero__features">
        <li>
          <span class="hero__num">01</span>
          <strong>Выкуп и продажа</strong>
          <p>широкий выбор автомобилей с пробегом и новых моделей</p>
        </li>
        <li>
          <span class="hero__num">02</span>
          <strong>Параллельный импорт</strong>
          <p>возможность приобрести уникальные модели</p>
        </li>
        <li>
          <span class="hero__num">03</span>
          <strong>Контроль качества</strong>
          <p>каждая машина проходит тщательную проверку</p>
        </li>
      </ul>
    </div>
  </div>
</section>
