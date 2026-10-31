<footer class="footer">
  <div class="container footer__inner">
    <a class="logo" href="{{ route('home') }}"><span>RUS</span>AUTO</a>
    <nav class="nav">
      <a href="{{ route('cars.index') }}">Каталог</a>
      <a href="{{ url('/#reviews') }}">Отзывы</a>
      <a href="{{ url('/#contacts') }}">Контакты</a>
      <a href="{{ url('/#lead-form') }}">Заявка</a>
    </nav>
  </div>
  <div class="container" style="margin-top: 24px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.06); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; font-size: 12px; color: var(--muted);">
    <p>&copy; {{ date('Y') }} RUSAUTO. Все права защищены. Разработано на Laravel 11/12 (PHP 8.3).</p>
    <div style="display: flex; gap: 16px; align-items: center;">
      <span>Просмотров сайта: {{ session('visits_count', 1) }}</span>
      @if(session('leads_submitted_count'))
        <span>Заявок отправлено: {{ session('leads_submitted_count') }}</span>
      @endif
    </div>
  </div>
</footer>
