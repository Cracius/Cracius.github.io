<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Проектикус Электроникус</title>
  
  <!-- Подключение шрифта -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous" />
  <link 
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap"
    rel="stylesheet"
  />

  <style>
    /* ------------------------------------
       Сброс базовых стилей и шрифтов
    --------------------------------------- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Roboto', sans-serif;
      color: #ffffff;
      background-color: #414344; /* тёмно-серый фон */
      line-height: 1.4;
    }
    img {
      max-width: 100%;
      height: auto;
      display: block;
    }
    ul {
      list-style: none;
    }
    a {
      text-decoration: none;
      color: inherit;
    }

    /* ------------------------------------
       Шапка сайта: видео + меню
    --------------------------------------- */
    header {
        position: relative;
        width: 100%;
        height: 400px; /* Установите подходящую высоту */
        overflow: hidden;
        background-color: #000;
    }
    header video {
        width: 100%;
        height: 100%; /* Растягиваем видео на всю высоту контейнера */
        object-fit: cover; /* Опционально: чтобы видео заполняло контейнер без искажений */
        display: block;
    }
    /* Полупрозрачная плашка поверх видео */
    .header-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      z-index: 1;
    }
    /* Контейнер для навигации */
    .header-nav {
      position: absolute;
      top: 10px;
      left: 0;
      width: 100%;
      z-index: 2;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 15px;
      box-sizing: border-box;
    }
    /* Логотип */
    .logo {
      /* Можно удалить текстовые стили, если используете только изображение */
      /* font-weight: 700;
      font-size: 1.2rem;
      color: #fff; */
    }
    .logo img {
      max-height: 50px; /* Регулируйте по необходимости */
      width: auto;
    }

    /* Основная навигация (десктоп) */
    nav {
      position: relative;
    }
    .nav-list {
      display: flex;
      gap: 20px;
    }
    .nav-list > li {
      position: relative;
    }
    .nav-list > li > a {
      color: #fff;
      font-weight: 400;
      padding: 5px 0;
    }
    /* Выпадающее меню */
    .nav-submenu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: rgba(255, 255, 255, 0.9);
      padding: 10px;
      border-radius: 4px;
    }
    .nav-submenu li a {
      color: #333;
      display: block;
      padding: 5px 0;
    }
    .nav-list > li:hover .nav-submenu {
      display: block;
    }

    /* Гамбургер для мобильной версии */
    .hamburger {
      display: inline-block;
      width: 30px;
      height: 22px;
      position: relative;
      cursor: pointer;
      z-index: 3;
    }
    .hamburger span {
      display: block;
      width: 100%;
      height: 3px;
      background-color: #fff;
      margin: 4px 0;
      transition: 0.3s ease;
    }
    /* Мобильное меню (изначально скрыто) */
    .mobile-nav {
      display: none;
      flex-direction: column;
      background-color: #111;
      padding: 10px;
      gap: 10px;
      position: absolute;
      top: 50px;
      right: 15px;
      border-radius: 4px;
      z-index: 2;
    }
    .mobile-nav a {
      color: #fff;
    }

    /* ------------------------------------
       СЕКЦИЯ СО СЛАЙДЕРОМ (Исправленный CSS)
    --------------------------------------- */
    .slider-section {
      padding: 20px 15px;
      background-color: transparent;
    }
    .slider-section h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #fff;
    }
    .slider-container {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
        height: 400px; /* Установите подходящую высоту */
    }

    /* Сами слайды */
    .slide {
        position: absolute; /* Накладываем слайды друг на друга */
        top: 0;
        left: 0;
        width: 100%;
        opacity: 0;
        transition: opacity 0.5s ease;
        display: block; /* Чтобы position:absolute работал корректно */
    }
    .slide.active {
        opacity: 1;
    }
    /* Кнопки переключения (можно кастомизировать) */
    .slider-buttons {
      margin-top: 10px;
      text-align: center;
    }
    .slider-buttons button {
      margin: 0 5px;
      padding: 8px 12px;
      cursor: pointer;
      border: none;
      color: #fff;
      background-color: #333;
      border-radius: 4px;
      font-weight: 600;
    }
    .slider-buttons button:hover {
      background-color: #555;
    }

    /* ------------------------------------
       Форма контактов
    --------------------------------------- */
    .contact-section {
      padding: 20px 15px;
    }
    .contact-section h2 {
      margin-bottom: 10px;
      text-align: center;
      color: #fff;
    }
    form {
      max-width: 600px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    label {
      display: flex;
      flex-direction: column;
      font-weight: 500;
      margin-bottom: 5px;
      color: #fff;
    }
    input, textarea {
      padding: 8px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-top: 5px;
    }

  select {
    padding: 8px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-top: 5px;
    background-color: #fff;
    color: #000;
    appearance: none;
    width: 100%;
    box-sizing: border-box;
  }

  /* Мульти‑селект: плюс высота */
  select[multiple] {
    height: 120px;
    overflow-y: auto;
  }
    
    button[type="submit"] {
      width: 150px;
      padding: 10px;
      font-size: 1rem;
      font-weight: 700;
      color: #fff;
      background-color: #333;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      align-self: center;
    }
    button[type="submit"]:hover {
      background-color: #555;
    }
    /* Сообщения при отправке формы */
    #formResponse {
      text-align: center;
      margin-top: 10px;
      font-weight: 700;
      color: #fff;
    }

    /* ------------------------------------
       Подвал
    --------------------------------------- */
    footer {
      background-color: #222;
      color: #fff;
      padding: 15px;
      text-align: center;
    }

    /* ------------------------------------
       Адаптив. 
       Mobile-first: базовые стили 
       для мобильной ширины.
       Дальше — медиа-запросы
    --------------------------------------- */
    @media (min-width: 768px) {
      .hamburger {
        display: none;
      }
      .mobile-nav {
        display: none !important;
      }
      .nav-list {
        display: flex;
      }
    }
  </style>
