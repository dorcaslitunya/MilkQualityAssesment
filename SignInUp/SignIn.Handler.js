$(document).ready(function () {
  let form_tfm_time = 500;
  let url = "/endpoints/profile/SignIn.Handler.php";
 
  $("#btn_signin").on("click", function () {
    var email = $("#email").val();
    var password = $("#password").val();
    if (email != "" && password != "") {
      $.ajax({
        url: url,
        type: "POST",
        data: {
          email: email,
          password: password,
        },
        cache: false,
        success: function (dataResult) {
          console.log(dataResult);
          var dataResult = JSON.parse(dataResult);
          if (dataResult.success == 1) {
            if (!dataResult.group) {
              // console.log("----- group is null -----")
              location.href = "/";
            } else {
              // console.log("----- group is not null -----")
              location.href = "/";
            }
          } else if (dataResult.code == 0) {
            // console.log("201")
            $("#error").show();
            $("#error").html("Invalid Email or Password !");
          } else {
            // console.log("201")
            $("#error").show();
            $("#error").html("error logging you in");
          }
        },
      });
    } else {
      alert("Please fill all fields");
    }
  });
});
