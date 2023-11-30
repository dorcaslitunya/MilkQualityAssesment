<div>
    <canvas id="myChart_e33e3e"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chart_canvas = document.getElementById('myChart_e33e3e');
    var post_url = "/endpoints/chargers/temp_retrieve.php";
    let post_data = "{'sample': 10}";
    let post_result;
    let post_result_JSON;
    let post_result_JSON_payload_timeline = [];
    let post_result_JSON_payload_cash = [];
    let post_result_JSON_payload_ltrs = [];

    ajax_call();

    new Chart(chart_canvas, {
        type: 'line',
        data: {
            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            labels: post_result_JSON_payload_timeline,
            datasets: [{
                label: 'temp',
                // data: [12, 19, 3, 5, 2, 3],
                data: post_result_JSON_payload_cash,
                borderWidth: 1
            }
            // , {
            //     label: 'ltrs',
            //     // data: [12, 19, 3, 5, 2, 3],
            //     data: post_result_JSON_payload_ltrs,
            //     borderWidth: 1
            // }
        ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function ajax_call() {
        $.ajax({
                url: post_url,
                method: "POST",
                cache: false,
                async: false,
                // crossDomain: "true",
                // dataType: 'json',
                // Note: For cross-domain requests, setting the content type to anything other than application/x-www-form-urlencoded, multipart/form-data, or text/plain will trigger the browser to send a preflight OPTIONS request to the server.
                contentType: "application/json;charset=utf-8",
                data: post_data,
            })
            // .beforeSend(function(jqXHR, settings) {
            //     console.log("before send");
            //     // jqXHR.setRequestHeader(key, value);
            // })
            // done -> success is deprecated in jQuery 1.8
            .done(function(post_result) {
                console.log(" *********************** ");
                console.log("done");
                // $("#ajax_call_resp_el").html(post_result);
                // console.log(post_result);
                // console.log(" --- ");
                post_result_JSON = $.parseJSON(post_result);
                // console.log(post_result_JSON["success"]);
                post_result_JSON_payload = post_result_JSON["load"];
                console.log(post_result_JSON_payload);
                for (var i = 0; i < post_result_JSON_payload.length; i++) {
                    post_result_JSON_payload_timeline.push(post_result_JSON_payload[i].timestamp);
                    post_result_JSON_payload_cash.push(post_result_JSON_payload[i].temp);
                    // post_result_JSON_payload_ltrs.push(post_result_JSON_payload[i].ltrs);
                }
                // console.log(post_result_JSON_payload_ltrs);

                console.log(" *********************** ");
            })
            // fail -> error is deprecated in jQuery 1.8
            .fail(function(request, error) {
                console.log("error");
                alert("Request: " + $.parseJSON(request));
            })
            // always -> done is deprecated in jQuery 1.8
            .always(function() {
                console.log("always");
            })
        // .complete(function() {
        //     console.log("query completed");
        // })
    }
</script>