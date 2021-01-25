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
                    echo "<div class='col-lg-4'><section><div class='header bg-secondary'><h2 class='title text-center'>" . get_dow($pdo, (get_now_day($pdo)) + $j) . "</h2></div><div class='main'>";
                    for ($l=1; $l <= 7; $l++) { 
                        echo "<div class='point'><div class='point_title'><p class='name'>" . get_subject($pdo, $l) ."</p><i class='time'>9:00 - 9:45</i></div><div class='point_desc'><p>Сделать дз</p></div></div>";
                    }
                    echo "</section></div>";
                }
                echo "</div>";
            ?>
        </main>
        

<?php
    include 'footer.php';
?>