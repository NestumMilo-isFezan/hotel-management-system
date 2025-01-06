$(document).ready(function () {
  // Disable the form on page load
  $(".ded").prop("disabled", true);

  // Enable the form and show the button when 'edit' is clicked
  $("#editbtn").click(function () {
    $(".ded").prop("disabled", false);
  });

  $("#infoform").submit(function (e) {
    e.preventDefault();

    $.ajax({
      url: "edit.php",
      type: "POST",
      data: {
        firstname: $("#fname").val(), //
        lastname: $("#lname").val(), //
        address: $("#address").val(), //
        postcode: $("#postcode").val(), //
        city: $("#city").val(), //
        state: $("#state").val(),
        country: $("#country").val(),
      },
      success: function (response) {
        if (response === "ok") {
          $("#heade").load(document.URL + " #headcontent");
          $(".ded").prop("disabled", true);

          var toaster = document.getElementById("editToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
        } else {
          alert(response);
        }
      },
    });
  });
});
