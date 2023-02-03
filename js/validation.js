// Wait for the DOM to be ready
$(function() {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        name: "required",
        email: {
          required: true,
          // Specify that email should be validated
          // by the built-in "email" rule
          email: true
        },
        phone: {
          required: true,
          minlength: 10,
          maxlength: 10
        }
      },
      // Specify validation error messages
      messages: {
        name: "Please enter your name",
        email: "Please enter a valid email address",
        phone: {
          required: "Please enter your phone number",
          minlength: "Phone no must be 10 digits",
          maxlength: "Phone no must be 10 digits"
        },
        
      },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });
  });