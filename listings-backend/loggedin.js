var imgCount = 1;
var editImgCount = 1;
jQuery.loadScript = function (url, callback) {
    jQuery.ajax({
        url: 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
        dataType: 'script',
        success: callback,
        async: true
    });
}

//window scroll to match with navbar
$(window).scroll(function() {
  var offsets1 = $("#section1").offset();
  var bottom1 = offsets1.top + $("#section1").height();
  var offsets2 = $("#section2").offset();
  var bottom2 = offsets2.top + $("#section2").height();
  var offsets3 = $("#section3").offset();
  var bottom3 = offsets3.top + $("#section3").height();
  var offsets4 = $("#section4").offset();
  var bottom4 = offsets4.top + $("#section4").height();
  var cur = $(window).scrollTop();

  if (0 < cur && cur < bottom1) {
    document.getElementById("sideOpt2").style.backgroundColor = "black";
    document.getElementById("sideOpt3").style.backgroundColor = "black";
    document.getElementById("sideOpt4").style.backgroundColor = "black";
    document.getElementById("sideOpt1").style.backgroundColor = "#3a4bff";
  }
  if (bottom1 < cur && cur < bottom2) {
    document.getElementById("sideOpt1").style.backgroundColor = "black";
    document.getElementById("sideOpt3").style.backgroundColor = "black";
    document.getElementById("sideOpt4").style.backgroundColor = "black";
    document.getElementById("sideOpt2").style.backgroundColor = "#3a4bff";
  }
  if (bottom2 < cur && cur < bottom3) {
    document.getElementById("sideOpt1").style.backgroundColor = "black";
    document.getElementById("sideOpt2").style.backgroundColor = "black";
    document.getElementById("sideOpt4").style.backgroundColor = "black";
    document.getElementById("sideOpt3").style.backgroundColor = "#3a4bff";
  }
  if (bottom3 < cur && cur < bottom4) {
    document.getElementById("sideOpt1").style.backgroundColor = "black";
    document.getElementById("sideOpt2").style.backgroundColor = "black";
    document.getElementById("sideOpt3").style.backgroundColor = "black";
    document.getElementById("sideOpt4").style.backgroundColor = "#3a4bff";
  }
});

//close the edit form
function cancelEdit() {
  document.getElementById("form-popup").style.display = "none";
}

//remove image in edit listing
function removeImg(index, src) {
  var retVal = confirm("Delete image " + index);
  if (retVal === false) {
    return;
  }

  document.getElementById("imgEd-" + index).style.display = "none";
 
  imgEd.splice(imgEd.indexOf(src), 1);
 
  document.getElementById("image_array").value = imgEd.join();
}

//appends new file upload btn to manual form
$("#newFile").click(function() {
  $("#uploadFiles").append(
    '<br><input type="file" name="myfile' + imgCount + '" id="fileToUpload">'
  );
  document.getElementById("file_length").value = imgCount;
  imgCount++;
});

//append new file upload btn to edit form
function appendFileUpload() {
  $("#edit-uploadFiles").append(
    '<br><input type="file" name="myfile' +
      editImgCount +
      '" id="fileToUpload">'
  );
  document.getElementById("edit_file_length").value = editImgCount;

  editImgCount++;
}

//delete listing with mlsid elem
function remove(elem,id,type) {
  //alert(elem);
  var retVal = confirm("Delete listing " + elem);

  if (retVal === false) {
    return;
  }
  
  $.ajax({
    type: "POST",
    url: "remove.php",
    data: { address: elem,ids:id,types:type },
    success: function(data) {
      console.log(data);
      location.reload();
    },
    error: function(xhr, status, error) {
      alert(xhr.responseText+status.responseText+error.responseText);
    },
    dataType: "text"
  });
}

//array of all images displayed on current edit form
var imgEd = [];

