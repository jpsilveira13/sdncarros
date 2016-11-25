function formatNumber (num) {
    //return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
    num = num.toString();
    num=num.replace(/\D/g,"");//Remove tudo o que não é dígito
    num=num.replace(/(\d)(\d{8})$/,"$1.$2");//coloca o ponto dos milhões
    num=num.replace(/(\d)(\d{5})$/,"$1.$2");//coloca o ponto dos milhares

    num=num.replace(/(\d)(\d{2})$/,"$1,$2");//coloca a virgula antes dos 2 últimos dígitos
    return num;

}

function triggerClick(elem) {
    $(elem).click();
}


(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('.page-scroll a').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function(){
        $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

    // Floating label headings for the contact form
    $(function() {
        $("body").on("input propertychange", ".floating-label-form-group", function(e) {
            $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
        }).on("focus", ".floating-label-form-group", function() {
            $(this).addClass("floating-label-form-group-with-focus");
        }).on("blur", ".floating-label-form-group", function() {
            $(this).removeClass("floating-label-form-group-with-focus");
        });
    });

})(jQuery); // End of use strict
/* valida formulario */



$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $('.data').mask('00/00/0000');
    $('.hora').mask('00:00:00');
    var masks = ['(00) 00000-0000', '(00) 0000-00009'];
    $('#telefone').mask(masks[1], {onKeyPress:
        function(val, e, field, options) {
            field.mask(val.length > 14 ? masks[0] : masks[1], options) ;
        }
    });

    $('#btnSalvar').on('click', function () {
        if($('#nome').val() == ''){
            swal(
                'Por favor informe o nome!',
                'Campo está vazio',
                'error'
            ),
                $('#nome').focus();
            return false;

        }else if($('#email').val() == ''){
            swal(
                'Por favor informe o email!',
                'Campo está vazio',
                'error'
            ),
                $('#email').focus();
            return false;
        } else if($('#telefone').val() == '') {
            swal(
                'Por favor informe o telefone!',
                'Campo está vazio',
                'error'
            ),
                $('#telefone').focus();
            return false;
        }


        var active = $('#btnSalvar');

        active.addClass('next-step');
        $tab_active = $('.stepper').find('.active');

        $tab_active.next().removeClass('disabled');

        $tab_next = $tab_active.next().find('a[data-toggle="tab"]');

        triggerClick($tab_next)

    });


    $( "#cotacao" ).submit(function( event ) {

        //var formAmigo = $('#cotacao');
        event.preventDefault();
        var $form = $( this ),
            data = $form.serialize(),
            url = "salvar-cotacao";
        var posting = $.post( url, { formData: data } );

        posting.done(function( data ) {
            if(data.fail) {

                $.each(data.errors, function( index, value ) {
                    $('text-error').show('fast');
                });
                $('#successMessage').empty();
            }
            if(data.success) {


                var valormin = formatNumber(data.userData.valor_min);
                var valormax = formatNumber(data.userData.valor_max);
                document.getElementById('idCotacao').value = data.id;
                $('#idCotacao').prop('value',data.id);
                //$('#idCotacao').attr('value',data.id);

                $('#valorMinimo').html('R$ ' + valormin);
                $('#valorMaximo').html('R$ ' + valormax);

            } //success
        }); //done
    });

    $('#btnSalvar').click(function () {
        swal({
            title: "Espere!",
            text: "Um momento que estamos levantando a média do valor do seu veículo dos últimos 7 dias.",
            timer: 3000,
            showConfirmButton: false
        });
        setTimeout(function(){
            $('html, body').animate({scrollTop: 0}, 1000);
        }, 3000);

    });

    $( "#formContato" ).submit(function( event ) {

        //var formAmigo = $('#cotacao');
        event.preventDefault();
        var $form = $( this ),
            data = $form.serialize(),
            url = "contato-home";
        var posting = $.post( url, { formData: data } );

        posting.done(function( data ) {
            if(data.fail) {

                swal(
                    'Ops!',
                    'Houve um erro ao tentar enviar o contato ;/!',
                    'error'
                )
            }
            if(data.success) {

                $('#formContato')[0].reset();
                swal(
                    'Parabéns!',
                    'Seu contato foi efetuado com sucesso. Logo entraremos em contato!',
                    'success'
                )

            } //success
        }); //done
    })


    $( "#agendamento" ).submit(function( event ) {

        //var formAmigo = $('#cotacao');
        event.preventDefault();
        var $form = $( this ),
            data = $form.serialize(),
            url = "salvar-agendamento";
        var posting = $.post( url, { formData: data } );

        posting.done(function( data ) {
            if(data.fail) {

                $.each(data.errors, function( index, value ) {
                    $('text-error').show('fast');
                });

            }

            if(data.success) {

                swal(
                    'Parabéns!',
                    'Seu Agendamento foi efetuado com sucesso. Logo entraremos em contato!',
                    'success'
                )

            } //success
        }); //done

    });
    (function($) {
        'use strict';

        $(function() {



            $(document).ready(function() {

                var $progressWizard = $('.stepper'),
                    $tab_active,
                    $tab_prev,
                    $tab_next,
                    $btn_prev = $progressWizard.find('.prev-step'),
                    $btn_next = $progressWizard.find('.next-step'),
                    $tab_toggle = $progressWizard.find('[data-toggle="tab"]'),
                    $tooltips = $progressWizard.find('[data-toggle="tab"][title]');

                // To do:
                // Disable User select drop-down after first step.
                // Add support for payment type switching.

                //Initialize tooltips
                $tooltips.tooltip();

                //Wizard
                $tab_toggle.on('show.bs.tab', function(e) {
                    var $target = $(e.target);

                    if (!$target.parent().hasClass('active, disabled')) {
                        $target.parent().prev().addClass('completed');
                    }
                    if ($target.parent().hasClass('disabled')) {
                        return false;
                    }
                });

                // $tab_toggle.on('click', function(event) {
                //     event.preventDefault();
                //     event.stopPropagation();
                //     return false;
                // });

                $btn_next.on('click', function() {
                    $tab_active = $progressWizard.find('.active');

                    $tab_active.next().removeClass('disabled');

                    $tab_next = $tab_active.next().find('a[data-toggle="tab"]');
                    triggerClick($tab_next);

                });
                $btn_prev.click(function() {
                    $tab_active = $progressWizard.find('.active');
                    $tab_prev = $tab_active.prev().find('a[data-toggle="tab"]');
                    triggerClick($tab_prev);
                });
            });

        });

    }(jQuery, this));

});