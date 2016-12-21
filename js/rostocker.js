jQuery(document).ready(function($){

	/*Initial Functions*/
	revealPosts();

	/* Variable declaration*/
	var last_scroll = 0;

	/*Carousel Functions*/
	$(document).on('click', '.rostocker-carousel-thumb',function(){
		var id = $('#' + $(this).attr('id'));
		$(id).on('slid.bs.carousel', function(){
		rostocker_get_bs_thumbs(id);
		});
	});

	$(document).on('mouseenter', '.rostocker-carousel-thumb',function(){
		var id = $('#' + $(this).attr('id'));
		rostocker_get_bs_thumbs(id);
	});
	
	function rostocker_get_bs_thumbs( id ){
		
			var nextThumb = $(id).find('.item.active').find('.next-image-preview').data('image');
			var prevThumb = $(id).find('.item.active').find('.prev-image-preview').data('image');
			$(id).find('.right.carousel-control').find('.thumbnail-container').css({'background-image' : 'url('+nextThumb+')'});
			$(id).find('.left.carousel-control').find('.thumbnail-container').css({'background-image' : 'url('+prevThumb+')'});
		
	}

	/* Scroll Function */
	$(window).scroll( function(){
		var scroll = $(window).scrollTop();
		if( Math.abs( scroll - last_scroll) > $(window).height()*0.1)
		{
			last_scroll = scroll;
			$('.page-limit').each(function( index ){
				if( isVisible( $(this) ) )
				{
					history.replaceState( null, null, $(this).attr("data-page"));
					return (false);
				}

			});
		}
	});


	//AJAX FUNCTION*/
	$(document).on('click','.rostocker-load-more:not(.loading)',function(){
		var that = $(this);
		var page = $(this).data('page');
		var newPage= page+1;
		var ajaxurl = that.data('url');
		var prev = that.data('prev');
		var archive = that.data('archive');


		if( typeof prev === 'undefined')
		{
			prev = 0;
		}
		if( typeof archive === 'undefined')
		{
			archive = 0;
		}
		that.addClass('loading').find('.text').slideUp(320);
		that.find('.rostocker-icon').addClass('spin');

		$.ajax({
			url : ajaxurl,
			type :'post',
			data :{
				page : page,
				prev: prev,
				archive: archive,
				action : 'rostocker_load_more'
			},
			error : function( response ){
				console.log(response);
			},
			success : function( response ){
				if( response == 0 )
				{
					$('.rostocker-posts-container').append( '<div class="text-center"><h3> No More Posts</h3></div>' );
					that.slideUp(320);
			
				}
				else
				{	
					setTimeout(function(){
					
						if( prev == 1)
						{
							$('.rostocker-posts-container').prepend( response );
							newPage = page -1;
						}
						else
						{
							$('.rostocker-posts-container').append( response );
						}
						if( newPage == 1 )
						{
							that.slideUp(320);

						}
						else
						{
							that.data('page',newPage);
				  			that.removeClass('loading').find('.text').slideDown(320);
							that.find('.rostocker-icon').removeClass('spin');
						}
				  		
						revealPosts();
					},2000);

				}
				
				
			}
		});

	});
	/* Helper Function */
	function revealPosts()
	{
 		 $('[data-toggle="tooltip"]').tooltip();
 		 $('[data-toggle="popover"]').popover();
		var posts = $('article:not(.reveal)');
		var i= 0;
		setInterval(function(){
			if( i >= posts.length) return false;
			var el = posts[i];
			$(el).addClass('reveal').find( '.rostocker-carousel-thumb').carousel();
			i=i+1;

		},200);
	}

	function isVisible( element )
	{
		var scroll_pos = $(window).scrollTop();
		var window_height = $(window).height();
		var el_top = $(element).offset().top;
		var el_height = $(element).height();
		var el_bottom = el_top + el_height;
		return (( el_bottom - el_height*0.25 > scroll_pos) && (el_top < (scroll_pos +0.5 + window_height)));
	}

	/*Sidebar Functions*/
	$(document).on('click', '.js-toggleSidebar',function(){
		$('.rostocker-sidebar').toggleClass('sidebar-closed');
		$('.body').toggleClass('.no-scroll');
		$('.sidebar-overlay').fadeToggle(320);
	});

	/*
	============================================
	CONTACT FORM SUBMISSION
	============================================
	*/
	$('#rostockerContactForm').on('submit',function(e){
		e.preventDefault();

		$('.has-error').removeClass('has-error');
		$('.js-show-feedback').removeClass('js-show-feedback');

		var form = $(this),
				name = form.find('#name').val(),
				email = form.find('#email').val(),
				message = form.find('#message').val(),
				ajaxurl = form.data('url');

		if( name === '' ){
			$('#name').parent('.form-group').addClass('has-error');
			return;
		}

		if( email === '' ){
			$('#email').parent('.form-group').addClass('has-error');
			return;
		}
		if( message === '' ){
			$('#message').parent('.form-group').addClass('has-error');
			return;
		}

		form.find('input, button, textarea').attr('disabled','disabled');
		$('.js-form-submission').addClass('js-show-feedback');

		$.ajax({
			
			url : ajaxurl,
			type : 'post',
			data : {
				
				name : name,
				email : email,
				message : message,
				action: 'rostocker_save_user_contact_form'
				
			},
			error : function( response ){
				$('.js-form-submission').removeClass('js-show-feedback');
				$('.js-form-error').addClass('js-show-feedback');
				form.find('input, button, textarea').removeAttr('disabled');
			},
			success : function( response ){
				if( response == 0 ){
					
					setTimeout(function(){
						$('.js-form-submission').removeClass('js-show-feedback');
						$('.js-form-error').addClass('js-show-feedback');
						form.find('input, button, textarea').removeAttr('disabled');
					},1500);

				} else {
					
					setTimeout(function(){
						$('.js-form-submission').removeClass('js-show-feedback');
						$('.js-form-success').addClass('js-show-feedback');
						form.find('input, button, textarea').removeAttr('disabled').val('');
					},1500);

				}
			}
				
		});
	});
	
});




