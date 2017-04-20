var form = $('form'),
    locale = getCookie();
// флаги для передачи в помощник
var FIELD_OK = true,
    FIELD_ERROR = false;

form.on('submit', function() {

    clearForm(form);

    if (!validate(form))
        return false;

}).find('input[id]').on('change', function() {
    var isValidElem = validateField(this);

    clearElement(this.id);

    if (isValidElem) {
        visualizeHelp(this.id, FIELD_OK);
    } else {
        visualizeHelp(this.id, FIELD_ERROR, msg);
    }
});

function validate(form) {
    var isValidForm = true;

    form.find('input[id]').each(function(i,el) {
        var msg,
            isValidElem = validateField(el);

        if (el.id == 'password_confirm' && !isValidElem && msg == messages[locale].password_mismatch) {

            // в т.ч. раскрашиваем пароль
            visualizeHelp(form[0].elements.password.id, FIELD_ERROR);
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

function validateField(el) {
    var valid = true;

    switch(el.id) {

        case 'nickname':
            if (!/^[^0-9]\w+$/.test(el.value)) {
                valid = false;
                msg = messages[locale].alphanum_characters;
            }

            if (el.value.length > 30) {
                valid = false;
                msg = messages[locale].nickname_length;
            }
            break;

        case 'name':
            if (el.value.length > 100) {
                valid = false;
                msg = messages[locale].name_length;
            }
            break;

        case 'email':
            if (el.value.length > 50) {
                valid = false;
                msg = messages[locale].email_length;
            }
            if (!/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(el.value)) {
                valid = false;
                msg = messages[locale].email_characters;
            }
            break;

        case 'password':
            if (el.value.length < 3 || el.value.length > 20) {
                valid = false;
                msg = messages[locale].password_length;
            }

            if (!/^\w+$/.test(el.value)) {
                valid = false;
                msg = messages[locale].alphanum_characters;
            }
            break;

        case 'password_confirm':
            if (el.value !== form[0].elements.password.value) {
                valid = false;
                msg = messages[locale].password_mismatch;
            }
            break;

        default: break;
    }

    return valid;
}

// помощник
function visualizeHelp(elemId, status, message) {
    var colorClass = (status) ? 'success' : 'error';

    $('#'+elemId).closest('div.form-group').addClass('has-'+colorClass);

    if (!status && typeof message == 'string') {
        $('#'+elemId+'-help-block').text(message);
    }
}

function clearForm() {
    // скрытие помощника
    form.find('.has-success, .has-error').removeClass('has-success has-error');
    form.find('span.help-block').text('');
}

function clearElement(elemId) {
    var block = $('#'+elemId).closest('div.form-group');
    block.removeClass('has-success has-error')
        .find('span.help-block').text('');
}

// словарь сообщений
var messages = {
    en: {
        alphanum_characters: "This field should contain only latin alpha-numeric characters",
        nickname_length: "This field couldn't contain more than 30 characters",
        name_length: "This field couldn't contain more than 100 characters",
        email_length: "This field couldn't contain more than 50 characters",
        email_characters: "Invalid email",
        password_length: "Password length should be at least 3 and at most 20 characters",
        password_mismatch: "Password mismatch"
    },
    ru: {
        alphanum_characters: "Это поле должно содержать только латинские буквенно-цифровые символы",
        nickname_length: "Это поле не может содержать более 30 символов",
        name_length: "Это поле не может содержать более 100 символов",
        email_length: "Это поле не может содержать более 50 символов",
        email_characters: "Некорректная электронная почта",
        password_length: "Длина пароля должна содержать не менее 3-х и не более 20-и символов",
        password_mismatch: "Несоответствует паролю"
    }
};

// возвращает cookie с локалью
function getCookie() {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + 'locale'.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : 'en';
}