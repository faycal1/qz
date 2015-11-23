<div class="col-md-6"> 
            <table class="table" >
                <thead>
                    <tr>
                        <th>Département</th>
                        <th>Employés</th>
                        <th>Passé</th>                        
                        <th>Succées </th>
                        <th>Echecs</th>
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
    $passed = [] ;
    $succe = [] ;
    $failure = [] ;
    foreach ($stats as $stat) {
        array_push($names, ['label'=>$stat['name'] ]);
        array_push($passed, ['value'=>$stat['passed'] , 'color'=>"#008ee4"]);
        array_push($succe, ['value'=>$stat['succe'] , 'color'=>"#9b59b6" ]);
        array_push($failure, ['value'=>$stat['failure'] , 'color'=>"#6baa01"]);
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
                                    "seriesname": "Passé",
                                    "data":<?php echo json_encode($passed); ?>
                                },
                                {
                                    "seriesname": "Réussi",
                                    "data":<?php echo json_encode($succe); ?>
                                },
                                {
                                    "seriesname": "Echek",
                                    "data":<?php echo json_encode($failure); ?>
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