<section class="reviews" id="reviews">
  <div class="container">
    <h2>Отзывы наших клиентов</h2>

    <div class="reviews__grid">
      <div class="rating">
        <div class="rating__top">
          <span class="stars stars--white">
            <svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg>
          </span>
          <span class="rating__score">{{ $avgRating ?? '4.9' }}</span>
        </div>
        <div class="rating__bottom">
          <div class="rating__count">{{ $reviewsCount ?? '2K+' }}</div>
          <p>довольных клиентов</p>
          <a class="btn btn--white btn--block" href="#add-review">Оставить отзыв</a>
        </div>
      </div>

      @foreach($reviews as $review)
        <article class="review">
          <div class="review__author">
            <span class="avatar"><svg><use href="#i-smile"/></svg></span>
            <span>{{ $review->author_name }}</span>
          </div>
          <p>{{ $review->comment }}</p>
          <span class="stars">
            @for($i = 1; $i <= 5; $i++)
              @if($i <= $review->rating)
                <svg style="color: #f7b500;"><use href="#i-star"/></svg>
              @else
                <svg style="color: #4a4b52;"><use href="#i-star"/></svg>
              @endif
            @endfor
          </span>
        </article>
      @endforeach
    </div>

    <div class="review-form-card" id="add-review">
      <h3 style="font-family: var(--font-display); margin-bottom: 8px;">Поделитесь вашим впечатлением</h3>
      <p style="color: var(--muted-light); margin-bottom: 20px;">Ваше мнение помогает нам становиться лучше.</p>

      <form action="{{ route('reviews.store') }}" method="POST" novalidate>
        @csrf

        <div class="form-grid-2">
          <div class="form-group">
            <label class="form-label" for="review-author">Ваше имя *</label>
            <input 
              type="text" 
              name="author_name" 
              id="review-author" 
              class="form-input @error('author_name') is-invalid @enderror" 
              placeholder="Например, Александр" 
              value="{{ old('author_name', session('client_name')) }}" 
              required
            >
            @error('author_name')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Оценка сервиса *</label>
            <div class="rating-input">
              <input type="radio" id="star5" name="rating" value="5" {{ old('rating', '5') == '5' ? 'checked' : '' }}><label for="star5" title="5 звезд">&#9733;</label>
              <input type="radio" id="star4" name="rating" value="4" {{ old('rating') == '4' ? 'checked' : '' }}><label for="star4" title="4 звезды">&#9733;</label>
              <input type="radio" id="star3" name="rating" value="3" {{ old('rating') == '3' ? 'checked' : '' }}><label for="star3" title="3 звезды">&#9733;</label>
              <input type="radio" id="star2" name="rating" value="2" {{ old('rating') == '2' ? 'checked' : '' }}><label for="star2" title="2 звезды">&#9733;</label>
              <input type="radio" id="star1" name="rating" value="1" {{ old('rating') == '1' ? 'checked' : '' }}><label for="star1" title="1 звезда">&#9733;</label>
            </div>
            @error('rating')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="review-comment">Ваш отзыв *</label>
          <textarea 
            name="comment" 
            id="review-comment" 
            class="form-textarea @error('comment') is-invalid @enderror" 
            rows="3" 
            placeholder="Опишите ваши впечатления от покупки или тест-драйва..." 
            required
          >{{ old('comment') }}</textarea>
          @error('comment')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <div style="text-align: right;">
          <button type="submit" class="btn btn--red">
            Опубликовать отзыв
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
