var badge               = $('#main-menu li span.badge');
var title               = $('#main-menu li span.title');
var state               = $('body div.page-container');
var navbar              = $('.page-container.horizontal-menu header.navbar');
var container           = $('body div.page-container');
var maincontent         = $('.page-body .page-container .main-content');
var header              = $('.page-container > header.nav-bar');
var titlelink           = $('.page-container .sidebar-menu #main-menu li a span.title');
var footer              = $('#footer');

var search_resize_callback = function(){
    if(get_current_breakpoint() == 'largescreen' || get_current_breakpoint() == 'tabletscreen') {
        $('.advanced_search').css('width', $('.search_form').width() - 48);
    }
};

$(window).scroll(function(){

    if(is('devicescreen') || is('xdevicescreen')) {
        if($('body').scrollTop() >= 130) {
            $('body').addClass('fixed-menu-mobile');
        }else{
            $('body').removeClass('fixed-menu-mobile');
        }
    }
});

$(document).ajaxStart(function() {
    $('.loader').trigger('start');
});
$(document).ajaxStop(function(){
    $('.loader').trigger('stop');
});

$(document).ready(function(){
    $.fn.datepicker.defaults.language = 'fr';

    // OFFSET NAVIGATION
    $('.device-navbar button').click(function(){
        if(state.hasClass('offset')){
            state.removeClass('offset');
            header.removeClass('offset');
            navbar.removeClass('offset');
            maincontent.removeClass('offset');
            footer.removeClass('offset');

        }else{
            state.addClass('offset');
            header.addClass('offset');
            navbar.addClass('offset');
            maincontent.addClass('offset');
            footer.addClass('offset');
        }
    });

    $('button.sidebar-collapse-icon').click(function(){
        toggle_sidebar_menu();
        search_resize_callback();
    });

    search_resize_callback();

    $('.result-area .select a').click(function (e) {
        e.preventDefault();

        $('.result-area .select a').removeClass('active');
        $(this).addClass('active');

        $('.result-area .content').removeClass('list grid-big grid-small').addClass($(this).data('target'));
    });

    var goTopVisible = false;
    $(window).scroll(function (event) {
        if ($(window).scrollTop() > 300) {
            if (!goTopVisible) {
                goTopVisible = true;
                $('.go-to-top').stop().fadeIn();
            }
        } else {
            if (goTopVisible) {
                goTopVisible = false;
                $('.go-to-top').stop().fadeOut();
            }
        }
    });

    $('.go-to-top').click(function (e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 });
    });
    
    $('.housing-area .toggle-details').click(function (e) {
        e.preventDefault();
        var $this = $(this);
        var $parent = $this.parents('li');
        
        $parent.find('.tab').not(this).removeClass('active');
        $this.toggleClass('active');
        
        $parent.find('.tab-content').not($this.data('target')).removeClass('active');
        $parent.find($this.data('target')).toggleClass('active');
    });

     $('.advanced_search').click(function(e){
         e.stopPropagation();
     });

     $('#advanced-search-form button[type="reset"], #modal-advanced-search-form button[type="reset"]').click(function(e){
         var $me = $(this),
            $form = $me.closest('form');

         $form.find('input[type=text]').removeAttr('value');
         $form.find('input[type=radio]:first').trigger('click');
     });

    $('#search-form-all, #modal-search-form-all').submit(function(){
        var $me = $(this),
            valid = true;
        if($me.find('input[type=text]:first').val().length < 3) {
            alert('La recherche doit contenir au moins 3 caractères');
            valid = false;
        }

        return valid;
    });

    $('#advanced-search-form, #modal-advanced-search-form').submit(function(){
        var $me = $(this),
            valid = true;

        $me.find('input[type=text]:not([name=ref_numero])').each(function() {
            var $input = $(this),
                length = $input.val().length
            if(length > 0 && length < 3) {
                alert('Les champs de la recherche doivent contenir au moins 3 caractères');
                valid = false;
            }
        });

        return valid;
    });

    $('.loader').on('start', function(){
        $(this).addClass('animate');
    }).on('stop', function(){
        $(this).removeClass('animate');
    });

    $("a").on( "click", function(e) {
        if(($(this).attr("target") !== "_blank") && ($(this).attr("href").lastIndexOf("#") !== 0)){
            $('.loader').trigger('start');
        }
    });

    $('.filters select').on('change', function() {
        if ($(this).val() == '') {
            $(this).removeClass('selected');
        } else {
            $(this).addClass('selected');
        }
    });

    $('.filters select').each(function() {
        if ($(this).val() == '') {
            $(this).removeClass('selected');
        } else {
            $(this).addClass('selected');
        }
    });


});

$(window).resize(function(){
    search_resize_callback();
});
