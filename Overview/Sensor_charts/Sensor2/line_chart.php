<div>
    <canvas id="myChart_ph"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chart_canvas2 = document.getElementById('myChart_ph');
    var post_url2 = "/endpoints/chargers/pH_retrieve.php";
    let post_data2 = "{'sample': 10}";
    let post_result2;
    let post_result_JSON2;
    let post_result_JSON_payload_timeline2 = [];
    let post_result_JSON_payload_cash2 = [];
    let post_result_JSON_payload_ltrs2 = [];

    ajax_call();

    new Chart(chart_canvas2, {
        type: 'line',
        data: {
            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            labels: post_result_JSON_payload_timeline2,
            datasets: [{
                label: 'pH',
                // data: [12, 19, 3, 5, 2, 3],
                data: post_result_JSON_payload_cash2,
                borderWidth: 1
            }
            // , {
            //     label: 'ltrs',
            //     // data: [12, 19, 3, 5, 2, 3],
            //     data: post_result_JSON_payload_ltrs2,
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
                url: post_url2,
                method: "POST",
                cache: false,
                async: false,
                // crossDomain: "true",
                // dataType: 'json',
                // Note: For cross-domain requests, setting the content type to anything other than application/x-www-form-urlencoded, multipart/form-data, or text/plain will trigger the browser to send a preflight OPTIONS request to the server.
                contentType: "application/json;charset=utf-8",
                data: post_data2,
            })
            // .beforeSend(function(jqXHR, settings) {
            //     console.log("before send");
            //     // jqXHR.setRequestHeader(key, value);
            // })
            // done -> success is deprecated in jQuery 1.8
            .done(function(post_result2) {
                console.log(" *********************** ");
                console.log("done");
                // $("#ajax_call_resp_el").html(post_result2);
                // console.log(post_result2);
                // console.log(" --- ");
                post_result_JSON2 = $.parseJSON(post_result2);
                // console.log(post_result_JSON2["success"]);
                post_result_JSON_payload = post_result_JSON2["load"];
                console.log(post_result_JSON_payload);
                for (var i = 0; i < post_result_JSON_payload.length; i++) {
                    post_result_JSON_payload_timeline2.push(post_result_JSON_payload[i].timestamp);
                    post_result_JSON_payload_cash2.push(post_result_JSON_payload[i].ph_reading);
                    // post_result_JSON_payload_ltrs2.push(post_result_JSON_payload[i].ltrs);
                }
                // console.log(post_result_JSON_payload_ltrs2);

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