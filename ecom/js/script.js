$(document).ready(function() {


    // Enable/disable Update Password button based on password validation
    $('#np').on('keyup', function() {
        validateNewPassword();
        toggleUpdateButton(); // Enable/disable button based on password validation
    });

    $('#rp').on('keyup', function() {
        validateReenterPassword();
        toggleUpdateButton(); // Enable/disable button based on password validation
    });

    $('#op').on('keyup', function() {
        toggleUpdateButton(); // Enable/disable button based on password validation
    });

    function validateNewPassword() {
        var newPassword = $('#np').val();
        var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{6,15}$/;
        
        if (regex.test(newPassword)) {
            $('#np-message').html('');
            $('#np').removeClass('invalid').addClass('valid');
        } else {
            $('#np-message').html('Password must be between 6 and 15 characters, and include at least one uppercase letter, one lowercase letter, one digit, and one symbol.');
            $('#np').removeClass('valid').addClass('invalid');
        }
    }

    function validateReenterPassword() {
        var newPassword = $('#np').val();
        var reenterPassword = $('#rp').val();

        if (newPassword === reenterPassword && reenterPassword !== '') {
            $('#rp-message').html('');
            $('#rp').removeClass('invalid').addClass('valid');
        } else {
            $('#rp-message').html('Passwords do not match.');
            $('#rp').removeClass('valid').addClass('invalid');
        }
    }

    function toggleUpdateButton() {
        var npValid = $('#np').hasClass('valid');
        var rpValid = $('#rp').hasClass('valid');
        var opValid = $('#op').val().length > 0; // Ensure old password is not empty

        if (npValid && rpValid && opValid) {
            $('#update_password_button').prop('disabled', false);
        } else {
            $('#update_password_button').prop('disabled', true);
        }
    }

    // Form submission handling
    $('#registrationForm').submit(function(event) {
        var email = $('#email').val();
        var password = $('#password').val();

        // Validate email and password before submission
        if (!isValidEmail(email)) {
            $('#email').addClass('is-invalid');
            return false; // Returning false prevents the form from submitting
        }

        if (password.length < 6) {
            $('#password').addClass('is-invalid');
            return false; // Returning false prevents the form from submitting
        }

        // Additional validation for new password and re-entered password
        var npValid = $('#np').hasClass('valid');
        var rpValid = $('#rp').hasClass('valid');
        if (!npValid || !rpValid) {
            return false; // Prevent form submission if passwords are not valid
        }

        // If validations pass, the form will submit normally
        // Otherwise, it will be prevented based on the above checks
    });

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);


    }


   $(document).ready(function(){
    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');

        if(value == "all") {
            $('.filter').show('1000').addClass('show');
        } else {
            $(".filter").not('.'+value).hide('3000').removeClass('show');
            $('.filter').filter('.'+value).show('3000').addClass('show');
        }
    });

    $(".filter-button").click(function() {
        $(".filter-button").removeClass("active");
        $(this).addClass("active");
    });

    // Show all products by default
    $('.filter').show('1000').addClass('show');
});


  $('#increase').click(function(){
        let quantity = parseInt($('#quantity').val());
        if(quantity < 10) {
            $('#quantity').val(quantity + 1);
        }
    });

    $('#decrease').click(function(){
        let quantity = parseInt($('#quantity').val());
        if(quantity > 1) {
            $('#quantity').val(quantity - 1);
        }
    });

});



  

