

if (window.history.replaceState) {
	window.history.replaceState(null, null, window.location.href);
}
// 
var previousScrollPosition;
// -------------------------------------------------------
$(window).scroll(function () {
	var currentScrollPosition = $(window).scrollTop() + $(window).height();
	if (currentScrollPosition > previousScrollPosition) {
		$('#header-container').addClass('changePOS');
		var x = $(window).width();
		if (x > 1500) {
			$('#containt .menu').addClass('pos-fixed-menu');
		}
	} else if (currentScrollPosition < previousScrollPosition) {
		$('#header-container').removeClass('changePOS');
	}

	if ($(this).scrollTop() < 150) {
		$('#containt .menu').removeClass('pos-fixed-menu');
	} else if ($(this).scrollTop() > 300) {
		//thực hiện lệnh điều kiện Khi lăn chuột xuống dưới hơn 00px
		$('.back-to-top').fadeIn(); //Xuất hiện nút
	} else {
		$('.back-to-top').fadeOut(); //Ẩn nút 
	}
	previousScrollPosition = currentScrollPosition;
});

// --------------------------------------------------------------------
$(window).resize(function () {
	var x = $(window).width();
	if (x < 1500) {
		$('#containt .menu').removeClass('pos-fixed-menu');
	}
});
// --------------------------------------------------------------------
$('.back-to-top').click(function () {
	$("html, body").animate({
		scrollTop: 0
	}, 0); //Animation giúp hoạt ảnh scroll ngược lên đầu trang sẽ mượt hơn
	return false;
});
//-------------------------BACK-TO-TOP-------------------------------
// $(document).ready(function(){
// 	$(window).scroll(function() {
// 		if ($(this).scrollTop() > 300) {
// 			//thực hiện lệnh điều kiện Khi lăn chuột xuống dưới hơn 100px
// 			$('.back-to-top').fadeIn(); //Xuất hiện nút
// 			 $('#header-container').addClass('changePOS');

// 		} else {
// 			$('.back-to-top').fadeOut(); //Ẩn nút
// 			 $('#header-container').removeClass('changePOS');
// 		}
// 	});
// 	$('.back-to-top').click(function() {
// 		$("html, body").animate({
// 			scrollTop: 0 },1000); //Animation giúp hoạt ảnh scroll ngược lên đầu trang sẽ mượt hơn
// 		return false;
// 	});
// });
////////////////////////////////////////////

//--------------------NIGHT-MOD-------------------
var nightModeToggleButton = document.querySelector('.night-mod-button');
var change_theme_dark = document.getElementById("dark-mode");
var change_logo_dark = document.querySelector(".logo-bt-nm");
var change_logo_icon = document.querySelector(".avartar");


// var dem = true;

// nightModeToggleButton.onclick = function () {
// 	nightModeToggleButton.classList.toggle("night-mode");
// 	if (dem) {
// 		change_theme_dark.href = "./Style_index/dark-mode.css";
// 		change_logo_dark.src = "./images/lododarkmode-open5.png";
// 		change_logo_icon.src = "./images/logoindex.png";
// 		dem = false;
// 	} else {
// 		change_theme_dark.href = "";
// 		change_logo_dark.src = "./images/lododarkmode-open-sun5.png";
// 		change_logo_icon.src = "./images/indexlogo2.png";
// 		dem = true;
// 	}
// };

//----------------------NAV--------------
$(document).ready(function () {
	$('.banner-left-top .owl-theme').hover(function () {
		$('.banner-left-top .owl-theme .owl-nav').css({ "opacity": "1" });
	}, function () {
		$('.banner-left-top .owl-theme .owl-nav').css({ "opacity": "0" });
	});
});

// -----------------------HIDE-HEADER-----------------------------
// $(window).resize(function() {
// 	var width = $(window).width();
// 	console.log(width);
// 	if (width < 600) {
// 		$(window).scroll(function() {
// 			if ($(this).scrollTop() > 300) 
// 			{
// 				$('#header-container').fadeOut();
// 			} else {
// 				$('#header-container').fadeIn();
// 			}
// 		});
// 	}
// });
// ---------------------------USER----------------

//-------------------------NIGHT-MOD-------------------------------

// var nightModeToggleButton  = document.querySelector('.night-mod-button');
// var nMod_container 		   = document.querySelector('#container');
// var nMod_header_container  = document.querySelector('#header-container');
// var nMod_login			   = document.querySelector('.login');
// var nMod_register		   = document.querySelector('.register');
// var nMod_my_Basket		   = document.querySelector('.my-basket');
// var nMod_search			   = document.querySelector('.search');
// var nMod_input_search	   = document.querySelector('.input-search');
// var nMod_menu_item 		   = document.getElementsByClassName('menu-item');
// var nMod_s_containt_right_top = document.querySelector('.s-containt-right-top');


