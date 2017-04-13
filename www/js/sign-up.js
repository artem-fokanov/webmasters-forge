var f=document.forms.signup.elements;f.nickname.value='zvu';f.name.value='Artem';f.email.value='artem.fokanov@gmail.com';f.password.value='12345';f.password_confirm.value='54321';

$('form').on('submit', function() {
    var form = this;

    if (!validate(form))
        return false;
});

function validate(form) {
    var isValid = true;

    $(form).find('input[id]').each(function(i,el) {

        switch(el.id) {

            case 'nickname':
                if (!/^[^0-9]\w+$/.test(el.value))
                    isValid = false;

                if (el.value.length > 30)
                    isValid = false;
                break;

            case 'name':
                if (el.value.length > 100)
                    isValid = false;
                break;

            case 'email':
                if (el.value.length > 50)
                    isValid = false;
                break;

            case 'password':
                if (el.value.length < 3 || el.value.length > 20)
                    isValid = false;
                break;

            case 'password_confirm':
                if (el.value !== form.elements.password.value)
                    isValid = false;
                break;
        }
    });

    // Валидация прошла успешно
    return isValid;
}