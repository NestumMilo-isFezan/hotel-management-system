$(document).ready(function () {
  var condition;
  var id;

  $("#addform").submit(function (e) {
    e.preventDefault();

    if (condition == 0) {
      $.ajax({
        url: "add_news.php",
        type: "POST",
        data: {
          newstitle: $("#newstitle").val(),
          description: $("#description").val(),
        },
        success: function (response) {
          if (response === "ok") {
            $("#newscontent").load(document.URL + " #newstable");

            var toaster = document.getElementById("addNewsToast");
            var toast = new bootstrap.Toast(toaster);
            toast.show();
          } else if (response === "error") {
            alert("Error");
          }
        },
      });
    } else {
      $.ajax({
        url: "edit_news.php",
        type: "POST",
        data: {
          id: id,
          newstitle: $("#newstitle").val(),
          description: $("#description").val(),
        },
        success: function (response) {
          $("#newscontent").load(document.URL + " #newstable");

          var toaster = document.getElementById("editNewsToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();

          // Reset condition and id after successful edit
          condition = 0;
          id = null;
        },
      });
    }
  });

  $(document).on("click", ".editit", function () {
    id = $(this).data("id");
    condition = 1;
    $.ajax({
      url: "getdata_news.php",
      type: "post",
      data: { id: id },
      success: function (response) {
        // Assuming the response is a JSON object containing the data
        var data = JSON.parse(response);
        $("#newstitle").val(data.newstitle);
        $("#description").val(data.description);
      },
    });
  });

  $(document).on("click", "#addit", function () {
    condition = 0;
    $("#newstitle").val("");
    $("#description").val("");
  });

  $(document).on("click", ".deleteit", function () {
    $.ajax({
      url: "delete_news.php",
      type: "post",
      data: { id: $(this).data("id") },
      success: function (response) {
        if (response === "ok") {
          $("#newscontent").load(document.URL + " #newstable");

          var toaster = document.getElementById("deleteNewsToast");
          var toast = new bootstrap.Toast(toaster);
          toast.show();
        } else if (response === "error") {
          alert("Error");
        }
      },
    });
  });
});
