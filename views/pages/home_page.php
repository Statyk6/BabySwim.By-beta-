<?php 
    /* 
        Project: Babyswim.by (PHP 8.1, MySQL 8.0, Memcached-1.6)
        Developer - Alexandr Kravets
        https://t.me/statyk7
        job.kravets@gmail.com
    */
    $title = "Школа раннего плавания (Грудничкового плавания) в Минске";
    require "views/head.php"; // Подключаем главные html теги
    require "views/left-side.php"; // Подключаем левую часть сайта
?>

        <div class="flexbox-center">
            <div class="flexbox-center-content-1">
                <button class="button-filials" type="button" onclick="window.location.href = '/surganova'">Сурганова 28а</button>
                <button class="button-filials" type="button" onclick="window.location.href = '/odoevskogo'">Одоевского 10к6</button>
            </div>

            <!-- START: SLIDER -->
            <div class="flexbox-center-content-2">
                <div class="sim-slider">
                    <ul class="sim-slider-list">
                     <li class="sim-slider-element"><img src="/views/images/slides/slide-1.png" alt="0"></li>
                        <li class="sim-slider-element"><img src="/views/images/slides/slide-1.png" alt="1"></li>
                        <li class="sim-slider-element"><img src="/views/images/slides/slide-1.png" alt="2"></li>
                        <li class="sim-slider-element"><img src="/views/images/slides/slide-1.png" alt="3"></li>
                        <li class="sim-slider-element"><img src="/views/images/slides/slide-1.png" alt="4"></li>
                        <li class="sim-slider-element"><img src="/views/images/slides/slide-1.png" alt="5"></li>
                    </ul>
                    <div class="sim-slider-arrow-left"></div>
                    <div class="sim-slider-arrow-right"></div>
                    <div class="sim-slider-dots"></div>
                  </div>
            </div>
            <!-- END: SLIDER -->

            <div class="flexbox-center-content-3">
                <h2>Добро пожаловать на сайт школы плавания Babyswim.by</h2>
                <h3>
                    Выбирая наши услуги — Вы выбираете здоровье вашего ребенка!<br>
                    Мы научим вашего малыша плавать и нырять в раннем возрасте!
                </h3>
                <p>
                    • Вода не содержит хлор!<br>
                    • Обязательно наличие медицинских справок!<br>
                    • Опыт преподавания более 10 лет!<br>
                    • Тренера в воде с детьми от 2 месяцев до 6 лет!<br>
                    • Температура воды для детей от 32 градусов!
                </p>
                <div class="certificates">
                    <a href="/views/images/certificates/1.png" target="_blank"><img src="/views/images/certificates/1.png" alt="Мы в телеграм"></a>
                    <a href="/views/images/certificates/2.png" target="_blank"><img src="/views/images/certificates/2.png" alt="Мы в инстаграм"></a>
                    <a href="/views/images/certificates/3.png" target="_blank"><img src="/views/images/certificates/3.png" alt="Мы в ютуб"></a>
                </div>
                <p>
                    Учимся плавать раньше, чем ходить — этот девиз сейчас весьма популярен у мам.<br>
                    Но вместе с тем, методика раннего плавания рождает у родителей и множество вопросов: не вредно ли это, не станет ли для малыша трудным испытанием, и, в конце концов, зачем ему это вообще нужно?
                    <br><br> 
                    Многие уверены в том, что плавание с грудничкового возраста способствует гармоничному развитию младенца, служит залогом его дальнейшего здоровья и физической подготовки, а также средством избежать проблем с обучением плаванию в старшем возрасте. Однако у плавания для самых маленьких есть и противники.
                    <br><br>
                    Поскольку в водной среде плод обитает еще в животе у мамы, у новорожденного малыша сохраняется инстинкт плавания, а вновь погружаясь в воду, он обретает привычную обстановку. Непосредственной пользой этого процесса многие специалисты считают закаливание и психомоторное развитие. Ранее плавание очень полезно детям, у которых на первых неделях жизни был диагностирован гипертонус.
                    <br><br>
                    Поскольку в воде происходит естественный массаж мышц и кожи, укрепляются и опорно-двигательная, нервная и дыхательная системы.
                    Хорошо развивается сердечно-сосудистый аппарат, улучшается кровоснабжение. Среди других полезных аспектов называют общее расслабление и улучшение обменных процессов. Это помогает бороться со многими детскими, неприятными для родителей явлениями.Ну и наконец, улучшаются сон и аппетит, то, о чем тревожатся почти все мамы.
                    <br><br>
                    Что касается эмоциональных трудностей и психологических стрессов, то это, скорее, проблемы обеспокоенных родителей, чем малышей. Педиатры уверены, что раннее плавание дарит малышу только положительные эмоции. 
                    «Плавающие» дети чаще улыбаются, растут более энергичными и активными по сравнению с их «сухопутными» сверстниками.
                    <br><br>
                    Ранее плавание служит неплохой профилактикой частого детского страха перед водой и последующих проблем с купанием. 
                    А еще помогает маме и малышу установить более полноценный контакт и взаимопонимание, поскольку во время приятных занятий родители учатся лучше чувствовать ребенка и понимать язык его «младенческих жестов».
                </p>
            </div>
        </div>

<!-- подключение слайдера -->
<script src="/views/js/sim-slider.js"></script>
<!-- вызов слайдера -->
<script>new Sim()</script>

<!-- Подключаем правую часть сайта -->
<?php require "views/right-side.php"; ?>