$(document).ready(function () {
    var form_tfm_time = 500;

    $("#swtch_to_signin").on("click", function () {
        $(".sign_up_in").show(form_tfm_time);
        $(".sign_up").hide(form_tfm_time);
        $(".sign_in").show(form_tfm_time);
        $("#btn_signin").show(form_tfm_time);
        $("#btn_signup").hide(form_tfm_time);
    });
    $("#swtch_to_signup").on("click", function () {
        $(".sign_up").show(form_tfm_time);
        $(".sign_in").hide(form_tfm_time);
        // $('.sign_up_in').show(form_tfm_time)
        $("#btn_signin").hide(form_tfm_time);
        $("#btn_signup").show(form_tfm_time);
    });

});
