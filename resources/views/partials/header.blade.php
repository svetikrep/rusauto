<header class="header" id="header">
  <div class="container header__inner">
    <a class="logo" href="{{ route('home') }}"><span>RUS</span>AUTO</a>
    <button class="burger" type="button" aria-label="Открыть меню" aria-expanded="false" aria-controls="menu">
      <span></span><span></span><span></span>
    </button>
    <div class="menu" id="menu">
      <nav class="nav">
        <a href="{{ route('cars.index') }}">Каталог</a>
        <a href="{{ url('/#reviews') }}">Отзывы</a>
        <a href="{{ url('/#contacts') }}">Контакты</a>
        <a href="{{ url('/#lead-form') }}">Оставить заявку</a>
        @if(count(session('recently_viewed', [])) > 0)
          <a href="{{ url('/#recently-viewed') }}" style="color: #52b788; font-weight: 600;">
            Просмотрено ({{ count(session('recently_viewed', [])) }})
          </a>
        @endif
      </nav>
      <div class="header__actions">
        <a class="icon-btn" href="tel:+74951234567" aria-label="Позвонить"><svg><use href="#i-phone"/></svg></a>
        <a class="icon-btn" href="#" aria-label="ВКонтакте"><svg><use href="#i-vk"/></svg></a>
        <a class="btn btn--red" href="{{ url('/#lead-form') }}">Консультация</a>
      </div>
    </div>
  </div>
</header>
