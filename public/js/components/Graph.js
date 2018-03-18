Vue.component('graph', {
    template: `
    <div class="container">
    <div class="row">
    <canvas style="height: 180px;" id="graph"></canvas>
    </div>
    </div>
    `,
    props: ['labels','values'],
    mounted() {
        console.log('Graph Component mounted.');

        let data = {
            //labels: this.labels,
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
                {
                    label: 'Expenses',
                    backgroundColor: "rgba(220,220,220,0.2)",
                    // strokeColor: "rgba(220,220,220,1)",
                    // pointColor: "rgba(220,220,220,1)",
                    // pointStrokeColor: "#fff",
                    // pointHighlightFill: "#fff",
                    // pointHighlightStroke: "rgba(220,220,220,1)",
                    data: this.values[0]
                },
                {
                    label: 'Sales',
                    backgroundColor: "rgba(100,220,220,0.7)",
                    // strokeColor: "rgba(220,220,220,1)",
                    // pointColor: "rgba(220,220,220,1)",
                    // pointStrokeColor: "#fff",
                    // pointHighlightFill: "#fff",
                    // pointHighlightStroke: "rgba(220,220,220,1)",
                    data: this.values[1]
                }
            ]
        };

        let context = document.querySelector('#graph').getContext('2d');

        new Chart(context , {
            type: "line",
            data: data,
        });
    }
});
