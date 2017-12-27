<div id='chartContainer'>
    <?php
    foreach ($_['biggest_files'] as $file) {
        /***
         * @var \OCP\Files\Node $file
         */
        echo $file->getPath() . " " . $file->getSize() . " " .$file->getMimetype();
        echo "<br>";
    }
    foreach ($_['mime_types'] as $index => $file) {
        /**
         * @var array
         */
        echo $index. "=>" . $file . "<br>";
    }
    ?>
    <br>
    <?php
       script('analysis_app','library');
       script('analysis_app','main');
    ?>
    </div>

