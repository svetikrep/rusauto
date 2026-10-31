# RUSAUTO — Модульное веб-приложение на Laravel

---


## Реализованные требования и архитектура

### 1. Роутинг, контроллеры и шаблоны (Blade)
* **Маршруты (`routes/web.php`):**
  * `GET /` — главная страница (`HomeController@index`).
  * `GET /catalog` — каталог с фильтрацией по марке, году и поиском по модели (`CarController@index`).
  * `GET /catalog/{car:slug}` — детальная карточка автомобиля с неявным связыванием модели по slug (`CarController@show`).
  * `POST /leads` — прием и обработка заявок на тест-драйв / бронирование (`LeadController@store`).
  * `POST /reviews` — отправка и сохранение отзыва (`ReviewController@store`).
  * `POST /session/clear-viewed` — очистка истории просмотров в сессии.
* **Модульные шаблоны Blade:**
  * `resources/views/layouts/app.blade.php` — базовый мастер-шаблон (meta, fonts, SVG sprite, flash-уведомления).
  * `resources/views/partials/header.blade.php` — адаптивная шапка и индикатор истории просмотров.
  * `resources/views/partials/hero.blade.php` — промо-секция с автомобилем и ключевыми преимуществами.
  * `resources/views/partials/catalog.blade.php` — сетка предложений автомобилей из базы данных.
  * `resources/views/partials/lead-form.blade.php` — форма обратной связи и бронирования с CSRF и валидацией.
  * `resources/views/partials/reviews.blade.php` — блок отзывов клиентов и форма добавления отзыва.
  * `resources/views/partials/recently-viewed.blade.php` — секция недавно просмотренных авто из сессии.
  * `resources/views/partials/contacts.blade.php` — контактная информация и интерактивная карта.
  * `resources/views/partials/footer.blade.php` — подвал со статистикой сессии.
  * `resources/views/cars/index.blade.php` — страница каталога с фильтрами.
  * `resources/views/cars/show.blade.php` — страница карточки конкретного автомобиля с таблицей характеристик.

---

### 2. Модели и миграции (База данных SQLite)
* **`Car` (`cars`):** хранит каталог автомобилей (марка, модель, slug, год, цена, бейдж, двигатель, КПП, привод, пробег, цвет, описание).
* **`Review` (`reviews`):** хранит отзывы клиентов (автор, текст, рейтинг 1-5 звезд, статус публикации).
* **`Lead` (`leads`):** хранит заявки пользователей с привязкой к конкретному авто (`car_id` foreign key).
* **Сидеры (`database/seeders/`):**
  * `CarSeeder` — заполнение базы моделями Audi Q5 L, RS6 Avant, Porsche Cayenne Coupe, BMW X5 M.
  * `ReviewSeeder` — перенос реальных отзывов из исходного `index.html`.

---

### 3. Прием и валидация данных из формы (POST)
* **FormRequest классы:**
  * `App\Http\Requests\StoreLeadRequest` — строгая валидация имени, номера телефона (regex РФ), существования ID автомобиля и текста сообщения.
  * `App\Http\Requests\StoreReviewRequest` — валидация имени, текста и рейтинга (1–5).
* **Безопасность:** защита от CSRF через токен `@csrf`.
* **Ошибки:** вывод индивидуальных ошибок под каждым полем `@error('field')` и общего блока ошибок.

---

### 4. Работа с сессиями (Session)
* **Flash-сообщения:** передача статусов `session()->flash('success', ...)` и `session()->flash('review_success', ...)` для всплывающих уведомлений после редиректа.
* **Сохранение состояния пользователя:**
  * Хранение списка просмотренных автомобилей `session()->put('recently_viewed', ...)` — авто выводятся в специальном блоке на главной.
  * Автозаполнение полей формы именем и телефоном из сессии для удобства повторных заявок.
  * Подсчет количества визитов и отправленных заявок в сессии (`session()->increment(...)`).

---

### 5. Создание и обработка событий (Events & Listeners)
* **Событие:** `App\Events\LeadCreated` — вызывается при создании новой заявки в `LeadController`.
* **Слушатель:** `App\Listeners\SendLeadNotification` — перехватывает событие, фиксирует полную информацию в `storage/logs/laravel.log` и симулирует отправку уведомления менеджеру.
* **Регистрация:** настроена в `AppServiceProvider::boot()`.

---

### 6. Git-репозиторий
* Репозиторий инициализирован локально (`git init -b main`).
* Добавлены все модули, контроллеры, миграции, сидеры, стили и шаблоны.
* Выполнен первый коммит.
* Настроен `.gitignore` (исключены временные файлы, кеш и vendor).
