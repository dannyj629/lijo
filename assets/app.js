/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
//import $ from 'jquery';
//import './bootstrap';


$(function () {
    $("#loadModal").click(function () {
        var path = $("#add_details_path").val();

        $.ajax({
            url: path,
            type: "POST",
            success: function (response) {
                $("#detailsModal .modal-body").html(response);
                $("#detailsModal").modal('show');
            }

        });
    });

    $('body').on('submit', 'form[name="form"]', function (e) {
     e.preventDefault();
        e.preventDefault();
        var path = $("#add_details_path").val();
        var formSerialize = $(this).serialize();

        $.post(path, formSerialize, function (response) {
            alert(response.status);
             $("#detailsModal").modal('hide');
             window.location.reload();
        }, 'JSON');
    });


});