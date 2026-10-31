<section class="section-form" id="lead-form">
  <div class="container">
    <div class="form-wrapper">
      <div style="text-align: center; margin-bottom: 30px;">
        <h2>Оставить заявку на автомобиль</h2>
        <p style="color: var(--muted-light); margin-top: 8px;">
          Заполните форму, и наш менеджер свяжется с вами для бронирования или расчета персонального предложения.
        </p>

        @if(session('leads_submitted_count'))
          <div style="margin-top: 12px;">
            <span class="session-info-badge">
              <strong>Сессия:</strong> вы уже успешно отправили {{ session('leads_submitted_count') }} заявку(и)
            </span>
          </div>
        @endif
      </div>

      <form action="{{ route('leads.store') }}" method="POST" novalidate>
        @csrf

        <div class="form-grid-2">
          <div class="form-group">
            <label class="form-label" for="lead-name">Ваше имя *</label>
            <input 
              type="text" 
              name="name" 
              id="lead-name" 
              class="form-input @error('name') is-invalid @enderror" 
              placeholder="Иван Иванов" 
              value="{{ old('name', session('client_name')) }}" 
              required
            >
            @error('name')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="lead-phone">Номер телефона *</label>
            <input 
              type="tel" 
              name="phone" 
              id="lead-phone" 
              class="form-input @error('phone') is-invalid @enderror" 
              placeholder="+7 (999) 000-00-00" 
              value="{{ old('phone', session('client_phone')) }}" 
              required
            >
            @error('phone')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="lead-car">Интересующий автомобиль</label>
          <select name="car_id" id="lead-car" class="form-select @error('car_id') is-invalid @enderror">
            <option value="">— Общая консультация / Подбор под заказ —</option>
            @php
              $allCars = \App\Models\Car::where('is_available', true)->orderBy('brand')->orderBy('model')->get();
              $preselectedCarId = isset($selectedCarId) ? $selectedCarId : old('car_id');
            @endphp
            @foreach($allCars as $carItem)
              <option value="{{ $carItem->id }}" {{ $preselectedCarId == $carItem->id ? 'selected' : '' }}>
                {{ $carItem->title }} ({{ $carItem->year }}) — {{ $carItem->formatted_price }}
              </option>
            @endforeach
          </select>
          @error('car_id')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="lead-message">Комментарий или вопрос (необязательно)</label>
          <textarea 
            name="message" 
            id="lead-message" 
            class="form-textarea @error('message') is-invalid @enderror" 
            rows="3" 
            placeholder="Интересует trade-in, покупка в лизинг или тест-драйв..."
          >{{ old('message') }}</textarea>
          @error('message')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-top: 30px;">
          <p style="font-size: 12px; color: var(--muted); max-width: 420px;">
            Нажимая кнопку «Отправить заявку», вы соглашаетесь на обработку персональных данных.
          </p>
          <button type="submit" class="btn btn--red btn--lg">
            Отправить заявку
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
