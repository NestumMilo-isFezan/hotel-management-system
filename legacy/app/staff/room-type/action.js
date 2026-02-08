$(document).ready(function () {
  // Conditional Manipulator
  var condition;
  var id;

  $("#uploadphoto").change(function () {
    if (this.files && this.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $(".frame").attr("src", e.target.result);
      };

      reader.readAsDataURL(this.files[0]);
    }
  });

  //Action/////////////////////////////////////////////////////////
  $("#addform").submit(function (e) {
    e.preventDefault();

    const formData = new FormData();

    const hotelID = $("#h_id").val();
    formData.append("hotelID", hotelID);

    formData.append("uploadphoto", $("#uploadphoto")[0].files[0]);
    formData.append("roomtype", $("#roomtype").val());
    formData.append("price", $("#price").val());
    formData.append("capacity", $("#capacity").val());
    formData.append("description", $("#description").val());

    $.ajax({
      url: "add.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        handleResponse(response);
      },
    });
    //
  });

  $("#editform").submit(function (e) {
    e.preventDefault();
    const formData = new FormData();

    const hotelID = $("#h_id").val();
    formData.append("hotelID", hotelID);

    formData.append("uploadphoto", $("#uploadphoto")[0].files[0]);
    formData.append("roomtype", $("#roomtype").val());
    formData.append("price", $("#price").val());
    formData.append("capacity", $("#capacity").val());
    formData.append("description", $("#description").val());

    $.ajax({
      url: "edit.php",
      type: "POST",
      data: {
        formData,
        id: id,
      },
      processData: false,
      contentType: false,
      success: function (response) {
        handleResponse(response);
      },
    });
    //
  });

  $(document).on("click", ".editit", function () {
    id = $(this).data("id");

    $.ajax({
      url: "getdata.php",
      type: "post",
      data: { id: id },
      success: function (response) {
        // Assuming the response is a JSON object containing the data
        var data = JSON.parse(response);
        $("#roomtype").val(data.name);
        $("#description").val(data.description);
        $("#price").val(data.price);
        $("#capacity").val(data.capacity);

        $(".frame").attr("src", data.room_imgpath);
      },
    });
  });

  $(document).on("click", ".addit", function () {
    $("#roomtype").val("");
    $("#price").val("");
    $("#capacity").val("");
    $("#description").val("");
    $(".frame").attr("src", "../../img/upload.jpg");
  });

  function handleResponse(response) {
    switch (response) {
      case "ok":
      case "nice":
        $("#tablecontent").load(document.URL + " #typetable");
        var toaster = document.getElementById("addToast");
        var toast = new bootstrap.Toast(toaster);
        toast.show();
        break;
      case "ok1":
        $("#tablecontent").load(document.URL + " #typetable");
        var toaster = document.getElementById("editToast");
        var toast = new bootstrap.Toast(toaster);
        toast.show();
        break;
      case "ok3":
        $("#tablecontent").load(document.URL + " #typetable");
        var toaster = document.getElementById("deleteToast");
        var toast = new bootstrap.Toast(toaster);
        toast.show();
        break;
      case "existed":
        alert("The files is existed");
        break;
      case "too large":
        alert("The file is too big too handle");
        break;
      case "wrong format":
        alert(
          "Please make sure the image file is correct. Only these (JPG and PNG) allowed~"
        );
        break;
      case "unfortunately":
        alert("Maybe system is in error?");
        break;
      default:
        alert(response);
        break;
    }
  }

  $(document).on("click", ".deleteit", function () {
    $.ajax({
      url: "delete.php",
      type: "post",
      data: { id: $(this).data("id") },
      success: function (response) {
        handleResponse(response);
      },
    });
  });
  //
});
