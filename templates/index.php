<?php
style('analysis_app','table');
script('analysis_app','echarts.min');
script('analysis_app','main');
?>

<div id="chartContainer" style="width: 100%;height: 100%;"></div>
<div class="container" style="width: 100%;">
    <h2>En Buyuk Dosyalar</h2>
        <p>Depolama alanimdaki en buyuk dosyalar neler?</p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>File</th>
            <th>Size (Byte)</th>
        </tr>
        </thead>
        <tbody id="listTableData">
        <tr>
        </tr>
        </tbody>
    </table>
</div>