<?php
    function repeat($text, $num = 10)
    {
    echo "<ol>\r\n";
    for($i = 0; $i < $num; $i++)
    {
        echo "<li>$text </li>\r\n";
    }
    echo "</ol>";
    }
    repeat("I'm the best", 15);

    repeat("You're the man");
?>
