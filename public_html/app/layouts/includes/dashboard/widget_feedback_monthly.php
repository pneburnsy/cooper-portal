<?php

survey_all_1month(false);
surveyaveragemonth($survey_1month);

function surveyaveragemonth($variable) {
    global $excellent;
    $excellent = 0;
    global $good;
    $good = 0;
    global $acceptable;
    $acceptable = 0;
    global $notacceptable;
    $notacceptable = 0;
    global $notsure;
    $notsure = 0;
    for ($i = 0; $i < count($variable); $i++) {
        $mediumvalue = array(
        feedback_number($variable[$i]->q2),
        feedback_number($variable[$i]->q3),
        feedback_number($variable[$i]->q4),
        feedback_number($variable[$i]->q5),
        feedback_number($variable[$i]->q6),
        feedback_number($variable[$i]->q7),
        feedback_number($variable[$i]->q8),
        feedback_number($variable[$i]->q9)
        );
        //print_r($mediumvalue);
        $mediumresult = round(array_sum($mediumvalue) / count($mediumvalue));
        if ($mediumresult == 5) {
            $excellent++;
        } elseif ($mediumresult == 4) {
            $good++;
        } elseif ($mediumresult == 3) {
            $acceptable++;
        } elseif ($mediumresult == 2) {
            $notacceptable++;
        } else {
            $notsure++;
        }
        //print_r($mediumresult);
    }
}
?>


<div class="col-xl-4 col-md-12">
    <div class="card calendar">
        <div class="card-header">
            <strong>Survey Feedback (Last Month)</strong>
        </div>
        <div class="card-body">
            <div id="doughnut-chart-month" data-colors='["#f4f4f4", "#f8aaa6", "#fbb377", "#b6ddad", "#6db461"]' class="e-charts"></div>
        </div>
    </div>
</div>
<script src="assets/libs/echarts/echarts.min.js"></script>
<script>
    // get colors array from the string
    function getChartColorsArray(chartId) {
        var colors = $(chartId).attr('data-colors');
        var colors = JSON.parse(colors);
        return colors.map(function(value){
            var newValue = value.replace(' ', '');
            if(newValue.indexOf('--') != -1) {
                var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                if(color) return color;
            } else {
                return newValue;
            }
        })
    }

    // Doughnut Chart
    var doughnutColors = getChartColorsArray("#doughnut-chart-month");
    var dom = document.getElementById("doughnut-chart-month");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;

    option = {
        tooltip: {
            trigger: 'item',
            formatter: "<span class='chartpopup'>{b}: {c} ({d}%)</span>"
        },
        legend: {
            orient: 'vertical',
            x: 'left',
            data: ['Excellent','Good','Acceptable','Not Acceptable','Not Sure'],
            textStyle: {color: '#112040'}
        },
        color: doughnutColors, //['#5156be', '#ffbf53', '#fd625e', '#4ba6ef', '#2ab57d'],
        series: [
            {
                name:'Deal Status',
                type:'pie',
                radius: ['50%', '70%'],
                itemStyle: {
                    borderColor: '#fff',
                    borderWidth: 4
                },
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '12',
                            fontWeight: 'bold'
                        },
                        formatter: "{b}: {c}"
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data:[
                    {value:<?php echo number_format($notesure, 2); ?>, name:'Not Sure'},
                    {value:<?php echo number_format($notacceptable, 2); ?>, name:'Not Acceptable'},
                    {value:<?php echo number_format($acceptable, 2); ?>, name:'Acceptable'},
                    {value:<?php echo number_format($good, 2); ?>, name:'Good'},
                    {value:<?php echo number_format($excellent, 2); ?>, name:'Excellent'}
                ]
            }
        ]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }

</script>