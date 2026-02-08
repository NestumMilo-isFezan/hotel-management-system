$(document).ready(function () {
  // Variables
  let totalHotel = 0;
  let servicePay = 0;
  let totalpayment = 0;

  // Function to update totalPrice
  function updateTotalPrice() {
    const totalPrice = (totalHotel + servicePay).toFixed(2);
    $("#estprice").text(totalPrice);
    $("#totalprice").val(totalPrice);
    totalpayment = totalPrice;
  }

  // Event when checkin and checkout is selected
  $("#checkin, #checkout").change(function () {
    // Init Date
    const checkIn = new Date($("#checkin").val());
    const checkOut = new Date(
      $("#checkout").val() ||
        new Date(checkIn.getTime() + 24 * 60 * 60 * 1000)
          .toISOString()
          .split("T")[0]
    );

    // Validate Date
    if (checkIn >= checkOut) {
      alert("Error: Check-out date must be later than check-in date.");
      const tomorrow = new Date(checkIn.getTime() + 24 * 60 * 60 * 1000);
      $("#checkout").val(tomorrow.toISOString().split("T")[0]);
      return;
    }

    const diffDays = Math.abs(checkOut - checkIn) / (1000 * 3600 * 24);
    const pricePerDay = $("#price").val();
    totalHotel = pricePerDay * diffDays;

    // Update totalPrice
    updateTotalPrice();
  });

  // Separate event for #servicess
  $("#services").change(function () {
    const servselected = $("#services").find(":selected").val();
    $.ajax({
      type: "GET",
      url: "/get-service-price",
      data: { service: servselected },
      dataType: "json",
      success: function (data) {
        servicePay = Number(data.price);

        // Update totalPrice
        updateTotalPrice();
      },
    });
  });

  $("#bookform").submit(function (e) {
    e.preventDefault();

    roomID = $("#roomID").val();
    services = $("#services option:selected").val();
    checkin = $("#checkin").val();
    checkout = $("#checkout").val();
    totalprice = $("#totalprice").val();

    $.ajax({
      url: "/book",
      type: "POST",
      data: {
        roomID: $("#roomID").val(),
        guestID: $("#guestID").val(),
        services: services,
        checkin: checkin,
        checkout: checkout,
        totalprice: $("#totalprice").val(),
      },
      success: function (response) {
        if (response === "ok") {
          setTimeout(function () {
            window.location = "/";
          }, 3000);

          var toaster = document.getElementById("addToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
        } else {
          var toaster = document.getElementById("errorToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
        }
      },
    });
  });
});
