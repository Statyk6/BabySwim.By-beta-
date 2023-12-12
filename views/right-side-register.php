<div class="flexbox-right">
    <div class="flexbox-right-content-1">
        <a href="https://t.me/babyswimby" target="_blank"><img class="social-icons" src="/views/images/Telegram.png" alt="Мы в телеграм"></a>
        <a href="https://www.instagram.com/babyswim.by/" target="_blank"><img class="social-icons" src="/views/images/Instagram.png" alt="Мы в инстаграм"></a>
        <a href="https://www.youtube.com/user/focusMANify" target="_blank"><img class="social-icons" src="/views/images/Youtube.png" alt="Мы в ютуб"></a>
    </div>
    <div class="flexbox-right-content-2" id="register-form">
    <?php
        if (isset($_SESSION['user']) && $_SESSION['superuser'] == false && $_SESSION['expire'] > time()) {
            // Сессия пользователя существует и не истекла
            $user = $_SESSION['user'];
            echo '<h2>Личный кабинет</h2>';
            echo '<p class="infoMsg"><b>Здравствуйте, ' . $user['name'] . '</b><br>Тел.: ' . $user['phone'] . '<br>Е-mail: ' . $user['email'] . '</p><br>';
            echo '<p class="helpMsg"><b>Ваши баллы: ' . $user['score'] . '</b></p><br>';
            echo '<p class="infoMsg">Накопленные баллы можно применить для получения скидки на занятие или абонемент.<br><br>50 баллов = скидка 5%<br>100 баллов = скидка 10%<br><br>За 1 занятие начисляется 10 баллов.</p>';
            echo "<button class='button-green' type='button' onclick=\"window.location.href='/new_reservation'\">Новая запись в группу</button><br>";
            echo "<button class='button-submit' type='button' onclick=\"window.location.href='#'\">Статистика посещений</button><br><br>";
            echo "<button class='button-nosubmit' type='button' onclick=\"window.location.href='/controllers/actionLogout.php'\">Выход</button>";
        } else if (isset($_SESSION['user']) && $_SESSION['superuser'] == true && $_SESSION['expire'] > time()) {
            // Сессия пользователя существует и не истекла, и у пользователя есть права администратора
            $user = $_SESSION['user'];
            $superuser = $_SESSION['superuser'];
            echo '<h2>Админ-панель</h2>';
            echo '<p class="infoMsg"><b>Здравствуйте, ' . $user['name'] . '!</b><br>Выберите что посмотреть:</p>';
            echo "<button class='button-green' type='button' onclick=\"window.location.href='/reservations'\">Список бронирований</button><br>";
            echo "<button class='button-green' type='button' onclick=\"window.location.href='/users'\">Список пользователей</button><br><br>";
            echo '<p class="infoMsg">Выберите чем управлять:</p>';
            echo "<button class='button-submit' type='button' onclick=\"window.location.href='/branches'\">Филиалы</button><br>";
            echo "<button class='button-submit' type='button' onclick=\"window.location.href='/groups'\">Группы</button><br>";
            echo "<button class='button-submit' type='button' onclick=\"window.location.href='/seats'\">Места</button><br>";
            echo "<button class='button-submit' type='button' onclick=\"window.location.href='/timetables'\">Расписание</button><br>";
            echo "<button class='button-submit' type='button' onclick=\"window.location.href='/costs'\">Стоимость</button><br><br>";
            echo "<button class='button-nosubmit' type='button' onclick=\"window.location.href='/controllers/actionLogout.php'\">Выход</button>";
        } else {
            // Сессия пользователя не существует, отобразите форму входа
            echo '<h2>Регистрация</h2>';
        ?>
        <form action="/controllers/actionRegister.php" method="POST">
            <div class="form-group">
                <label for="new_name">Введите Ваше имя</label>
                <label class="help-reg">Используйте только буквы</label>
                <input type="text" id="new_name" name="new_name" required>
            </div>
            <div class="form-group">
                <label for="new_email">Введите Ваш e-mail</label>
                <label class="help-reg">Должен быть в формате example@gmail.com</label>
                <input type="email" id="new_email" name="new_email" required>
            </div>
            <div class="form-group">
                <label for="new_password">Придумайте надежный пароль</label>
                <label class="help-reg">От 8 английских букв содержащий символы, цифры и одну заглавную букву. Пример: Lfvjxrf5!</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="retype_password">Повторите пароль</label>
                <label class="help-reg">Пароли должны совпадать</label>
                <input type="password" id="retype_password" name="retype_password" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Ваш телефон</label>
                <label class="help-reg">Должен быть в формате +375*******</label>
                <input type="tel" id="phone_number" name="phone_number" value="+375" required>
            </div>
            <button type="submit" class="button-submit">Зарегистрироваться</button>
        </form>
        <button class="button-nosubmit" type="button" onclick="window.location.href = '/'">На страницу входа</button>
        <?php
        }
        ?>
    </div>
    <div class="flexbox-right-content-3">
        <h2>Новости</h2>
    </div>
</div>