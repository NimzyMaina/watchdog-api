$(function () {
   'use strict';

    $('.daterange').daterangepicker({
        ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
    }, function (start, end) {
        window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });


});
//
// let token = document.head.querySelector('meta[name="csrf-token"]');
//
// if (token) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }
//
// //import Graph from './components/Graph'
//
// //require('./components/Graph')
//
// //Vue.component('graph',Graph);
//
// let graph = Vue.component('graph', {
//         template: `<canvas id="graph"></canvas>`,
//         //props: ['labels','values'],
//         data() {
//             return {
//                 values: [],
//                 labels: []
//             }
//         },
//         mounted() {
//             console.log('Graph Component mounted.');
//
//             axios.get(baseurl + "ajax/graph",{
//                 params: {
//
//                 }
//             }).then( function(response) {
//                 console.log(this.data);
//                 this.labels = response.data.labels;
//                 this.values = response.data.values;
//             }.bind(this)).catch(function (error) {
//                 console.log(error);
//             });
//
//             let data = {
//                 labels: this.labels,
//                 //labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
//                 datasets: [
//                     {
//                         label: 'Expenses',
//                         backgroundColor: "rgba(220,220,220,0.2)",
//                         fillColor           : 'rgb(210, 214, 222)',
//                         strokeColor         : 'rgb(210, 214, 222)',
//                         pointColor          : 'rgb(210, 214, 222)',
//                         pointStrokeColor    : '#c1c7d1',
//                         pointHighlightFill  : '#fff',
//                         pointHighlightStroke: 'rgb(220,220,220)',
//                         data: this.values[0],
//                         //data: [65, 59, 80, 81, 56, 55, 40]
//                     },
//                     {
//                         label: 'Sales',
//                         backgroundColor: "rgba(100,220,220,0.7)",
//                         fillColor           : 'rgba(60,141,188,0.9)',
//                         strokeColor         : 'rgba(60,141,188,0.8)',
//                         pointColor          : '#3b8bba',
//                         pointStrokeColor    : 'rgba(60,141,188,1)',
//                         pointHighlightFill  : '#fff',
//                         pointHighlightStroke: 'rgba(60,141,188,1)',
//                         data: this.values[1],
//                         //data: [28, 48, 40, 19, 86, 27, 90]
//                     }
//                 ]
//             };
//
//             let revenueChartOptions = {
//                 // Boolean - If we should show the scale at all
//                 showScale               : true,
//                 // Boolean - Whether grid lines are shown across the chart
//                 scaleShowGridLines      : false,
//                 // String - Colour of the grid lines
//                 scaleGridLineColor      : 'rgba(0,0,0,.05)',
//                 // Number - Width of the grid lines
//                 scaleGridLineWidth      : 1,
//                 // Boolean - Whether to show horizontal lines (except X axis)
//                 scaleShowHorizontalLines: true,
//                 // Boolean - Whether to show vertical lines (except Y axis)
//                 scaleShowVerticalLines  : true,
//                 // Boolean - Whether the line is curved between points
//                 bezierCurve             : true,
//                 // Number - Tension of the bezier curve between points
//                 bezierCurveTension      : 0.3,
//                 // Boolean - Whether to show a dot for each point
//                 pointDot                : false,
//                 // Number - Radius of each point dot in pixels
//                 pointDotRadius          : 4,
//                 // Number - Pixel width of point dot stroke
//                 pointDotStrokeWidth     : 1,
//                 // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
//                 pointHitDetectionRadius : 20,
//                 // Boolean - Whether to show a stroke for datasets
//                 datasetStroke           : true,
//                 // Number - Pixel width of dataset stroke
//                 datasetStrokeWidth      : 2,
//                 // Boolean - Whether to fill the dataset with a color
//                 datasetFill             : true,
//                 // String - A legend template
//                 legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
//                 // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
//                 maintainAspectRatio     : true,
//                 // Boolean - whether to make the chart responsive to window resizing
//                 responsive              : true
//             };
//
//             let context = document.querySelector('#graph').getContext('2d');
//
//             let transactions = new Chart(context);
//
//             transactions.Bar(data,revenueChartOptions);
//         }
//     });
//
//
// let data = {
//     message: 'Hello nimzy',
//     labels: [],//['January','February','March','April','May','June'],
//     values: []//[[30000000,12200000,9000000,50000000,30000000,60000000],
//         //[100000000,52000000,200000000,55500000,97000000,20000400]]
// };
//
// var app = new Vue({
//     el: '#dashapp',
//     components: {graph:graph},
//     data: {
//         labels: [],
//         values: [],
//         message: "hello nimzy"
//     },
//    mounted () {
//         console.log('app mounted');
//        let self = this;
//
//    }
//
//
// });
