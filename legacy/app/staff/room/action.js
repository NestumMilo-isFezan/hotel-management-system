$(document).ready(function () {
  var condition;
  var id;

  $("#addform").submit(function (e) {
    e.preventDefault();

    if (condition == 0) {
      $.ajax({
        url: "add_room.php",
        type: "POST",
        data: {
          id: id,
          roomtype: $("#roomtype").val(),
          roomstatus: $("#roomstatus").val(),
          roomNo: $("#roomNo").val(),
        },
        success: function (response) {
          $("#tablecontent").load(document.URL + " #tablecontent");

          var toaster = document.getElementById("addToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
          $('#formmodal').modal('hide');
        },
      });
    } else {
      $.ajax({
        url: "edit_room.php",
        type: "POST",
        data: {
          id: id,
          roomtype: $("#roomtype").val(),
          roomstatus: $("#roomstatus").val(),
          roomNo: $("#roomNo").val(), 
        },
        success: function (response) {
          $("#tablecontent").load(document.URL + " #tablecontent");

          var toaster = document.getElementById("editToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
          $('#formmodal').modal('hide');
        },
      });
    }
  });

  $(document).on("click", "#editit", function () {
    id = $(this).data("id");
    condition = 1;
    $.ajax({
      url: "getdata_room.php",
      type: "post",
      data: { id: id },
      success: function (response) {
        // Assuming the response is a JSON object containing the data
        var data = JSON.parse(response);
        $("#roomNo").val(data.roomNo);
        $("#roomtype").val(data.typeID);
        $("#roomstatus").val(data.roomstatus);
      },
    });
  });

  $(document).on("click", "#addit", function () {
    condition = 0;
    $("#roomNo").val("");
    $("#roomtype").val("select");
    $("#roomstatus").val("select");
  });

  $(document).on("click", "#deleteit", function () {
    $.ajax({
      url: "delete_room.php",
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
