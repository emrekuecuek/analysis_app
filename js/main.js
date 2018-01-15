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
            console.log(data.mime_types);
            for (mimeTypes in data.mime_types){
                allMimeTypes[i] = {y: data.mime_types[mimeTypes], label: data.mime_types};
                i++;
            }


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
                    dataPoints: allMimeTypes,

                }]
            });

               return chart.render();
            });

    }


});



