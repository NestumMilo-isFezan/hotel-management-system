$(document).ready(function () {
  // Disable the form on page load
  $("#infoform :input").prop("disabled", true);

  // Enable the form and show the button when 'edit' is clicked
  $("#editbtn").click(function () {
    $("#infoform :input").prop("disabled", false);
    $("#finishbtn").show();
  });

  $("#infoform").submit(function (e) {
    e.preventDefault();

    $.ajax({
      url: "edit.php",
      type: "POST",
      data: {
        hotelID: $("#hotelid").val(), //
        hotelname: $("#hotelname").val(), //
        contact: $("#contact").val(), //
        email: $("#email").val(), //
        address: $("#address").val(), //
        postcode: $("#postcode").val(), //
        city: $("#city").val(), //
        state: $("#state").val(),
        country: $("#country").val(),
        info: $("#info").val(),
        about: $("#about").val(),
      },
      success: function (response) {
        if (response === "ok") {
          $("#heade").load(document.URL + " #headcontent");
          $("#infoform :input").prop("disabled", true);
          $("#finishbtn").hide();

          var toaster = document.getElementById("editToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
        } else if (response === "error") {
          alert("error");
        }
      },
    });
  });
});
