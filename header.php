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
        <link rel="stylesheet" href="dark.css">
        <title>Главная</title>
    </head>
    <body id="content">
        <header class="container-fluid sticky-top navbar-dark bg-dark">
            <nav class="container navbar navbar-expand-lg bg-faded">
                
                <!-- Бренд -->
                <a class="navbar-brand justify-content-around" href="index.php">Логотип</a>
                <!-- Ссылки -->
                <div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Переключатель навигации"><span class="navbar-toggler-icon"></span>
                    </button>
                    
                </div>
                <div class="collapse navbar-collapse justify-content-center" id="nav-content">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="https://vk.com/club186200039">Группа ВК</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="subjlist.php">Предметы</a>
                        </li>
                        <?php
                            if ($_SESSION['user'] != NULL) {
                                echo "<li class='nav-item'><a class='nav-link' href='admin.php'>Панель управления</a></li>";
                            }
                        ?>
                        <li class="nav-item">
                            <?php
                                if ($_SESSION['user'] == NULL) {
                                    echo "<a class='nav-link' href='login.php'>Войти</a>";
                                }
                                else {
                                    echo "<a class='nav-link' href='exit.php'>Выйти</a>";
                                }
                            ?>
                        </li>
                        <div class="nav-item mob_toggler">
                            <p class="nav-link">Сменить тему</p>
                        </div>
                    </ul>
                </div>
                <div class="theme-toggler justify-content-end">
                    <i class="fas fa-moon" style="font-size: 2rem;"></i>
                </div>
            </nav>
        </header>