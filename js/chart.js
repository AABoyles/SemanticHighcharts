//Looks pretty innocent, right? This is all the Javascript we need--
//  Everything else is run by the Server and HighCharts.
$(function() {
  $(document).ready(function() {
    var dataP = $.parseJSON(data);
    var paramsP = $.parseJSON(params)
    var chart = new Highcharts.Chart($.extend(true, dataP, paramsP));
  });
});
