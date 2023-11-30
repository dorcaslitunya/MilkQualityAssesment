<div>
    <canvas id="myChart_turb"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chart_canvas3 = document.getElementById('myChart_turb');
    var post_url3 = "/endpoints/chargers/turbidity_retrieve.php";
    let post_data3 = "{'sample': 10}";
    let post_result3;
    let post_result_JSON3;
    let post_result_JSON_payload_timeline3 = [];
    let post_result_JSON_payload_cash3 = [];
    let post_result_JSON_payload_ltrs3 = [];

    ajax_call();

    new Chart(chart_canvas3, {
        type: 'line',
        data: {
            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            labels: post_result_JSON_payload_timeline3,
            datasets: [{
                label: 'turbidity',
                // data: [12, 19, 3, 5, 2, 3],
                data: post_result_JSON_payload_cash3,
                borderWidth: 1
            }
            // , {
            //     label: 'ltrs',
            //     // data: [12, 19, 3, 5, 2, 3],
            //     data: post_result_JSON_payload_ltrs3,
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
                url: post_url3,
                method: "POST",
                cache: false,
                async: false,
                // crossDomain: "true",
                // dataType: 'json',
                // Note: For cross-domain requests, setting the content type to anything other than application/x-www-form-urlencoded, multipart/form-data, or text/plain will trigger the browser to send a preflight OPTIONS request to the server.
                contentType: "application/json;charset=utf-8",
                data: post_data3,
            })
            // .beforeSend(function(jqXHR, settings) {
            //     console.log("before send");
            //     // jqXHR.setRequestHeader(key, value);
            // })
            // done -> success is deprecated in jQuery 1.8
            .done(function(post_result3) {
                console.log(" *********************** ");
                console.log("done");
                // $("#ajax_call_resp_el").html(post_result3);
                // console.log(post_result3);
                // console.log(" --- ");
                post_result_JSON3 = $.parseJSON(post_result3);
                // console.log(post_result_JSON3["success"]);
                post_result_JSON_payload = post_result_JSON3["load"];
                console.log(post_result_JSON_payload);
                for (var i = 0; i < post_result_JSON_payload.length; i++) {
                    post_result_JSON_payload_timeline3.push(post_result_JSON_payload[i].timestamp);
                    post_result_JSON_payload_cash3.push(post_result_JSON_payload[i].turbidity_reading);
                    // post_result_JSON_payload_ltrs3.push(post_result_JSON_payload[i].ltrs);
                }
                // console.log(post_result_JSON_payload_ltrs3);

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