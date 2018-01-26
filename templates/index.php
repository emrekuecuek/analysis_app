<?php
style('analysis_app','bootstrap.min');
script('analysis_app','bootstrap.min');
script('analysis_app','jquery.min');
script('analysis_app','echarts.min');
script('analysis_app','main');
?>
<div id="chartContainer" style="width: 100%;height: 100%;"></div>
<div class="container">
    <h2>En Buyuk Dosyalar</h2>
    <p>Depolama alanimdaki en buyuk dosyalar neler?</p>
    <table class="table">
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