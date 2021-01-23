<?php
    session_start();
    require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

        <!-- FontAwesome Icons -->
        <link rel="stylesheet" href="fontawesome/css/all.css">

        <!-- Google Fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;1,500&display=swap" rel="stylesheet">

        <!-- Main CSS -->
        <link rel="stylesheet" href="style.css">
        <title>Главная</title>
    </head>
    <body id="content">


        <header class="container-fluid sticky-top navbar-dark bg-dark">
            <nav class="container navbar navbar-expand-lg bg-faded">
                
                <!-- Бренд -->
                <a class="navbar-brand justify-content-around" href="#">Логотип</a>
                <!-- Ссылки -->
                <div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Переключатель навигации"><span class="navbar-toggler-icon"></span>
                    </button>
                    
                </div>
                <div class="collapse navbar-collapse justify-content-center" id="nav-content">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ссылка 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ссылка 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ссылка 3</a>
                        </li>
                    </ul>
                </div>
                <div class="theme-toggler justify-content-end">
                    <i class="fas fa-moon" style="font-size: 2rem;"></i>
                </div>
            </nav>
        </header>
        <main class="container">
            <div class="row">
                <div class="col-lg-4">
                    <section>
                        <div class="header bg-secondary">
                            <h2 class="title text-center">Пятница</h2>
                        </div>
                        <div class="main">
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">Труд</p>
                                    <i class="time">9:00 - 9:45</i>
                                </div>
                                <div class="point_desc">
                                    <p>Сделать дз</p>
                                </div>
                            </div>
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">Труд</p>
                                    <i class="time">9:55 - 10:40</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">Английский</p>
                                    <i class="time">10:50 - 11:35</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">Биология</p>
                                    <i class="time">11:55 - 12:40</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">Алгебра</p>
                                    <i class="time">13:00 - 13:45</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">География</p>
                                    <i class="time">13:55-14:40</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">Физ-ра</p>
                                    <i class="time">14:50-15:35</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section>
                        <div class="header bg-secondary">
                            <h2 class="title text-center">Суббота</h2>
                        </div>
                        <div class="main">
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">Химия</p>
                                    <i class="time">9:00 - 9:45</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">ОБЖ</p>
                                    <i class="time">9:55 - 10:40</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">Информатика</p>
                                    <i class="time">10:50 - 11:35</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">История</p>
                                    <i class="time">11:55 - 12:40</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">Изо</p>
                                    <i class="time">13:00 - 13:45</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">География</p>
                                    <i class="time">13:55-14:40</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">&nbsp;</p>
                                    <i class="time">&nbsp;</i>
                                </div>
                                <p class="point_desc"></p>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section>
                        <div class="header bg-secondary">
                            <h2 class="title text-center">Воскресенье</h2>
                        </div>
                        <div class="main">
                            <div class="point">
                                <div class="point_title">
                                    <p class="name">Выходной</p>
                                    <i class="time">&nbsp;</i>
                                </div>
                                <p class="point_desc">&nbsp;</p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
        <footer></footer>

        <script>
            let themetoggler = document.querySelector('.theme-toggler');
            let page = document.querySelector('#content');
            themetoggler.onclick = function () {
                themetoggler.classList.toggle('active');
                page.classList.toggle('dark')
            }
        </script>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
</html>