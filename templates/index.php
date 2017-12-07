<?php
echo "<div id='chartContainer'>";


    foreach ($_['biggest_files'] as $file) {
        /***
         * @var \OCP\Files\Node $file
         */
        echo $file->getPath()." ".$file->getSize(). $file->getMimetype() ."<br>";

    }
    script('analysis_app','library');
    script('analysis_app','main');
    echo print_r($_['mime_types']);

    echo "</div>";






