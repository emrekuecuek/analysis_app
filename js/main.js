$(document).ready(function () {


    window.onload = function() {
        var analysis_info = $.get(
            /**
             * @var object data
             */
            OC.generateUrl('/apps/analysis_app/getinfo'), function (data) {
           // var report = $.map(data, function(el) { return el });
            var allMimeTypes = [];
            var i = 0;
            $.each(data.mime_types, function(key, value) {
                allMimeTypes[i] = {y: value, label: key};
                i++;
            });

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Dosya Yüzdeleri"
                },
                data: [{
                    type: "pie",
                    startAngle: 240,
                    yValueFormatString: "##0.00\"%\"",
                    indexLabel: "{label} {y}",
                    dataPoints: allMimeTypes
                }]
            });
               return chart.render();
            });

    }


});



