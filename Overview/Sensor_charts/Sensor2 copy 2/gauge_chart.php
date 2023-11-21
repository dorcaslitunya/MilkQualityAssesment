<div>
    <div id="DivGaugeChartpH" style="text-align: center">ph chart here</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // $(document).ready(function() {
        // console.log("loading chart");

        const chart_canvasA = document.getElementById('DivGaugeChartpH');

        let chart_A;

        var post_url = "/dashboard/Overview/Sensor_charts/Sensor2/gaugechart_dummydata.php";
        let DataQueried;
        let DataQueried_JSON;
        var MostRecentSensVal;
        let post_mq_result_JSON_payload_timestamp = [];
        let post_mq_result_JSON_payload_unix_timestamp = [];
        // let post_mq_result_JSON_payload_I2 = [];
        let DataQueried_JSON_load_sens1 = [];
        let DataQueried_JSON_load_sens2 = [];
        let DataQueried_JSON_load_sens3 = [];
        let DataQueried_JSON_ss = "";
        var post_MQC_filter_data = {
            // "fetch_from": null,
            // "fetch_to": null
        };

        // Update vars
        ajax_call();
        draw_gauge_chart();

        function fetch_first_notNull(sample_array) {
            for (var i = 0; i < sample_array.length; i++) {
                if (sample_array[i] != null) {
                    var FirstNotNullVal = sample_array[i];
                    // console.log("FirstNotNullVal is now ");
                    // console.log(FirstNotNullVal);
                    break;
                }
            }
            return FirstNotNullVal;
        }

        function fetch_last_notNull(sample_array) {
            for (var i = 0; i < sample_array.length; i++) {
                if (sample_array[i] != null) {
                    var LastNotNullVal = sample_array[i];
                }
            }
            // console.log("LastNotNullVal is now ");
            // console.log(LastNotNullVal);
            return LastNotNullVal;
        }

        function draw_gauge_chart() {

            // Call google charts API
            google.charts.load('current', {
                'packages': ['gauge']
            });

            // Configure chart options 
            var GaugeChartOptions = {
                width: 400,
                height: 120,
                yellowFrom: 1000,
                yellowTo: 1500,
                redFrom: 1500,
                redTo: 2000,
                minorTicks: 5,
                max: 2000,
                min: 0
            };

            // Gauge A
            google.charts.setOnLoadCallback(drawChartAA);

            function drawChartAA() {
                // Get new data
                // var MostRecentSensVal = fetch_last_notNull(DataQueried_JSON_load_sens1);
                // var Time_GaugeValueAA = fetch_last_notNull(post_mq_result_JSON_payload_timestamp);
                // Or, let the gauge start from 0 instead
                var MostRecentSensVal_1 = 0;

                let data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    ['pH', MostRecentSensVal_1]
                    // DataQueried_JSON_load_sens1
                ]);

                let options = GaugeChartOptions;

                let chart = new google.visualization.Gauge(chart_canvasA);

                chart.draw(data, options);

                // update this gauge chart forever
                setInterval(function() {
                    // Fetch data afresh                    
                    ajax_call();
                    // Update value
                    // MostRecentSensVal = fetch_first_notNull(DataQueried_JSON_load_sens1);
                    // Time_GaugeValueAA = fetch_first_notNull(post_mq_result_JSON_payload_timestamp);
                    // TODO check if value has changed 
                    // Now set chart values
                    data.setValue(0, 1, MostRecentSensVal);
                    // Now update
                    // console.log("redrawing gauge A");
                    chart.draw(data, options);
                }, 5000);
            }
        }

        function ajax_call() {
            // console.log("ajax calling");
            $.ajax({
                    url: post_url,
                    method: "POST",
                    cache: false,
                    async: false,
                    data: post_MQC_filter_data,
                    // crossDomain: "true",
                    // dataType: 'json',
                    // Note: For cross-domain requests, setting the content type to anything other than application/x-www-form-urlencoded, multipart/form-data, or text/plain will trigger the browser to send a preflight OPTIONS request to the server.
                    // contentType: "application/json;charset=utf-8"
                })
                // .beforeSend(function(jqXHR, settings) {
                //     console.log("before send");
                //     // jqXHR.setRequestHeader(key, value);
                // })
                // done -> success is deprecated in jQuery 1.8
                .done(function(DataQueried) {
                    // console.log(" ********* Fetching data ************* ");
                    // console.table(DataQueried);
                    // console.log(" ********* /Fetching data ************* ");

                    process_ajax_data(DataQueried);
                    // console.log(" *********************** ");
                })
                // fail -> error is deprecated in jQuery 1.8
                .fail(function(request, error) {
                    console.log("error");
                    alert("Request: " + $.parseJSON(request));
                })
                // always -> done is deprecated in jQuery 1.8
                .always(function() {
                    // console.log("always");
                })
            // .complete(function() {
            //     console.log("query completed");
            // })
        }

        function process_ajax_data(DataQueried) {

            // console.log(" ********* Fetching data ************* ");
            // console.log(DataQueried);
            // console.log(" ********* /Fetching data ************* ");

            // DataQueried_JSON = JSON.parse(DataQueried);
            DataQueried_JSON_ss = DataQueried["succ"];
            DataQueried_JSON_load = DataQueried["load"];

            if (DataQueried_JSON_ss == 0) {
                console.log("fetch error");
            } else if (DataQueried_JSON_ss == 1 && DataQueried_JSON_load == "null") {
                console.log("fetch success, no data");
            } else if (DataQueried_JSON_ss == 1 && DataQueried_JSON_load != "null") {
                // console.log("fetch success, data success");

                // DataQueried_JSON_load_sens1 = [];
                // DataQueried_JSON_load_sens2 = [];
                // DataQueried_JSON_load_sens3 = [];

                // Get the last sens_1 value
                MostRecentSensVal = DataQueried_JSON_load[DataQueried_JSON_load.length - 1].sensor_data.sens_1;
                // console.log("Last sens_1 value is :", MostRecentSensVal);
            } else {
                console.log("unknown error");
            }
        }

    });
</script>

<!-- Date time plugin -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script> -->