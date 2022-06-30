// JavaScript Document

jQuery(document).ready(function($){


    
   var HHeight = $("header.header").outerHeight();
 $('body').css('margin-top',HHeight);

	/*$(window).scroll(function () {
		if ($(this).scrollTop() > HTHeight ) {
			$('header.header').addClass('fixed');
            $('.hdttop').css('margin-bottom',HBHeight);
		} else {
			$('header.header').removeClass('fixed');
            $('.hdttop').css('margin-bottom','0');
		}
	});*/

  $(".srchtog").click(function(){
    $(".ovrsrchsec").addClass("active");
  });
  $(".srchcls").click(function(){
      $(".ovrsrchsec").removeClass("active");
  });


    
  $(".mnutog2").click(function(){
    $("header.header").addClass("menu2active");
});

$(".mnucls2").click(function(){
  $("header.header").removeClass("menu2active");
});


	$(".mnutog").click(function(){
        $("header.header").addClass("active");
    });
    $(".mnucls").click(function(){
        $("header.header").removeClass("active");
    });
    

	$('.homeslider').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000,
        adaptiveHeight: true
    });
    
    
    $('.glryslide').slick({
        dots: false,
        arrows: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
  ]
    });


      
    $('.Categoryslider').slick({
      dots: false,
      arrows: false,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      responsive: [
  {
    breakpoint: 1024,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 1
    }
  },
  {
    breakpoint: 600,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1
    }
  },
  {
    breakpoint: 480,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1
    }
  }
]
  });


    
 $('.ptoduct-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  autoplay: true,
  autoplaySpeed: 4200,
  asNavFor: '.ptoduct-slider-nav'
});
$('.ptoduct-slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.ptoduct-slider',
  dots: false,
  arrows: false,
  centerMode: true,
  autoplay: true,
  autoplaySpeed: 4200,
  focusOnSelect: true
});



    
    
    $('[data-fancybox="gallery"]').fancybox({
	// Options will go here
    });

    function wcqib_refresh_quantity_increments() {
      jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
          var c = jQuery(b);
          c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
      })
  }
  String.prototype.getDecimals || (String.prototype.getDecimals = function() {
      var a = this,
          b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
      return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
  }), jQuery(document).ready(function() {
      wcqib_refresh_quantity_increments()
  }), jQuery(document).on("updated_wc_div", function() {
      wcqib_refresh_quantity_increments()
  }), jQuery(document).on("click", ".plus, .minus", function() {
      var a = jQuery(this).closest(".quantity").find(".qty"),
          b = parseFloat(a.val()),
          c = parseFloat(a.attr("max")),
          d = parseFloat(a.attr("min")),
          e = a.attr("step");
      b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
  });



	
	
});




function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();



	