$(document).ready(function () {
  $("#loginform").submit(function (e) {
    e.preventDefault();

    $.ajax({
      url: "/login",
      type: "POST",
      data: {
        email: $("#loginemail").val(),
        password: $("#loginpass").val(),
      },
      success: function (response) {
        if (response === "error") {
          alert("sql error");
        } else if (response === "password error") {
          alert("Password is not match");
        } else if (response === "guest") {
          var toaster = document.getElementById("guestToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
          setTimeout(function () {
            window.location = "/";
          }, 2000);
        } else if (response === "staff") {
          var toaster = document.getElementById("staffToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
          setTimeout(function () {
            window.location = "/staff/dashboard";
          }, 2000);
        }

        // Set Timeout
      },
    });
  });

  $("#registernow").click(function (e) {
    e.preventDefault();

    $.ajax({
      url: "/register",
      type: "POST",
      data: {
        email: $("#registeremail").val(),
        password: $("#regpassword").val(),
        username: $("#username").val(),
        confirmPwd: $("#confirmpass").val(),
        fname: $("#fname").val(),
        lname: $("#lname").val(),
      },
      success: function (response) {
        if (response === "password not match") {
          alert("Password Not Match");
        } else if (response === "sql error") {
          alert("SQL Error");
        } else if (response === "email exist") {
          alert("Email Exist");
        } else if (response === "passed") {
          var toaster = document.getElementById("addToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
        }

        // Set Timeout
      },
    });
  });
});
