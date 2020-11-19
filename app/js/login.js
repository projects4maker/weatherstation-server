/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
$("#login").submit(function(e) {

    let display = function(msg, subject = "valid") {

        if (subject == "invalid") {

            $("#hash").addClass("is-invalid");
            $(".input-section .feedback").addClass("invalid-feedback");
        } else if (subject == "valid") {

            $("#hash").addClass("is-valid");
            $(".input-section .feedback").addClass("valid-feedback");
        }

        $(".input-section .feedback").html(msg);
        $(".input-section .feedback").show();
    };

    let login_alert = function(msg) {

        $(".inner-form .headline-section").after(
            "<div class=\"alert alert-danger\">\
                    <strong>Error:</strong> " + msg + "\
                  </div>"
        );
    }

    e.preventDefault();

    if ($(".inner-form .alert").length > 2) {

        $(".inner-form .alert").last().remove();
    }

    $("#submit").prop("disabled", true);

    let result = $.post(site.sub_path + "ajax/login", {

        hash: $("#hash").val()
    });

    result.done(function(d) {

        $(".inner-form .alert").last().remove();
        
        if (d.status == "ok" &&
            d.data.auth == "ok") {

            display("Successful login", "valid");
            window.location.href = site.sub_path + "dashboard";
        } else if (d.status == "ok" &&
            d.data.auth == "failed") {

            display("Unknown hash.", "invalid");
        } else {

            login_alert("Request rejected.");
        }
    });

    result.fail(function() {

        login_alert("Ajax request failed.");
    });

    $("#submit").prop("disabled", false);
});

$(".input-section input[name=login_hash]").focus(function() {
    $(".input-section .feedback").hide();
    $(".input-section .feedback").html();
    $(this).removeClass("is-invalid");
    $(this).removeClass("is-valid");
});