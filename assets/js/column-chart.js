google.load("visualization", '1.1', { packages: ['corechart'] });
google.setOnLoadCallback(drawChart);
function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Type', 'Shift Hours', 'Extra Shift Hours', 'Limit Hours'],
        ['Nurse 1', 35, 10, 10],
        ['Nurse 2', 40, 10, 0],
        ['Nurse 3', 15, 15, 5],
        ['Nurse 4', 45, 5, 0],
        ['Nurse 5', 43, 7, 0]
    ]);

    var options = {
        width: 600,
        height: 400,
        legend: { position: 'top', maxLines: 4 },
        bar: { groupWidth: '65%' },
        isStacked: true,
    };

    var view = new google.visualization.DataView(data);
    var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_stacked'));
    google.visualization.events.addListener(chart, 'select', function () {
        highlightBar(chart, options, view);
    });
    chart.draw(data, options);
}


function highlightBar(chart, options, view) {
    var selection = chart.getSelection();
    if (selection.length) {
        var row = selection[0].row;
        var column = selection[0].column;


        //1.insert style role column to highlight selected column
        var styleRole = {
            type: 'string',
            role: 'style',
            calc: function (dt, i) {
                return (i == row) ? 'stroke-color: #000000; stroke-width: 2' : null;
            }
        };
        var indexes = [0, 1, 2, 3,4];
        var styleColumn = findStyleRoleColumn(view)
        if (styleColumn != -1 && column > styleColumn)
            indexes.splice(column, 0, styleRole);
        else
            indexes.splice(column + 1, 0, styleRole);
        view.setColumns(indexes);
        //2.redraw the chart
        chart.draw(view, options);
    }
}

function findStyleRoleColumn(view) {
    for (var i = 0; i < view.getNumberOfColumns() ; i++) {
        if (view.getColumnRole(i) == "style") {
            return i;
        }
    }
    return -1;
}