 $(document).ready(function() {
   
   $('.buton-trimite').click(function(){
     $('#trimite-calendar').trigger('click');
   });
	$("#buton-cont-rezident").click(function () {
		$('.overlay').css('display', 'flex');
		$('.overlay').hide().fadeIn();
		$('#formular-cont-rezident').hide().fadeIn();
	});

	$("#buton-cont-medic").click(function () {
		$('.overlay').css('display', 'flex');
		$('.overlay').hide().fadeIn();
		$('#formular-cont-medic').hide().fadeIn();
		$('#creeaza-cont-medic').hide().fadeOut();
	});
 $("#index-login-rezident").click(function () {
		$('.overlay').css('display', 'flex');
		$('.overlay').hide().fadeIn();
		$('#formular-cont-rezident').hide().fadeIn();
	});

	$("#index-login-medic").click(function () {
		$('.overlay').css('display', 'flex');
		$('.overlay').hide().fadeIn();
		$('#formular-cont-medic').hide().fadeIn();
		$('#creeaza-cont-medic').hide().fadeOut();
	});

	$("#cont-login").click(function () {
		$('.overlay').css('display', 'flex');
		$('.overlay').hide().fadeIn();
		$('#login-mobile').hide().fadeIn();
	});
	
	$(".close-login").click(function () {
		$('.overlay').css('display', 'none');
	    $('.overlay').show().fadeOut();
	    $('#formular-cont-medic').hide().fadeOut();
	    $('#formular-cont-rezident').hide().fadeOut();
	    $('#creeaza-cont-medic').hide().fadeOut();
		$('#creeaza-cont-rezident').hide().fadeOut();
		$('#reseteaza-parola').hide().fadeOut();
		$('#login-mobile').hide().fadeOut();
		$('#delete-account').hide().fadeOut();
	});
	$('#renunta-stergere').click(function(){
		$('.overlay').css('display', 'none');
		$('.overlay').show().fadeOut();
		$('#delete-account').hide().fadeOut();
	});

	$("#creeaza-medic").click(function () {
	    $('#formular-cont-medic').hide().fadeOut();
	    $('#creeaza-cont-medic').hide().fadeIn();
	});
	$("#login-medic").click(function () {
	    $('#formular-cont-medic').hide().fadeIn();
	    $('#creeaza-cont-medic').hide().fadeOut();
	});
	$("#login-rezident").click(function () {
	    $('#formular-cont-rezident').hide().fadeIn();
	    $('#creeaza-cont-rezident').hide().fadeOut();
	});
	$("#creeaza-rezident").click(function () {
	    $('#formular-cont-rezident').hide().fadeOut();
	    $('#creeaza-cont-rezident').hide().fadeIn();
	});
	$(".forgot").click(function () {
	    $('#formular-cont-rezident').hide().fadeOut();
	    $('#formular-cont-medic').hide().fadeOut();
	    $('#reseteaza-parola').hide().fadeIn();
	});
	$("#am-rezident").click(function () {
	    $('#creeaza-cont-rezident').hide().fadeOut();
	    $('#formular-cont-rezident').hide().fadeIn();
	});
	$("#am-medic").click(function () {
	    $('#creeaza-cont-medic').hide().fadeOut();
	    $('#formular-cont-medic').hide().fadeIn();
	});
	$("#register-mobile-medic").click(function () {
		$('#login-mobile').hide().fadeOut();
	    $('#creeaza-cont-medic').hide().fadeIn();
	});
	$("#register-mobile-rezident").click(function () {
		$('#login-mobile').hide().fadeOut();
	    $('#creeaza-cont-rezident').hide().fadeIn();
	});
	$("#am-cont-medic").click(function () {
		$('#login-mobile').hide().fadeOut();
	    $('#formular-cont-medic').hide().fadeIn();
	});
	$("#am-cont-rezident").click(function () {
		$('#login-mobile').hide().fadeOut();
	    $('#formular-cont-rezident').hide().fadeIn();
	});
	$("#sterge-cont").click(function () {
		$('.overlay').css('display', 'flex');
		$('.overlay').hide().fadeIn();
		$('#delete-account').hide().fadeIn();
	});
	$('#reinoieste-abonament-sus').click(function(){
		$('html, body').animate({
			scrollTop: $("#header").offset().top
		}, 1000);
	});

	AOS.init();
	$(window).scroll(function() {
		if($(window).scrollTop() > 0) {
			$(".scroll-up").css("display","block");
		} else {
			$(".scroll-up").css("display","none");
		}
	}); 
  
	$(".scroll-up").click(function() {
	  $("html, body").animate({ scrollTop: 0 }, "slow");
	  return false;
	});

	$(".menu").click(function() {
		if($('.sidenav').hasClass('afisat')) {
			$('.sidenav').removeClass('afisat');
			$(".sidenav").css( {
					left: -100+'%'
				}
			);
		}

		else {
			$('.sidenav').addClass('afisat');
			$(".sidenav").css( {
					left:'0%'
				}
			);
		}
	});
	$(".close").click(function() {
        if($('.sidenav').hasClass('afisat')) {
            $('.sidenav').removeClass('afisat');
            $(".sidenav").css( {
                    left:'-100%'
                }
    
            );
        }
    });
   
   
//    DATEPICKER
   
   $('#calendar').datepicker({
     
    language: 'ro',
    minDate: new Date(),
    onSelect: function onSelect(fd, date) {
        $('#date').val(fd);
    }     
})
   $('#calendar-buton').click(function(){
     if ($('#date').val().indexOf('-') >=1){
        $('.calendar-left-inside').addClass('calendar-left-inside-hidden');
      }else{
        $.notify('Selectati o perioada', "error");
      }

     
      
   if($('.calendar-left-inside').hasClass('calendar-left-inside-hidden')){
       $('.calendar-left-inside').css('left','-120%');
       $('.calendar-left-inside-ora').css('left','0%');
   }
     
   });

   $('.concediu-item').click(function(){
	$dataCalendar = $(this).find('.istoric-date').val();
	var startDate = new Date($(this).find('.istoric-date-start').val());
	var endDate = new Date($(this).find('.istoric-date-end').val());
	var dp = $('#calendar').datepicker({startDate: startDate}).data('datepicker');
	dp.selectDate(startDate);
	dp.selectDate(endDate);
	});

	$('.concediu-buton-finalizare').click(function(event){
		event.preventDefault();
		var checkBox = $(this).find('input');
		checkBox.prop("checked", !checkBox.prop("checked"));
        $.ajax({
          method: 'POST',
          url: $(this).attr('action'),
          data: {
			concediu_id:$(this).attr('data-id'),
			finalizat:checkBox.prop('checked')? 1:0,
		  },
          context: this,
          async: true,
          cache: false,
          dataType: 'json'
        });
	});
	$('.disponibilitate-buton-finalizare').click(function(event){
		event.preventDefault();
		var checkBox = $(this).find('input');
		checkBox.prop("checked", !checkBox.prop("checked"));
        $.ajax({
          method: 'POST',
          url: $(this).attr('action'),
          data: {
			concediu_id:$(this).attr('data-id'),
			finalizat:checkBox.prop('checked')? 1:0,
		  },
          context: this,
          async: true,
          cache: false,
          dataType: 'json'
        });
	});
})