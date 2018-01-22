$(document).ready(function () {


    window.onload = function() {
        var analysis_info = $.get(
            /**
             * @var object data
             * @var FileModel data.biggest_files
             * @var FileModel data.mime_types
             */
            OC.generateUrl('/apps/analysis_app/getinfo'), function (data) {
                var allMimeTypes = [], i=0,totalMimeTypeSize=0;
                $.each(data.mime_types, function (key,value) {
                    totalMimeTypeSize = +totalMimeTypeSize + +value;
                });
                $.each(data.mime_types, function (key,value) {
                    data.mime_types[key] = (value/totalMimeTypeSize)*100;
                });
                $.each(data.mime_types, function(key, value) {
                    allMimeTypes[i] = {value: value, name: key};
                    i++;
                });

                var mimeTypesChart = echarts.init(document.getElementById('chartContainer'));
                var option = {
                    title : {
                        text: 'Dosya Tipi Yuzdeleri',
                        subtext: 'Hangi dosya uzantisina sahip dosyalar Kovan\'ımda yuzdelik olarak ne kadar yer tutuyor?',
                        x:'center'
                    },
                    tooltip : {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    legend: {
                        orient: 'vertical',
                        left: 'left',
                        data: allMimeTypes
                    },
                    series : [
                        {
                            name: '',
                            type: 'pie',
                            radius : '55%',
                            center: ['50%', '60%'],
                            data: allMimeTypes,
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }
                    ]
                };
                console.log(data.biggest_files);
                mimeTypesChart.setOption(option);

            });
        }
});



