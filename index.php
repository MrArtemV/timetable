<?php
    require_once 'db_connect.php';
    require_once 'query.php';
    include 'header.php';
?>
        <main class="container">
            <?php
                echo "<div class='row'>";
                for ($j=0; $j < 12; $j++) { 
                    echo "<div class='col-lg-4'><section><div class='header bg-secondary'><h2 class='title subj text-center'>" . get_dow($pdo, $nday +$j) . "</h2></div><div class='main round_bottom'>";
                    print_subjects(get_all($pdo, $nday +$j));
                    echo "</section></div>";
                }
                echo "</div>";
            ?>
        </main>
        

<?php
    include 'footer.php';
?>