(function ($) {
$(document).ready(function(){
	$("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',autoplay_slideshow: false});
});


$('.tab2 a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})

}(jQuery));