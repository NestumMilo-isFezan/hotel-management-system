$(document).ready(function () {
  $(".checkinit").click(function (e) {
    e.preventDefault();

    async function handleCheckIn(bookingId) {
      try {
        const response = await fetch(`api/checkin.php?id=${bookingId}`);
        await ErrorHandler.handleFetchError(response);
        const data = await response.json();
        // Handle success
      } catch (error) {
        ErrorHandler.showError(error.message);
      }
    }

    handleCheckIn($(this).data("book"));
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
