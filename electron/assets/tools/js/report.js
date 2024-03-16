$(document).ready(async function(){
  $("#doanhthu").html(Number(parseInt(700000)).toLocaleString('en'));
  Topsales();
  Doanhsothang();
  KPItuan_chart();
  KPIthang_chart();
});
function Topsales() {
  var options = {
    series: [{
    name: 'Lượt đặt',
    data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
  }],
  chart: {
    toolbar: {
      show: false,
    },
    type: 'bar',
    height: 350
  },
  plotOptions: {
    bar: {
      borderRadius: 4,
      horizontal: true,
    }
  },
  dataLabels: {
    enabled: false
  },
  xaxis: {
    categories: ['Bò quấn nấm', 'Ba chỉ', 'Thịt thăn', 'Mì cay', 'Củ đậu', 'Dưa chuột', 'Hàu hấp',
      'Chân gà', 'Ốc luộc', 'Ốc xào'
    ],
  }
  };

  var chart = new ApexCharts(document.querySelector("#top_sales"), options);
  chart.render();
}
function Doanhsothang() {
  var options = {
    series: [{
    name: 'Lẩu',
    type: 'column',
    data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
  }, {
    name: 'Nướng',
    type: 'area',
    data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
  }, {
    name: 'Khác',
    type: 'line',
    data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
  }],
  colors: ["#26A0FC","#d5d5d5","#cb7a33"],
  chart: {
    toolbar: {
      show: false,
    },
    height: 350,
    type: 'line',
    stacked: false,
  },
  stroke: {
    width: [0, 2, 5],
    curve: 'smooth'
  },
  plotOptions: {
    bar: {
      columnWidth: '50%',
      borderRadius: 4,
    }
  },
  
  fill: {
    opacity: [0.85, 0.25, 1],
    gradient: {
      inverseColors: false,
      shade: 'light',
      type: "vertical",
      opacityFrom: 0.85,
      opacityTo: 0.55,
      stops: [0, 100, 100, 100]
    }
  },
  labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003',
    '08/01/2003', '09/01/2003', '10/01/2003', '11/01/2003'
  ],
  markers: {
    size: 0
  },
  xaxis: {
    type: 'datetime'
  },
  yaxis: {
    min: 0
  },
  grid: {
      show: false,
  },
  tooltip: {
    shared: true,
    intersect: false,
    y: {
      formatter: function (y) {
        if (typeof y !== "undefined") {
          return y.toFixed(0) + " đơn";
        }
        return y;
  
      }
    }
  },legend: {
    show: true,
  }
  };

  var chart = new ApexCharts(document.querySelector("#sales_chart"), options);
  chart.render();
};
function KPItuan_chart(){
  var options = {
    series: [82],
    colors: ["#20E647"],
    chart: {
      height: 120,
      type: 'radialBar',
      events: {
        click: async function(event, chartContext, config) {
          console.log((event, chartContext, config));
        }
      }
    },
    plotOptions: {
      radialBar: {
        dataLabels: {
          show: false,
        },
        hollow: {
          size: '40%',
        }
      },
    }
  };
  var chart = new ApexCharts(document.querySelector("#KPI_tuan"), options);
  chart.render();
}
function KPIthang_chart(){
  var options = {
    series: [82],
    chart: {
      height: 120,
      type: 'radialBar',
      events: {
        click: async function(event, chartContext, config) {
          console.log((event, chartContext, config));
        }
      }
    },
    plotOptions: {
      radialBar: {
        dataLabels: {
          show: false,
        },
        hollow: {
          size: '40%',
        }
      },
    }
  };
  var chart = new ApexCharts(document.querySelector("#KPI_thang"), options);
  chart.render();
}