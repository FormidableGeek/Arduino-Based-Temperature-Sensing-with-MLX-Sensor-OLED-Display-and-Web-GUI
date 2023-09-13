function getRandomNumber() {
  $.ajax({
    url: 'http://127.0.0.1:8001/python',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
      var random_number = response.random_number;
      // Do something with the random number (e.g., display it on the page)
      $(".temp").text(random_number);
      $(".reading").val(random_number);
        },
    error: function(xhr, status, error) {
      console.error("Error:", error);
      $(".error").text("Unable to locate thermometer.");
    }
  });
}
// Call the function every 2 seconds
setInterval(getRandomNumber, 2000);
