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
                    echo "<div class='col-lg-4'><section><div class='header bg-secondary'><h2 class='title text-center'>" . get_dow($pdo, $nday +$j) . "</h2></div><div class='main'>";
                    print_subjects(get_subject($pdo, get_sid(get_main($pdo, $nday + $j))), $time, processing_homework($pdo, get_homework($pdo, $nday +$j)));
                    echo "</section></div>";
                }
                echo "</div>";
            ?>
        </main>
        

<?php
    include 'footer.php';
?>