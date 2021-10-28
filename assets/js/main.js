
(function ($) {
    "use strict";

    //Verifica se tem valor form contato
    $('.input').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
            
    //Validação form contato home
    var name = $('.validate-input input[name="name"]');
    var email = $('.validate-input input[name="email"]');
    var message = $('.validate-input textarea[name="message"]');

    $('.validate-form').on('submit',function(){
        var check = true;
        if($(name).val().trim() == ''){
            showValidate(name);
            check=false;
        }
        if($(email).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
            showValidate(email);
            check=false;
        }
        if($(message).val().trim() == ''){
            showValidate(message);
            check=false;
        }
        return check;
    });
    $('.validate-form .input2').each(function(){
        $(this).focus(function(){
           hideValidate(this);
       });
    });
    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }
    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    //Função fadeOut no preloader
    $(window).on('load', function () {
        $('#preloader .inner').fadeOut();
        $('#preloader').delay(350).fadeOut('slow'); 
        $('body').delay(350).css({'overflow': 'visible'});
      });
      
      //Adiciona classe nav-bg
      var nav = document.querySelector('nav');
      window.addEventListener('scroll', function () {
        if (window.pageYOffset > 0) {
          nav.classList.add('nav-bg');
        } else {
          nav.classList.remove('nav-bg');
        }
      });

})(jQuery);
