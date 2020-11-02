// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';



$(function () {
    let labelItems = [];
    let datasetItems = [];

    $.get('/api/chart/products-chart', {random_id: Math.random() }, function (data) {

        let coloR = [];
        let dynamicColors = function () {
            const r = Math.round(Math.random() * 255);
            const g = Math.round(Math.random() * 255);
            const b = Math.round(Math.random() * 255);

            return "rgb("+ r +", "+ g +", "+ b +")";
        };

        for (let i in data.labels) {
            coloR.push(dynamicColors());
            $("#names_js").append('<span class="mr-2"><i class="fas fa-circle" style="color: '+ coloR[i] +';"></i>'+ data.labels[i] +'</span>')
        }

        labelItems = data.labels;
        datasetItems.push({
            data: data.datasets.values,
            backgroundColor: coloR,
            hoverBackgroundColor: coloR,
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        });

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labelItems,
                datasets: datasetItems,
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });

    });

});












