$(document).ready(function () {

    window.onload = function() {
        var analysis_info = $.get(
            /**
             * @var object data
             */
            OC.generateUrl('/apps/analysis_app/getinfo'), function (data) {
                alert("Data loaded: " + data);
                return data;
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
                    dataPoints: [
                        {y: 10, label: ""}
                    ]
                }]
            });
            chart.render();


        }


});



