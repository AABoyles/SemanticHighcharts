var chart;

$(function() {
  $(document).ready(function() {
  	data = $.parseJSON(data);
  	params = $.parseJSON(params)
    chart = new Highcharts.Chart(
    	$.extend(true, data, params)
    );
  });
});
