<?php
//script('analysis_app','echarts.min');
//script('analysis_app','main');

echo "<div id='chartContainer'>";
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
    echo $index . "=>" . $file . "<br>";
}
?>





<div id="chartContainer" style="width: 100%;height: 100%;"></div>
<div id="listContainer" style="width: 100%;height: 100%;"></div>