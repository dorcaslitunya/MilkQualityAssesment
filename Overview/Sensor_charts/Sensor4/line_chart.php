<div>
    <canvas id="myChart_efdf"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chart_canvas4 = document.getElementById('myChart_efdf');
    var post_url4 = "/endpoints/chargers/gas_retrieve.php";
    let post_data4 = "{'sample': 10}";
    let post_result4;
    let post_result_JSON4;
    let post_result_JSON_payload_timeline4 = [];
    let post_result_JSON_payload_cash4 = [];
    let post_result_JSON_payload_ltrs4 = [];

    ajax_call();

    new Chart(chart_canvas4, {
        type: 'line',
        data: {
            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            labels: post_result_JSON_payload_timeline4,
            datasets: [{
                label: 'gas',
                // data: [12, 19, 3, 5, 2, 3],
                data: post_result_JSON_payload_cash4,
                borderWidth: 1
            }
            // , {
            //     label: 'ltrs',
            //     // data: [12, 19, 3, 5, 2, 3],
            //     data: post_result_JSON_payload_ltrs4,
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
                url: post_url4,
                method: "POST",
                cache: false,
                async: false,
                // crossDomain: "true",
                // dataType: 'json',
                // Note: For cross-domain requests, setting the content type to anything other than application/x-www-form-urlencoded, multipart/form-data, or text/plain will trigger the browser to send a preflight OPTIONS request to the server.
                contentType: "application/json;charset=utf-8",
                data: post_data4,
            })
            // .beforeSend(function(jqXHR, settings) {
            //     console.log("before send");
            //     // jqXHR.setRequestHeader(key, value);
            // })
            // done -> success is deprecated in jQuery 1.8
            .done(function(post_result4) {
                console.log(" *********************** ");
                console.log("done");
                // $("#ajax_call_resp_el").html(post_result4);
                // console.log(post_result4);
                // console.log(" --- ");
                post_result_JSON4 = $.parseJSON(post_result4);
                // console.log(post_result_JSON4["success"]);
                post_result_JSON_payload = post_result_JSON4["load"];
                console.log(post_result_JSON_payload);
                for (var i = 0; i < post_result_JSON_payload.length; i++) {
                    post_result_JSON_payload_timeline4.push(post_result_JSON_payload[i].timestamp);
                    post_result_JSON_payload_cash4.push(post_result_JSON_payload[i].gas_reading);
                    // post_result_JSON_payload_ltrs4.push(post_result_JSON_payload[i].ltrs);
                }
                // console.log(post_result_JSON_payload_ltrs4);

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