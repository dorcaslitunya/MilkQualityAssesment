<div class="h-100">
    <canvas id="CanvasJsTempLineChart"> -- </canvas> 
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // $(document).ready(function() {
        // console.log("loading chart");

        const chart_canvas = document.getElementById('CanvasJsTempLineChart');
        var post_url = "/dashboard/Overview/Sensor_charts/Sensor1/gaugechart_dummydata.php";
        let post_mq_result;
        var post_mq_result_JSON_payload_sens1=[];
        let post_mq_result_JSON;
        let post_mq_result_JSON_payload_timestamp = [];
        let post_mq_result_JSON_payload_unix_timestamp = [];
        let post_mq_result_JSON_payload_PR = [];
        let post_mq_result_JSON_payload_PY = [];
        let post_mq_result_JSON_payload_PB = [];
        let query_success = "";
        var post_PZEM_filter_data = {
            // "sample_1": 11,
            // "sample_2": "manu"
        };
        let phasedetect = [];
        var redchart;

        draw_MQ_chart();

        setInterval(function() {
            ajax_call();
            // redchart.data.labels = post_mq_result_JSON_payload_sens1.reverse(); 

            // Delete previous data 
            // redchart.data.labels.pop();

            // Add new data 
            redchart.data.labels.push(post_mq_result_JSON_payload_sens1);

            // let NewLabel = redchart.data.labels;
            // NewLabel = NewLabel[NewLabel.length - 1];
            // console.log("most recent time label: " + NewLabel);

            // redchart.data.datasets[0].data = post_mq_result_JSON_payload_sens1.reverse();  
            // Delete previous data 
            // redchart.data.datasets.forEach((dataset) => {
            //     dataset.data.pop();
            // });        
            const maxDataPoints = 20; // Set your desired maximum number of data points

if (redchart.data.labels.length >= maxDataPoints) {
    redchart.data.labels.shift(); // Remove the oldest label
    redchart.data.datasets.forEach((dataset) => {
        dataset.data.shift(); // Remove the oldest data point
    });
}
            // Add new data 
            redchart.data.datasets.forEach((dataset) => {
                dataset.data.push(post_mq_result_JSON_payload_sens1);
            });
            // console.log(redchart.data.datasets[0].data);
            // let Newdata = redchart.data.datasets[0].data;
            // Newdata = Newdata[Newdata.length - 1];
            // console.log("recent wattage data: " + Newdata);

            redchart.update();
            console.log("chart updated");
        }, 60000);

        // Line chart
        function draw_MQ_chart() {
            ajax_call();
            redchart = new Chart(chart_canvas, {
                type: "line",
                data: {
                    // type: "area",
                    // xValueType: "dateTime",
                    // labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    labels: post_mq_result_JSON_payload_timestamp.reverse(),
                    datasets: [{
                        color: "rgba(255, 0, 0,0.8)",
                        borderColor: 'red',
                        label: "Phase Red",
                        fill: true,
                        backgroundColor: "transparent",
                        // borderColor: window.theme.primary, //TODO This requires Bootstrap 5. bootstrap 4 used. 
                        // data: [2115, 1562, 1584, 1892, 1487, 2223, 2966, 2448, 2905, 3838, 2917, 3327]
                        // data: post_mq_result_JSON_payload_sens1.reverse(),
                        data: post_mq_result_JSON_payload_sens1,
                        spanGaps: true
                    }]
                },
                options: {
                    scaleShowLabels: false,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        // intersect: false,
                        // spanGaps: true
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        },
                        legend: {
                            display: true,
                            labels: {
                                color: 'rgb(255, 99, 132)'
                            }
                        }
                    },
                    scales: {
                        xAxes: [{
                            // type: 'time',
                            // time: {
                            //     unit: 'hour',
                            //     minUnit: 'minute'
                            // },
                            reverse: true,
                            ticks: {
                                // stepSize: 500,
                                display: false
                            },
                            gridLines: {
                                // color: "rgba(0,0,0,0.05)",
                                display: false
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                // stepSize: 500,
                                display: false
                            },
                            display: true,
                            borderDash: [5, 5],
                            gridLines: {
                                // color: "rgba(0,0,0,0)",
                                // fontColor: "#fff",
                                display: false
                            }
                        }]
                    }
                }
            });
        }

        function ajax_call() {
            // console.log("ajax calling");
            $.ajax({
                    url: post_url,
                    method: "POST",
                    cache: false,
                    async: false,
                    data: post_PZEM_filter_data,
                    // crossDomain: "true",
                    // dataType: 'json',
                    // Note: For cross-domain requests, setting the content type to anything other than application/x-www-form-urlencoded, multipart/form-data, or text/plain will trigger the browser to send a preflight OPTIONS request to the server.
                    // contentType: "application/json;charset=utf-8"
                })
                // .beforeSend(function(jqXHR, settings) {
                //     console.log("before send");
                //     // jqXHR.setRequestHeader(key, value);
                // })
                .done(function(post_mq_result) {
                    // done -> success is deprecated in jQuery 1.8
                    console.log(" *********************** ");
                    console.log(post_mq_result);
                    console.log(" *********************** ");

                    // post_mq_result_JSON = $.parseJSON(post_mq_result);
                    post_mq_result_JSON = post_mq_result;
                    query_success = post_mq_result_JSON["succ"];
                    post_mq_result_JSON_payload = post_mq_result_JSON["load"];

                    if (query_success == 0) {
                        // console.log("\n ^^^^^^^^^^^^ ss - 0");
                        // Error Querying                        
                        // clear_btn_color('#btn_MQ_filter');
                        // $('#btn_MQ_filter').addClass('btn-danger');
                        // $('#text_btn_MQ_filter').html("error");
                    } else if (query_success == 1 && post_mq_result_JSON_payload == "null") {
                        // console.log("\n ^^^^^^^^^^^^ ss - 10");
                        // clear_btn_color('#btn_MQ_filter');
                        // $('#btn_MQ_filter').addClass('btn-info');
                        // $('#text_btn_MQ_filter').html("empty");
                    } else if (query_success == 1 && post_mq_result_JSON_payload != "null") {
                        // console.log("\n ^^^^^^^^^^^^ ss - 11");

                        // clear_btn_color('#btn_MQ_filter');
                        // $('#btn_MQ_filter').addClass('btn-success');
                        // $('#text_btn_MQ_filter').html("Done");

                        // console.log(post_mq_result_JSON_payload);
                        post_mq_result_JSON_payload_timestamp = [];
                        post_mq_result_JSON_payload_unix_timestamp = [];
                        post_mq_result_JSON_payload_PR = [];
                        post_mq_result_JSON_payload_PY = [];
                        post_mq_result_JSON_payload_PB = [];

                        for (var i = 0; i < post_mq_result_JSON_payload.length; i++) {
                            post_mq_result_JSON_payload_timestamp.push(post_mq_result_JSON_payload[i].timestamp);
                            post_mq_result_JSON_payload_unix_timestamp.push(post_mq_result_JSON_payload[i].unix_timestamp);
                            post_mq_result_JSON_payload_sens1.push(post_mq_result_JSON_payload[i].sensor_data.sens_1);

                            // phasedetect = post_mq_result_JSON_payload[i].sensor_data['sens'];
                            // // console.log("phase detect is ----> ");
                            // // console.log(phasedetect);
                            // // console.log("<---- phase detect  ");

                            // if (phasedetect == 85) {
                            //     post_mq_result_JSON_payload_PR.push(post_mq_result_JSON_payload[i].sensor_data['W']);
                            //     post_mq_result_JSON_payload_PY.push(null);
                            //     post_mq_result_JSON_payload_PB.push(null);
                            // } else if (phasedetect == 86) {
                            //     post_mq_result_JSON_payload_PR.push(null);
                            //     post_mq_result_JSON_payload_PY.push(post_mq_result_JSON_payload[i].sensor_data['W']);
                            //     post_mq_result_JSON_payload_PB.push(null);
                            // } else if (phasedetect == 87) {
                            //     post_mq_result_JSON_payload_PR.push(null);
                            //     post_mq_result_JSON_payload_PY.push(null);
                            //     post_mq_result_JSON_payload_PB.push(post_mq_result_JSON_payload[i].sensor_data['W']);
                            // }
                        }
                        // console.log(post_mq_result_JSON_payload_unix_timestamp);
                    } else {
                        // console.log("\n ^^^^^^^^^^^^ ss - unknown");
                        // console.log('query_success');
                        // console.log(query_success);
                        // console.log(post_mq_result_JSON_payload);
                    }

                    // console.log(" *********************** ");
                })
                .fail(function(request, error) {
                    // fail -> error is deprecated in jQuery 1.8
                    console.log("error");

                    clear_btn_color('#btn_MQ_filter');
                    $('#btn_MQ_filter').addClass('btn-danger');
                    $('#text_btn_MQ_filter').html("Error. Not redrawn");

                    alert("Request: " + $.parseJSON(request));
                })
                .always(function() {
                    // always -> done is deprecated in jQuery 1.8
                    // console.log("always");
                })
            // .complete(function() {
            //     console.log("query completed");
            // })
        }

    });
</script>