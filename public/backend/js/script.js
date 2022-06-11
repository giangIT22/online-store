$('.user-menu').click(function() {
    $('.show-menu').toggleClass("show");
});

function getLabels(label) {
    let labels = [];

    if (label == 'tháng') {
        for (let i = 1; i <= 12; i++) {
            labels.push(`Tháng ${i}`);
        }

    } else {
        for (let i = maximum_date - 10; i <= maximum_date; i++) {
            labels.push(i);
        }
    }

    return labels;
}

function getDataForChart(label) {
    let data = [];

    if (label == 'tháng') {
        for (let key in invoices) {
            if (key == maximum_date) {
                for (let item in invoices[key]) {
                    let newObj = {
                        x: `Tháng ${item}`,
                        y: invoices[key][item]
                    };

                    data.push(newObj);
                }
            }
        }

    } else {
        for (let key in invoices) {
            let newObj = {
                x: parseInt(key),
                y: invoices[key]
            };

            data.push(newObj);
        }
    }

    return data;
}



function initChartMonthy(label) {
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: getLabels(label),
            datasets: [{
                label: `Tổng giá trị hóa đơn theo ${label}`,
                data: getDataForChart(label),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                ],

            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

console.log(maximum_date);
console.log(getLabels('year'));
if (window.location.pathname == '/admin/invoice-monthy') {
    initChartMonthy('tháng');
    console.log(getDataForChart('tháng'));

} else if (window.location.pathname == '/admin/invoice-yearly') {
    initChartMonthy('năm');
    console.log(getDataForChart('năm'));
}