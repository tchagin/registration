$(function(){

	$('.header__burger').click(function(event){
		$('.header__burger,.header__menu').toggleClass('active');
		$('body').toggleClass('lock');
	});

	$('.current-lang').click(function(){
		$('.other-lang').slideToggle();
	})

});
