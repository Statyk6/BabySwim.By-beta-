<div class="flexbox-right">
    <div class="flexbox-right-content-1">
        <a href="https://t.me/babyswimby" target="_blank"><img class="social-icons" src="/views/images/Telegram.png" alt="Мы в телеграм"></a>
        <a href="https://www.instagram.com/babyswim.by/" target="_blank"><img class="social-icons" src="/views/images/Instagram.png" alt="Мы в инстаграм"></a>
        <a href="https://www.youtube.com/user/focusMANify" target="_blank"><img class="social-icons" src="/views/images/Youtube.png" alt="Мы в ютуб"></a>
    </div>

    <div class="flexbox-right-content-2" id="login-form">
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
            echo '<h2>Авторизация</h2>';
        ?>
            <form action="/controllers/actionLogin.php" method="POST" id="login-form-element">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="button-submit">Вход</button><br><br>
            </form>
            <p class="infoMsg">
                <b>Преимущества регистрации:</b><br>
                - Отменяйте бронь в 1 клик<br>
                - Накапливайте скидочные баллы<br>
                - Просматривайте свою статистику<br>
            </p>
            <button class="button-green" type="button" onclick="window.location.href = '#'">Запись без регистрации</button><br>
            <button class="button-nosubmit" type="button" onclick="window.location.href = '/register'">Регистрация</button>
        <?php
        }
        ?>
    </div>
    <div class="flexbox-right-content-3">
        <h2>Новости</h2>
    </div>
</div>