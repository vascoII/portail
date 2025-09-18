
function drawCharts(area) {

    for (elem in charts) {

        if (charts[elem].loaded == true) {
            continue;
        }

        var chartArea = $('#'+elem).parents('[data-area]').attr('data-area');

        if (chartArea == area || chartArea === undefined) {
            drawChart(elem, charts[elem]);
            charts[elem].loaded = true;
        }
    }
};

function redrawCharts() {

    for (elem in charts) {

        if (charts[elem].loaded != false) {
            continue
        }

        drawChart(elem, charts[elem]);
    }

};

function drawChart(elem, options) {

    if (options.type == 'function') {
        options.func();
        return;
    }

    var chart = null;
    var container = document.getElementById(elem);

    var data = google.visualization.arrayToDataTable(options.datatable);

    if (options.type == 'bar') {
        chart = new google.visualization.BarChart(container);
    } else if (options.type == 'line') {
        chart = new google.visualization.LineChart(container);
    } else if (options.type == 'combo') {
        chart = new google.visualization.ComboChart(container);
    } else if (options.type == 'column') {
        chart = new google.visualization.ColumnChart(container);
    }

    chart.draw(data, options.options);

    if (options.callback !== undefined) {
        options.callback($('#'+elem));
    }
};

(function () {

    google.load("visualization", "1", {packages: ["corechart", "bar", "controls"], 'language': 'ru'});
    google.setOnLoadCallback(redrawCharts);
	

	
    $(window).resize(function () {
        redrawCharts();
    });
	
	$(document).ready(function () {
		$(window).resize(function(){
        redrawCharts();
    });
});
	
})();
