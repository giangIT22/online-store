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
                    '#2980b9',
                ],

            }]
        },
        options: {
            scales: {
                y: {
                    ticks: {
                        font: {
                            size: 14
                        },
                        color: '#bdc3c7'
                    },
                    suggestedMin: 0,

                },
                x: {
                    ticks: {
                        font: {
                            size: 14
                        },
                        color: '#bdc3c7'
                    }
                },
            },
            interaction: {
                mode: 'index'
            },
            plugins: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 14
                        },
                        color: '#bdc3c7'
                    }
                }
            }
        },
    });
}

if (window.location.pathname == '/admin/invoice-monthy') {
    initChartMonthy('tháng');

} else if (window.location.pathname == '/admin/invoice-yearly') {
    initChartMonthy('năm');
}