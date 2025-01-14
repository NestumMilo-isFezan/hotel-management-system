$(document).ready(function () {
  // Variables
  let servicePay = 0;

  // Reusable Function: Calculate Total Price
  function calculateTotalPrice(roomPrice, days, servicePrice) {
    return (roomPrice * days + servicePrice).toFixed(2);
  }

  // Reusable Function: Update UI for Total Price
  function updateUI(price) {
    $("#estprice").text(price);
    $("#totalprice").val(price);
  }

  // Reusable Function: Validate Dates
  function validateDates(checkIn, checkOut) {
    if (checkIn >= checkOut) {
      alert("Error: Check-out date must be later than check-in date.");
      const tomorrow = new Date(checkIn.getTime() + 24 * 60 * 60 * 1000);
      $("#checkout").val(tomorrow.toISOString().split("T")[0]);
      return false;
    }
    return true;
  }

  // Event Handler: Check-in and Check-out Date Selection
  $("#checkin, #checkout").change(function () {
    const checkIn = new Date($("#checkin").val());
    const checkOut = new Date($("#checkout").val() || new Date(checkIn.getTime() + 24 * 60 * 60 * 1000));

    if (!validateDates(checkIn, checkOut)) return;

    const diffDays = Math.abs(checkOut - checkIn) / (1000 * 3600 * 24);
    const roomPrice = parseFloat($("#price").val());

    updateUI(calculateTotalPrice(roomPrice, diffDays, servicePay));
  });

  // Event Handler: Service Selection
  $("#services").change(function () {
    const selectedService = $("#services").find(":selected").val();
    $.ajax({
      type: "GET",
      url: "getserviceprice.php",
      data: { service: selectedService },
      dataType: "json",
      success: function (data) {
        servicePay = parseFloat(data.price);
        const roomPrice = parseFloat($("#price").val());
        const diffDays = Math.abs(new Date($("#checkout").val()) - new Date($("#checkin").val())) / (1000 * 3600 * 24);

        updateUI(calculateTotalPrice(roomPrice, diffDays, servicePay));
      },
    });
  });

  // Reusable Function: Show Toast Notification
  function showToast(message, type) {
    const toastHTML = `
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">System</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body text-${type}">
          ${message}
        </div>
      </div>`;
    $(".toast-container").append(toastHTML);
    const toast = new bootstrap.Toast($(".toast").last()[0]);
    toast.show();
  }

  // Form Submission: Book Now
  $("#bookform").submit(function (e) {
    e.preventDefault();

    const data = {
      roomID: $("#roomID").val(),
      guestID: $("#guestID").val(),
      services: $("#services option:selected").val(),
      checkin: $("#checkin").val(),
      checkout: $("#checkout").val(),
      totalprice: $("#totalprice").val(),
    };

    $.ajax({
      url: "book.php",
      type: "POST",
      data: data,
      success: function (response) {
        if (response === "ok") {
          showToast("Successfully booked the room. Redirecting...", "success");
          setTimeout(() => {
            window.location = "../../index.php";
          }, 3000);
        } else {
          showToast("Booking failed. Please try again later.", "danger");
        }
      },
    });
  });
});
