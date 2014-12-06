$(document).ready(function(){
$("#submit").click(function(){
var review = $("#comment").val();
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'review1='+ review;
if(review=='')
{
alert("Please fill in a review before you submit");
}
else
{
// AJAX Code To Submit Form.
$.ajax({
type: "POST",
url: "addReviews.php",
data: dataString,
cache: false,
success: function(result){
alert(result);
}
});
}
return false;
});
});