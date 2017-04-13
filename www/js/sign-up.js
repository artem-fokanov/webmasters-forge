// var f=document.forms.signup.elements;f.nickname.value='zvu';f.name.value='Artem';f.email.value='artem.fokanov@gmail.com';f.password.value='12345';f.password_confirm.value='54321';

$('form').on('submit', function() {
    var form = this;

    $(form).find('.has-success, .has-error').removeClass('has-success has-error');
    $(form).find('span.help-block').text('');

    if (!validate(form))
        return false;

    return false;
});

function validate(form) {
    var FIELD_OK = true,
        FIELD_ERROR = false,
        isValidForm = true;

    $(form).find('input[id]').each(function(i,el) {
        var isValidElem = true,
            msg;

        switch(el.id) {

            case 'nickname':
                if (!/^[^0-9]\w+$/.test(el.value)) {
                    isValidElem = false;
                    msg = messages.alphanum_characters;
                }

                if (el.value.length > 30) {
                    isValidElem = false;
                    msg = messages.nickname_length;
                }
                break;

            case 'name':
                if (el.value.length > 100) {
                    isValidElem = false;
                    msg = messages.name_length;
                }
                break;

            case 'email':
                if (el.value.length > 50) {
                    isValidElem = false;
                    msg = messages.email_length;
                }
                break;

            case 'password':
                if (el.value.length < 3 || el.value.length > 20) {
                    isValidElem = false;
                    msg = messages.password_length;
                }

                if (!/^\w+$/.test(el.value)) {
                    isValidElem = false;
                    msg = messages.alphanum_characters;
                }
                break;

            case 'password_confirm':
                if (el.value !== form.elements.password.value) {
                    isValidElem = false;
                    msg = messages.password_mismatch;

                    // в т.ч. раскрашиваем пароль
                    visualizeHelp(form.elements.password.id, FIELD_ERROR);
                }
                break;
        }

        if (isValidElem) {
            visualizeHelp(el.id, FIELD_OK);
        } else {
            visualizeHelp(el.id, FIELD_ERROR, msg);
            isValidForm = false;
        }
    });

    // Валидация прошла успешно
    return isValidForm;
}

function visualizeHelp(elemId, status, message) {
    var colorClass = (status) ? 'success' : 'error';

    $('#'+elemId).closest('div.form-group').addClass('has-'+colorClass);

    if (!status && typeof message == 'string') {
        $('#'+elemId+'-help-block').text(message);
    }
}

var messages = {
    alphanum_characters: "This field should contain alpha-numeric characters",
    nickname_length: "This field couldn't contain more than 30 characters",
    name_length: "This field couldn't contain more than 100 characters",
    email_length: "This field couldn't contain more than 50 characters",
    password_mismatch: "Password mismatch",
    password_length: "Password length should be at least 3 and at most 20 characters"
};