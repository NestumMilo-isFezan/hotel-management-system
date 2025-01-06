$(document).ready(function () {
  $(".checkinit").click(function (e) {
    e.preventDefault();

    $.ajax({
      url: "checkin.php",
      type: "post",
      data: {
        book: $(this).data("book"),
      },
      success: function (response) {
        if (response === "ok") {
          $("#checkincontent").load(document.URL + " #checkintable");

          var toaster = document.getElementById("editToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
        } else if (response === "error") {
          alert("Error");
        }
      },
    });
  });

  $(".cancelit").click(function () {
    $.ajax({
      url: "cancel.php",
      type: "post",
      data: {
        book: $(this).data("book"),
        room: $(this).data("room"),
      },
      success: function (response) {
        if (response === "ok") {
          $("#checkincontent").load(document.URL + " #checkintable");

          var toaster = document.getElementById("deleteToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
        } else if (response === "error") {
          alert("Error");
        }
      },
    });
  });
});
