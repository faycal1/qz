<div class="col-md-6"> 
            <table class="table" >
                <thead>
                    <tr>
                        <th>Département</th>
                        <th>Employés</th>
                        <th>Nbr Quiz</th>                        
                        <th>Nbr Succées </th>
                        <th>Nbr Echec</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stats as $stat) 
                    <tr>
                        <td>{{ $stat['name'] }}</td>
                        <td>{{ $stat['users'] }}</td>                        
                        <td>{{ $stat['passed'] }}</td>
                        <td>{{ $stat['succe'] }}</td>
                        <td>{{ $stat['failure'] }}</td>                        
                    </tr>
                    @endforeach 
                </tbody>
            </table>
</div>
<div id="columnCourContainer" class="col-md-6"></div>


<?php
    $names = [] ;
    foreach ($stats as $stat) {
        array_push($names, ['label'=>$stat['name']]);
    }
 ?>

    <script type="text/javascript">
        
       var columBarChart = new FusionCharts({
            "type": "mscolumn2d",
            "renderAt": "columnCourContainer",
            "width": "100%",
            "height": "500",        
            "dataSource": {
                            "chart": {
                                "caption": "Quiz Par Cour Par départments",
                                "xAxisname": "Departements",
                                "yAxisName": "Nombre de Quiz",
                                "numberPrefix": "",                                
                                "plotFillAlpha": "80",
                                "paletteColors": "#0075c2,#1aaf5d",
                                "baseFontColor": "#333333",
                                "baseFont": "Helvetica Neue,Arial",
                                "captionFontSize": "14",
                                "subcaptionFontSize": "14",
                                "subcaptionFontBold": "0",
                                "showBorder": "0",
                                "bgColor": "#ffffff",
                                "showShadow": "0",
                                "canvasBgColor": "#ffffff",
                                "canvasBorderAlpha": "0",
                                "divlineAlpha": "100",
                                "divlineColor": "#999999",
                                "divlineThickness": "1",
                                "divLineDashed": "1",
                                "divLineDashLen": "1",
                                "divLineGapLen": "1",
                                "usePlotGradientColor": "0",
                                "showplotborder": "0",
                                "valueFontColor": "#ffffff",
                                "placeValuesInside": "1",
                                "showHoverEffect": "1",
                                "rotateValues": "1",
                                "showXAxisLine": "1",
                                "xAxisLineThickness": "1",
                                "xAxisLineColor": "#999999",
                                "showAlternateHGridColor": "0",
                                "legendBgAlpha": "0",
                                "legendBorderAlpha": "0",
                                "legendShadow": "0",
                                "legendItemFontSize": "10",
                                "legendItemFontColor": "#666666"
                            },
                            "categories": [
                                {
                                    "category": <?php echo json_encode($names); ?>
                                }
                            ],
                            "dataset": [
                                {
                                    "seriesname": "Previous Year",
                                    "data": [
                                        {
                                            "value": "10000"
                                        },
                                        {
                                            "value": "11500"
                                        },
                                        {
                                            "value": "12500"
                                        },
                                        {
                                            "value": "15000"
                                        }
                                    ]
                                },
                                {
                                    "seriesname": "Current Year",
                                    "data": [
                                        {
                                            "value": "25400"
                                        },
                                        {
                                            "value": "29800"
                                        },
                                        {
                                            "value": "21800"
                                        },
                                        {
                                            "value": "26800"
                                        }
                                    ]
                                }
                            ]
                        },
            //"dataFormat": "jsonurl" 
        });
        columBarChart.render();

    </script>


<!--
mscolumn2d


 
-->