// nightModeToggleButton.onclick = function () {
//  	nightModeToggleButton.classList.toggle("night-mode");
//   	nMod_container.classList.toggle("night-mode");
//   	nMod_header_container.classList.toggle("night-mode");
//  	nMod_login.classList.toggle("night-mode");
//   	nMod_register.classList.toggle("night-mode");
//   	nMod_my_Basket.classList.toggle("night-mode");
//   	nMod_search.classList.toggle("night-mode");
//   	nMod_input_search.classList.toggle("night-mode");
//   //------------------------------------------------
//   for(var i=0; i<nMod_menu_item.length; i++){
// 		nMod_menu_item[i].classList.toggle("night-mode");
// 	}

// };


//-----------------------------SCROLL-MOOT----------------
//---------------------------JAVASCRIPT - SLIDESHOW-SP--------------------------
// RUN-SLIDESHOW-SP
// 		var currentImage = 1;
// 		var totalImages = 3;

// 		$(document).ready(function() {
// 			$('#previous').on('click', function() {
// 				$('#slide_' + currentImage).stop().fadeOut(100);
// 				decreaseImage();
// 				$('#slide_' + currentImage).stop().fadeIn(100);
// 				/* Act on the event */
// 			});

// 			$('#next').on('click', function() {
// 				// Change to the next image
// 				$('#slide_' + currentImage).stop().fadeOut(100);
// 				increaseImage();
// 				$('#slide_' + currentImage).stop().fadeIn(100);
// 			});

// 			function increaseImage() {
// 			/* Increase currentImage by 1.
// 			* Resets to 1 if larger than totalImages*/
// 				++currentImage;
// 				if(currentImage > totalImages) {
// 					currentImage = 1;
// 				}
// 			}
// 			function decreaseImage() {
// 			/* Decrease currentImage by 1.
// 			* Resets to totalImages if smaller than 1*/
// 				--currentImage;
// 				if(currentImage < 1) {
// 					currentImage = totalImages;
// 				}
// 			}
// 		});

// // AUTO-RUN
// 		window.setInterval(function() {
// 			$('#previous').click();
// 			}, 5000);
//---------------------------JAVASCRIPT - SLIDESHOW-SP-2--------------------------
// RUN-SLIDESHOW-SP
// var currentImage = 1;
// var totalImages = 2;

// $(document).ready(function() {

// 	$('#previous-7').on('click', function() {
// 		$('#slide-7_' + currentImage).stop().fadeOut(100);
// 		decreaseImage();
// 		$('#slide-7_' + currentImage).stop().fadeIn(100);
// 		/* Act on the event */
// 	});

// 	$('#next-7').on('click', function() {
// 		// Change to the next image
// 		$('#slide-7_' + currentImage).stop().fadeOut(100);
// 		increaseImage();
// 		$('#slide-7_' + currentImage).stop().fadeIn(100);
// 	});
// 	function increaseImage() {
// 	/* Increase currentImage by 1.
// 	* Resets to 1 if larger than totalImages
// 	*/
// 		++currentImage;
// 		if(currentImage > totalImages) {
// 			currentImage = 1;
// 		}
// 	}
// 	function decreaseImage() {
// 	/* Decrease currentImage by 1.
// 	* Resets to totalImages if smaller than 1
// 	*/
// 		--currentImage;
// 		if(currentImage < 1) {
// 			currentImage = totalImages;
// 		}
// 	}

// });

// HOVER PRDUCT
$(".owl-prev").click(function () {
	$(this).toggleClass("owl-prev-click");
});
// NOTI
function thongBAO() {
	alert("Đang hoàn thiện :v");
}

// AUTO-RUN
// window.setInterval(function() {
// 	$('#previous').click();
// 	}, 5000);
//-----

// PRODUCT INFO_ SHOPPING CART
// Đánh giá
$(function () {
	$(document).on({
		mouseover: function (event) {
			$(this).find('.far').addClass('star-over');
			$(this).prevAll().find('.far').addClass('star-over');
		},
		mouseleave: function (event) {
			$(this).find('.far').removeClass('star-over');
			$(this).prevAll().find('.far').removeClass('star-over');
		}
	}, '.rate');
	$(document).on('click', '.rate', function () {
		if (!$(this).find('.star').hasClass('rate-active')) {
			$(this).siblings().find('.star').addClass('far').removeClass('fas rate-active');
			$(this).find('.star').addClass('rate-active fas').removeClass('far star-over');
			$(this).prevAll().find('.star').addClass('fas').removeClass('far star-over');
		} else {
			console.log('has');
		}
	});
});

// TIỀM KIẾM BẰNG AJAX

//Getting value from "ajax.php".
// function fill(Value) {
//     //Assigning value to "search" div in "search.php" file.
//     $('#search').val(Value);
//     //Hiding "display" div in "search.php" file.
//     $('#display').html("");
//  }
$(document).ready(function () {
	$("#search").keyup(function () {
		var name = $('#search').val();
		console.log(name);
		if (name == "") {
			$("#display").fadeOut();
		}
		else {
			$.ajax({
				//AJAX type is "Post".
				type: "POST",
				url: "./search_ajax.php",
				data: {
					search: name
				},
				success: function (html) {
					$("#display").html(html).show();
				}
			});
		}
	});
});
