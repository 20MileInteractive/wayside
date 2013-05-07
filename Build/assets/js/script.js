(function() {
  $(function() {
    var handleErrors, toggleEmailSent, xhr;

    $(document).foundation();
    handleErrors = function(data) {
      var field, _i, _len, _ref, _results;

      switch (data.error_type) {
        case 'empty_field':
          _ref = data.fields;
          _results = [];
          for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            field = _ref[_i];
            _results.push($("[name=" + field + "]").addClass('error'));
          }
          return _results;
      }
    };
    toggleEmailSent = function() {
      $('#contact').hide();
      $('#thank-you').show();
      return true;
    };
    xhr = null;
    return $('#contact').on('submit', function() {
      var contact_form;

      contact_form = $(this);
      $('input, textarea').removeClass('error');
      if (xhr) {
        xhr.abort();
      }
      xhr = $.ajax(contact_form.action, {
        type: 'POST',
        dataType: 'json',
        data: contact_form.serialize(),
        error: function(jqXHR, textStatus, errorThrown) {
          return console.log('false');
        },
        success: function(data, textStatus, jqXHR) {
          console.log(data);
          switch (data.status) {
            case 'error':
              return handleErrors(data);
            case 'success':
              return toggleEmailSent();
          }
        }
      });
      return false;
    });
  });

}).call(this);
