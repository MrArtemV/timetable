<?php
    session_start();
    require_once 'db_connect.php';
    include 'header.php';
    require 'query.php';
?>
        <main class="container">
            <?php
                echo "<div class='row'>";
                for ($j=0; $j < 6; $j++) { 
                    echo "<div class='col-lg-4'><section><div class='header bg-secondary'><h2 class='title text-center'>" . get_dow($pdo, (now_day($pdo)) + $j) . "</h2></div><div class='main'>";
                    for ($l=0; $l < 7; $l++) { 
                        echo "<div class='point'><div class='point_title'><p class='name'>Труд</p><i class='time'>9:00 - 9:45</i></div><div class='point_desc'><p>Сделать дз</p></div></div>";
                    }
                    echo "</section></div>";
                }
                echo "</div>";
            ?>
                            <!--div class="point">
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
                            <h2 class="title text-center"></h2>
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
                </div-->
                <!--div class="col-lg-4">
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
            </div-->
        </main>
        

<?php
    include 'footer.php';
?>