var simpleChartClass;

(function($){
    $(document).ready(function(){
        var datas = []
        var days_array = []
        for (var elements of Object.values(cf)) {
            datas.push(Object.values(elements)) 
          }
        for (var element of Object.values(day)) {

        days_array.push(Object.values(element)) 
        }
          var obj = {}
          for (var i = 0; i < days_array.length; i++) {
            obj[days_array[i]] = datas[i].toString();
            } 

           console.log(obj);

        var labels = Object.keys(obj);
        var data = Object.values(obj);
        var ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: labels,
            datasets: [{
                label: 'Orders Stats',
                data: data,
                backgroundColor:[
                    'rgba(255,99,132, 0.2)',
                    'rgba(52,162,235, 0.2)',
                    'rgba(255,206,86, 0.2)',
                    'rgba(75,192,192, 0.2)',
                    'rgba(153,102,255, 0.2)',
                    'rgba(255,159,64, 0.2)',
                    'rgba(60, 179, 113, 0.9)',
                    'rgba(255, 0, 0, 0.5)',
                    'rgb(238, 130, 238)',
                    'rgb(106, 90, 205)',
                    'rgb(60, 60, 60)',
                    'rgba(255,100,132, 0.2)',
                    'rgba(60,252,235, 0.2)',
                    'rgba(25,160,80, 0.2)',
                    'rgba(10,260,192, 0.9)',
                    'rgba(153,102,255, 0.6)',
                    'rgba(255,159,64, 0.7)',
                    'rgba(70, 10, 113, 0.7)',
                    'rgba(255, 12, 12, 0.5)',
                    'rgb(238, 30, 238)',
                    'rgb(106, 90, 200)',
                    'rgb(60, 7, 70)',
                    'rgba(25,100,132, 0.2)',
                    'rgba(6,25,235, 0.6)',
                    'rgba(25,16,80, 0.5)',
                    'rgba(10,20,19, 0.9)',
                    'rgba(153,12,255, 0.6)',
                    'rgba(255,159,6, 0.9)',
                    'rgba(70, 1, 113, 0.7)',
                    'rgba(160, 10, 12, 0.5)',
                    'rgb(23, 130, 238)',
                ],
                borderWidth: 1
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
        
    });

    $(document).ready(function(){

        var datas = []
        var days_array = []
        for (var elements of Object.values(cf)) {
            datas.push(Object.values(elements)) 
          }
        for (var element of Object.values(day)) {

        days_array.push(Object.values(element)) 
        }
          var obj = {}
          for (var i = 0; i < days_array.length; i++) {
            obj[days_array[i]] = datas[i].toString();
            } 

           console.log(obj);

        var labels = Object.keys(obj);
        var data = Object.values(obj);
        var ctx = document.getElementById('myChart2').getContext('2d');

        new Chart(ctx, {
            type: 'pie',
            data: {
            labels: labels,
            datasets: [{
                label: 'Orders Stats',
                data: data,
                backgroundColor:[
                    'rgba(255,99,132, 0.2)',
                    'rgba(52,162,235, 0.2)',
                    'rgba(255,206,86, 0.2)',
                    'rgba(75,192,192, 0.2)',
                    'rgba(153,102,255, 0.2)',
                    'rgba(255,159,64, 0.2)',
                    'rgba(60, 179, 113, 0.9)',
                    'rgba(255, 0, 0, 0.5)',
                    'rgb(238, 130, 238)',
                    'rgb(106, 90, 205)',
                    'rgb(60, 60, 60)',
                    'rgba(255,100,132, 0.2)',
                    'rgba(60,252,235, 0.2)',
                    'rgba(25,160,80, 0.2)',
                    'rgba(10,260,192, 0.9)',
                    'rgba(153,102,255, 0.6)',
                    'rgba(255,159,64, 0.7)',
                    'rgba(70, 10, 113, 0.7)',
                    'rgba(255, 12, 12, 0.5)',
                    'rgb(238, 30, 238)',
                    'rgb(106, 90, 200)',
                    'rgb(60, 7, 70)',
                    'rgba(25,100,132, 0.2)',
                    'rgba(6,25,235, 0.6)',
                    'rgba(25,16,80, 0.5)',
                    'rgba(10,20,19, 0.9)',
                    'rgba(153,12,255, 0.6)',
                    'rgba(255,159,6, 0.9)',
                    'rgba(70, 1, 113, 0.7)',
                    'rgba(160, 10, 12, 0.5)',
                    'rgb(23, 130, 238)',
                ],
                borderWidth: 1
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
        
    });
})(jQuery) 