</head>
<body>

  <!-- ШАПКА С ВИДЕО -->
  <header>
    <video autoplay muted loop playsinline>
        <source src="video/video.mp4" type="video/mp4">
        
        Ваш браузер не поддерживает видео.
      </video>
    <div class="header-overlay"></div>

    <div class="header-nav">
      <div class="logo">
        <!-- Логотип (картинка). При необходимости замените путь -->
        <img src="images/logo.png" alt="Логотип" />
      </div>
      <!-- Кнопка «гамбургер» (только мобильная версия) -->
      <div class="hamburger" id="hamburgerBtn">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!-- Навигация (десктопная) -->
      <nav>
        <ul class="nav-list">
          <li><a href="#home">Главная</a></li>
          <li>
            <a href="#services">Услуги</a>
            <!-- Подменю -->
            <ul class="nav-submenu">
              <li><a href="#diagnostics">Диагностика</a></li>
              <li><a href="#windows">Переустановка Windows</a></li>
              <li><a href="#thermal">Замена термопасты</a></li>
            </ul>
          </li>
          <li><a href="#about">О нас</a></li>
          <li><a href="#contact">Контакты</a></li>
        </ul>
      </nav>
      <!-- Мобильное меню -->
      <nav class="mobile-nav" id="mobileNav">
        <a href="#home">Главная</a>
        <a href="#services">Услуги</a>
        <a href="#about">О нас</a>
        <a href="#contact">Контакты</a>
      </nav>
    </div>
  </header>

  <!-- СЕКЦИЯ СО СЛАЙДЕРОМ -->
  <section class="slider-section" id="services">
    <h2>Наши услуги</h2>
    <div class="slider-container" id="mainSlider">
      <!-- Слайды -->
      <div class="slide active">
        <img src="images/slider1.jpg" alt="Слайд 1">
      </div>
      <div class="slide">
        <img src="images/slider2.jpg" alt="Слайд 2">
      </div>
      <div class="slide">
        <img src="images/slider6.jpg" alt="Слайд 3">
      </div>
    </div>
    <!-- Кнопки «Назад / Вперёд» -->
    <div class="slider-buttons">
      <button id="prevBtn">Назад</button>
      <button id="nextBtn">Вперёд</button>
    </div>
  </section>

  <!-- ДЕТАЛЬНОЕ ОПИСАНИЕ УСЛУГ -->
  <section id="diagnostics" style="padding: 20px 15px;">
    <h2>Диагностика</h2>
    <img 
      src="images/diagnostics.jpg" 
      alt="Диагностика компьютера" 
      style="max-width: 300px; display:block; margin-bottom:10px;"
    />
    <p>
      Мы проведём полноценную проверку всех аппаратных и программных компонентов 
      вашего компьютера. Определим причину неполадок и предложим оптимальное решение.
    </p>
    <p><strong>Цена:</strong> 500 руб.</p>
  </section>

  <section id="windows" style="padding: 20px 15px;">
    <h2>Переустановка Windows</h2>
    <img 
      src="images/windows.jpg" 
      alt="Переустановка Windows" 
      style="max-width: 300px; display:block; margin-bottom:10px;"
    />
    <p>
      Полная переустановка операционной системы Windows с сохранением пользовательских данных 
      (по согласованию). Установка необходимых драйверов и базового набора программ.
    </p>
    <p><strong>Цена:</strong> 1000 руб.</p>
  </section>

  <section id="thermal" style="padding: 20px 15px;">
    <h2>Замена термопасты</h2>
    <img 
      src="images/thermal.jpg" 
      alt="Замена термопасты" 
      style="max-width: 300px; display:block; margin-bottom:10px;"
    />
    <p>
      Замена термопасты на процессоре и/или видеочипе для улучшения теплоотвода. 
      Рекомендуется проводить регулярно для поддержания стабильной температуры.
    </p>
    <p><strong>Цена:</strong> 300 руб.</p>
  </section>

  <!-- Блок «О нас» -->
  <section style="padding: 20px 15px;" id="about">
    <h2 style="text-align:center; margin-bottom:10px;">О нас</h2>
    <p style="max-width:700px; margin:0 auto;">
      Мы — современная компания, предоставляющая широкий спектр услуг в самых разных областях. 
      Наша команда — это профессионалы, увлечённые своим делом. Мы работаем для того, чтобы 
      каждый клиент оставался доволен результатом.
    </p>
  </section>

  <!-- ФОРМА -->
  <!DOCTYPE html>
    <form action="" method="post" class="form">
      <div class="head">
        <h2><b>Форма</b></h2>
      </div>

      <div class="mess"><?php if(isset($messages['success'])) echo $messages['success']; ?></div>
      <div class="mess mess_info"><?php if(isset($messages['info'])) echo $messages['info']; ?></div>
      <div>
        <label> <input name="fio" class="input <?php echo ($errors['fio'] != NULL) ? 'red' : ''; ?>" value="<?php echo $values['fio']; ?>" type="text" placeholder="ФИО" /> </label>
        <div class="error"> <?php echo $messages['fio']?> </div>
      </div>
      
      <div>
        <label> <input name="number" class="input <?php echo ($errors['number'] != NULL) ? 'red' : ''; ?>" value="<?php echo $values['number']; ?>" type="tel" placeholder="Номер телефона" /> </label>
        <div class="error"> <?php echo $messages['number']?> </div>
      </div>
      
      <div>
        <label> <input name="email" class="input <?php echo ($errors['email'] != NULL) ? 'red' : ''; ?>" value="<?php echo $values['email']; ?>" type="text" placeholder="Почта" /> </label>
        <div class="error"> <?php echo $messages['email']?> </div>
      </div>
      
      <div>
        <label>
          <input name="date" class="input <?php echo ($errors['date'] != NULL) ? 'red' : ''; ?>" value="<?php if(strtotime($values['date']) > 100000) echo $values['date']; ?>" type="date" />
          <div class="error"> <?php echo $messages['date']?> </div>
        </label>
      </div>
      
      <div>
        <div>Пол</div>
        <div class="mb-1">
          <label>
            <input name="radio" class="ml-2" type="radio" value="male" <?php if($values['radio'] == 'M') echo 'checked'; ?>/>
            <span class="<?php echo ($errors['radio'] != NULL) ? 'error' : ''; ?>"> Мужской </span>
          </label>
          <label>
            <input name="radio" class="ml-4" type="radio" value="female" <?php if($values['radio'] == 'W') echo 'checked'; ?>/>
            <span class="<?php echo ($errors['radio'] != NULL) ? 'error' : ''; ?>"> Женский </span>
          </label>
        </div>
        <div class="error"> <?php echo $messages['radio']?> </div>
      </div>
      
      <div>
        <div>Любимый язык программирования</div>
        <select class="my-2 <?php echo ($errors['language'] != NULL) ? 'red' : ''; ?>" name="language[]" multiple="multiple">
          <option value=1 <?php echo (in_array('Pascal', $languages)) ? 'selected' : ''; ?>>Pascal</option>
          <option value=2 <?php echo (in_array('C', $languages)) ? 'selected' : ''; ?>>C</option>
          <option value=3 <?php echo (in_array('C++', $languages)) ? 'selected' : ''; ?>>C++</option>
          <option value=4 <?php echo (in_array('JavaScript', $languages)) ? 'selected' : ''; ?>>JavaScript</option>
          <option value=5 <?php echo (in_array('PHP', $languages)) ? 'selected' : ''; ?>>PHP</option>
          <option value=6 <?php echo (in_array('Python', $languages)) ? 'selected' : ''; ?>>Python</option>
          <option value=7 <?php echo (in_array('Java', $languages)) ? 'selected' : ''; ?>>Java</option>
          <option value=8 <?php echo (in_array('Haskel', $languages)) ? 'selected' : ''; ?>>Haskel</option>
          <option value=9 <?php echo (in_array('Clojure', $languages)) ? 'selected' : ''; ?>>Clojure</option>
          <option value=10 <?php echo (in_array('Scala', $languages)) ? 'selected' : ''; ?>>Scala</option>
        </select>
        <div class="error"> <?php echo $messages['language']?> </div>
      </div>
      
      <div class="my-2">
        <div>Биография</div>
        <label>
          <textarea name="bio" class="input <?php echo ($errors['bio'] != NULL) ? 'red' : ''; ?>" placeholder="Биография"><?php echo $values['bio']; ?></textarea>
          <div class="error"> <?php echo $messages['bio']?> </div>
        </label>
      </div>
      
      <div>
        <label>
            <input name="check" type="checkbox" <?php echo ($values['check'] != NULL) ? 'checked' : ''; ?>/>
              С контрактом ознакомлен(а)
          <div class="error"> <?php echo $messages['check']?> </div>
        </label>
      </div>

       <?php
          if($log) echo '<button class="button edbut" type="submit">Изменить</button>';
          else echo '<button class="button" type="submit">Отправить</button>';
          if($log) echo '<button class="button" type="submit" name="logout_form">Выйти</button>'; 
          else echo '<a class="btnlike" href="login.php" name="logout_form">Войти</a>';
        ?>
    </form>

  <!-- ПОДВАЛ -->
  <footer>
    <p>© 2025 Cracur Electronics. Все права защищены.</p>
  </footer>

  <!-- Основной скрипт -->
  <!-- jslint browser: true, esversion: 6 -->
  <script>
  "use strict";

  document.addEventListener("DOMContentLoaded", function() {
    // Мобильное меню (гамбургер)
    const hamburgerBtn = document.getElementById("hamburgerBtn");
    const mobileNav = document.getElementById("mobileNav");

    hamburgerBtn.addEventListener("click", function() {
      if (mobileNav.style.display === "flex") {
        mobileNav.style.display = "none";
      } else {
        mobileNav.style.display = "flex";
      }
    });

    // Простой слайдер на JS (без Slick)
    const slides = document.querySelectorAll(".slider-container .slide");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    let currentIndex = 0;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.toggle("active", i === index);
      });
    }

    // Инициализация первого слайда
    showSlide(currentIndex);

    // Кнопки «вперёд / назад»
    prevBtn.addEventListener("click", () => {
      currentIndex = (currentIndex - 1 + slides.length) % slides.length;
      showSlide(currentIndex);
    });
    nextBtn.addEventListener("click", () => {
      currentIndex = (currentIndex + 1) % slides.length;
      showSlide(currentIndex);
    });
    
    document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("contactForm");
    const out = document.getElementById("formResponse");
    form.addEventListener("submit", e => {
      e.preventDefault();
      const f = e.target;
      const data = {
        fio: f.fio.value,
        number: f.number.value,
        email: f.email.value,
        date_r: f.date_r.value,
        male: f.male.value,
        biography: f.biography.value,
        langs: Array.from(f.querySelectorAll('select.languages option:checked')).map(o => o.value)
      };
      if (localStorage.login && localStorage.password) {
        data.login = localStorage.login;
        data.password = localStorage.password;
      }
      fetch('back.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify(data)
      })
      .then(r => r.json())
      .then(resp => {
        if (resp.success) {
          if (resp.login)
	  {
            localStorage.login = resp.login;
  		localStorage.password = resp.password;
  		const params = new URL(resp.profileUrl).searchParams;
  		const userId = params.get('id');
		if (userId) {
    			document.cookie = 'user_id=${userId}; path=/;';
    			window.location.href = 'profile.php';
  		}
          } else {
            // при обновлении просто показываем сообщение
            out.textContent = resp.message;
          }
          form.reset();
        } else {
          out.textContent = resp.errors.join('; ');
        }
      })
      .catch(err => out.textContent = 'Ошибка: ' + err.message);
    });
  });
  });
  </script>

</body>
</html>