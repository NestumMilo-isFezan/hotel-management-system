$(document).ready(function () {
  var condition;
  var id;

  $("#addform").submit(function (e) {
    e.preventDefault();

    if (condition == 0) {
      $.ajax({
        url: "add.php",
        type: "POST",
        data: {
          servicename: $("#servicename").val(),
          description: $("#description").val(),
          price: $("#price").val(),
          status: $("#status").val(),
        },
        success: function (response) {
          $("#tablecontent").load(document.URL + " #tablecontent");

          var toaster = document.getElementById("addToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
        },
      });
    } else {
      $.ajax({
        url: "edit.php",
        type: "POST",
        data: {
          id: id,
          servicename: $("#servicename").val(),
          description: $("#description").val(),
          price: $("#price").val(),
          status: $("#status").val(),
        },
        success: function (response) {
          $("#tablecontent").load(document.URL + " #tablecontent");

          var toaster = document.getElementById("editToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
        },
      });
    }
  });

  $(document).on("click", "#editit", function () {
    id = $(this).data("id");
    condition = 1;
    $.ajax({
      url: "getdata.php",
      type: "post",
      data: { id: id },
      success: function (response) {
        // Assuming the response is a JSON object containing the data
        var data = JSON.parse(response);
        $("#servicename").val(data.name);
        $("#description").val(data.description);
        $("#price").val(data.price);
        $("#status").val(data.servicestatus);
      },
    });
  });

  $(document).on("click", "#addit", function () {
    condition = 0;
    $("#servicename").val("");
    $("#description").val("");
    $("#price").val("");
    $("#status").val("select");
  });

  $(document).on("click", "#deleteit", function () {
    $.ajax({
      url: "delete.php",
      type: "post",
      data: { id: $(this).data("id") },
      success: function (response) {
        $("#tablecontent").load(document.URL + " #tablecontent");

        var toaster = document.getElementById("deleteToast");
        var toast = new bootstrap.Toast(toaster);
        toast.show();
      },
    });
  });
});
