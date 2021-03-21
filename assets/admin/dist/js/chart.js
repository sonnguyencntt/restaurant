    function chartData(data) {
    
  
        var report_data = data;
      
        var areaChartData = {
         labels  : ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
         datasets: [
           {
             label               : 'Electronics',
             fillColor           : 'rgba(210, 214, 222, 1)',
             strokeColor         : 'rgba(210, 214, 222, 1)',
             pointColor          : 'rgba(210, 214, 222, 1)',
             pointStrokeColor    : '#c1c7d1',
             pointHighlightFill  : '#fff',
             pointHighlightStroke: 'rgba(220,220,220,1)',
             data                : report_data
           }
         ]
       }
       
       //-------------
       //- BAR CHART -
       //-------------
       var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
       var barChart                         = new Chart(barChartCanvas)
       var barChartData                     = areaChartData
       barChartData.datasets[0].fillColor   = '#00a65a';
       barChartData.datasets[0].strokeColor = '#00a65a';
       barChartData.datasets[0].pointColor  = '#00a65a';
       var barChartOptions                  = {
         //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
         scaleBeginAtZero        : true,
         //Boolean - Whether grid lines are shown across the chart
         scaleShowGridLines      : true,
         //String - Colour of the grid lines
         scaleGridLineColor      : 'rgba(0,0,0,.05)',
         //Number - Width of the grid lines
         scaleGridLineWidth      : 1,
         //Boolean - Whether to show horizontal lines (except X axis)
         scaleShowHorizontalLines: true,
         //Boolean - Whether to show vertical lines (except Y axis)
         scaleShowVerticalLines  : true,
         //Boolean - If there is a stroke on each bar
         barShowStroke           : true,
         //Number - Pixel width of the bar stroke
         barStrokeWidth          : 2,
         //Number - Spacing between each of the X value sets
         barValueSpacing         : 5,
         //Number - Spacing between data sets within X values
         barDatasetSpacing       : 1,
         //String - A legend template
         //Boolean - whether to make the chart responsive
         responsive              : true,
         maintainAspectRatio     : true
       }
       
       barChartOptions.datasetFill = false
       barChart.Bar(barChartData, barChartOptions)
       
      }
