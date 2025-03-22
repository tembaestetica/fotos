$(function () {
    $("#contactForm input, #contactForm textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function ($form, event, errors) {
            // Manejar errores en el envío
        },
        submitSuccess: function ($form, event) {
            event.preventDefault();
            var name = $("input#name").val();
            var email = $("input#email").val();
            var subject = $("input#subject").val();
            var message = $("textarea#message").val();

            $this = $("#sendMessageButton");
            $this.prop("disabled", true);

            // Enviar el formulario a contact.php
            $.ajax({
                url: "contact.php",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    subject: subject,
                    message: message
                },
                cache: false,
                success: function () {
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×")
                        .append("</button>");
                    $('#success > .alert-success')
                        .append("<strong>Tu mensaje ha sido enviado.</strong>");
                    $('#success > .alert-success')
                        .append('</div>');
                    $('#contactForm').trigger("reset");
                },
                error: function () {
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×")
                        .append("</button>");
                    $('#success > .alert-danger').append($("<strong>").text("Perdón " + name + ", parece que nuestro servidor de correo no está respondiendo"));
                    $('#success > .alert-danger').append('</div>');
                    $('#contactForm').trigger("reset");
                },
                complete: function () {
                    setTimeout(function () {
                        $this.prop("disabled", false);
                    }, 1000);
                }
            });
        },
        filter: function () {
            return $(this).is(":visible");
        },
    });

    // Activar las pestañas del formulario si hay
    $("a[data-toggle=\"tab\"]").click(function (e) {
        e.preventDefault();
        $(this).tab("show");
    });
});

// Limpiar el mensaje de éxito al enfocar el campo de nombre
$('#name').focus(function () {
    $('#success').html('');
});
