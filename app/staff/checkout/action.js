$(document).ready(function () {
  $(".checkoutit").click(function (e) {
    e.preventDefault();

    // Get the bookID from the button's data attribute
  var bookID = $(this).data("book");

  // Redirect to payment.php with bookID parameter
  window.location.href = "../payment/index.php?bookID=" + bookID;
  });

  $(".clearit").click(function () {
    $.ajax({
      url: "delete.php",
      type: "post",
      data: {
        book: $(this).data("book"),
        room: $(this).data("room"),
      },
      success: function (response) {
        if (response === "ok") {
          $("#clearcontent").load(document.URL + " #cleartable");

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