function edit(
  mlsid,
  jsonImg,
  description,
  price,
  streetaddress,
  addressLocality,
  beds,
  bathrooms,
  propsize,
  proptype,
  l_id,
  item_id,
  type,
  LotSize,
  YearBuilt,
  Brokerage
) {
  imgEd = [];
  imgCount = 1;
  editImgCount = 1;
  var imgs = jsonImg.split(",");

  document.getElementById("form-popup").style.display = "block";
 
  var img_disp = "";

  for (var i = 0; i < imgs.length; i++) {
    imgEd[i] = imgs[i];
    img_disp +=
      "<img src='" +
      imgs[i] +
      "' class='img-responsive' style='width:30%' alt='' id = 'imgEd-" +
      i +
      "' onclick=\"removeImg(" +
      i +
      ", '" +
      imgs[i] +
      "')\"></img>";
  }

  var theDiv = document.getElementById("form-popup");
  theDiv.innerHTML =
    "<form action='editListing.php' class='form-container' method='post' enctype='multipart/form-data'><h1>Edit Listing</h1><hr><h2 class='edit-Constant'>MLSID:" +
    mlsid +
    "</h2><h2 class='edit-Constant' name='streetaddress'>"+'Street Address:' +
    streetaddress +
    "</h2><input type='hidden' name='lids' value=" + l_id + "><input type='hidden' name='L_type' value=" + type + "><input type='hidden' name='streetaddrr' value='"+streetaddress+"'><input type='hidden' name='items_id' value=" + item_id + "><h2 class='edit-Constant'>Locality:" +
    addressLocality +
    "<hr><input type='hidden' id='image_array' name='image_array' value=''/><label for='images'><b>Change images</b></label><br><div id='edit-uploadFiles'> <input type='hidden' name='mlsid' value='" +
    mlsid +
    "'/> <input type='hidden' id = 'edit_file_length' name='edit_file_length' value='0'/> Upload Images:<button id='edit-newFile' type='button' onclick='appendFileUpload()' class= 'upload-plus-btn'>+</button> <br> <input type='file' name='myfile0' id='fileToUpload'> </div> <div id='edit-disp-img'>" +
    "<hr><p>Click on an image to delete it </p><br>" +
    img_disp +
    "</div><br><label for='description'><b>Description</b></label><input type='text' placeholder='Enter Description' name='description' value='" +
    description +
    "' required><label for='price'><b>Price</b></label><input type='text' placeholder='Enter price' name='price' value='" +
    price +
    "' required><label for='beds'><b>Number of Beds</b></label><input type='text' placeholder='Enter number of beds' name='beds' value='" +
    beds +
    "' required><label for='bathrooms'><b>Number of Bathrooms</b></label><input type='text' placeholder='Enter number of bathrooms' name='bathrooms' value='" +
    bathrooms +
    "' required><label for='size'><b>Property Size</b></label><input type='text' placeholder='Enter property size' name='size' value='" +
    propsize +
    /*-----------------------------------*/
     "' required><label for='size'><b>Lot Size</b></label><input type='text' placeholder='Enter Lot Size' name='LotSize' value='" +
    LotSize +
     "' required><label for='size'><b>Year Built</b></label><input type='text' placeholder='Enter Year Built' name='YearBuilt' value='" +
    YearBuilt +
     "' required><label for='size'><b>Brokerage</b></label><input type='text' placeholder='Enter Brokerage' name='Brokerage' value='" +
    Brokerage +
    /*--------------------------------------*/
    "' required><label for='type'><b>Property Type</b></label><select class='form-control responsive input-b2 input-inner' placeholder='Enter property type' name='building_type' value=''><option value='"+proptype+"' selected>"+proptype+"</option><option value='Duplex'>Duplex</option><option value='House'>House</option><option value='Apartment'>Apartment</option><option value='Manufactured Home'>Manufactured Home</option><option value='Mobile Home'>Mobile Home</option><option value='Recreational'>Recreational</option><option value='Lot'>Lot</option><option value='Townhouse'>Townhouse</option><option value='Apt/Condo'>Apt/Condo</option></select><input class='black-btn' type='submit' value='Submit'><button type='button' class='black-btn' id = 'editCancel' onclick='cancelEdit()'>cancel</button></form>";

  document.getElementById("image_array").value = imgEd.join();
}
function markActive(elem,id) {
  var retVal = confirm("Mark Listing " + elem + " as Active");
  
  if (retVal == false) {
    return;
  }

  $.ajax({
    type: "POST",
    url: "markedActive.php",
    data: { mlsid: elem,ids: id },
    success: function(data) {
      location.reload();
    },
    error: function(xhr, status, error) {
      // check status && error
    },
    dataType: "text"
  });
}

function markSold(elem,id) {
  var retVal = confirm("Mark Listing " + elem + " as Sold");
  if (retVal == false) {
    return;
  }

  $.ajax({
    type: "POST",
    url: "markedSold.php",
    data: { mlsid: elem,ids: id },
    success: function(data) {
      location.reload();
    },
    error: function(xhr, status, error) {
      // check status && error
    },
    dataType: "text"
  });
}
