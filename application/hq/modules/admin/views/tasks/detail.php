<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 15/6/7
 * Time: 下午7:00
 */
?>


<div class="row">
    <div class="col-12">
        <div class="box" data-name="tasks/charts">
            <div class="box-title">
                <a class="tools toggle" title="点击以切换"></a>
                <h4 style="cursor: pointer;">使用详情</h4>
            </div>
            <div class="box-content">
                <div id="charts"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>


<script>
    var tongji_charts = {
        'create': function(data, text, name, date, type)
        {
            $('#charts').highcharts({
                chart: {
                    renderTo: 'container',
                    type: 'column',
                    margin: 75,
                    options3d: {
                        enabled: true,
                        alpha: 5,
                        beta: 15,
                        depth: 50,
                        viewDistance: 25
                    }
                },
                credits: {
                    text: '绍兴文理学院元培学院'
                },
                xAxis: {
                    categories: date
                },
                yAxis: {
                    title: {
                        text: type == 1 ? '电量 (度)' : '水(吨)'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                title: {
                    text: text
                },
                subtitle: {
                    text: '地点' + name
                },
                tooltip: {
                    valueSuffix: type == 1 ? '度' : '吨'
                },
                plotOptions: {
                    column: {
                        depth: 25,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontWeight: 'bold'
                            }
                        }
                    }
                },
                series: [{
                    name: '使用',
                    data: data
                }]
            });
        }
    }
    $(function () {
        tongji_charts.create(<?= json_encode($data) ?>, '<?= $text ?>', '<?= $text ?>', <?= json_encode($date) ?>, <?= $type ?>);
    });
</script>
<script src="<?= $this->staticFile('highcharts/js/highcharts.js') ?>"></script>