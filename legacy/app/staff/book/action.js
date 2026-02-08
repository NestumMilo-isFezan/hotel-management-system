$(document).ready(function () {
  $(".confirmit").click(function (e) {
    e.preventDefault();

    $.ajax({
      url: "confirm.php",
      type: "post",
      data: {
        book: $(this).data("id"),
        room: $(this).data("room"),
      },
      success: function (response) {
        if (response === "ok") {
          $("#confirmcontent").load(document.URL + " #confirmedtable");

          var toaster = document.getElementById("editToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
        } else if (response === "error") {
          alert("Error");
        }
      },
    });
  });

  $(".confirmcancel").click(function () {
    var id = $(this).data("id");
    $.ajax({
      url: "delete.php",
      type: "post",
      data: {
        id: id,
      },
      success: function (response) {
        if (response === "ok") {
          $("#cancelcontent").load(document.URL + " #canceltable");

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
