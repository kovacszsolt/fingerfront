/**
 * Form
 */
class fingerDomainMod extends fingerDomain {
    static convertURL(url) {
        var _return = url;
        if (_return.substr(-1) == '/') {
            _return = _return.substr(0, _return.length - 1);
        }
        return _return;
    }
}

class form {

    /**
     * constructor
     * set methods from url
     */
    constructor() {
        this._functions = new Map([
            ['elfelejtett-jelszo', 'lostpassword'],
            ['uj_jelszo', 'subscribeconfirmstep2'],
            ['bejelentkezes', 'login'],
            ['adataid', 'profile'],
            ['regisztracio', 'registration'],
            ['hirbekuldes', 'newsadd'],
            ['hirlevel', 'newslettersubscribe'],
            ['hirlevellemondas', 'newsletterunsubscribe']
        ]);
    }

    /**
     * setting Form
     * @param value
     */
    setForm(value) {
        this._form = value;
        var _formName = $(this._form).data('name');
        this._formOk = $('#' + _formName + '_ok');
    }

    getMethod() {
        var _return = 'default';
        var _path = fingerDomainMod.convertURL(fingerDomainMod.getParam());
        if (_path.substr(0, 40) == 'itcrowd/secure/user/lostpasswordconfirm/') {
            _return = 'itcrowd_secure_user_lostpasswordconfirm';
        } else {
            _return = this._functions.get(_path);
        }
        return _return;
    }

    _showOK() {
        this._form.remove();
        this._formOk.removeClass('hidden');
    }


    newsletterunsubscribe(msg) {
        switch (msg.result) {
            case 'error' :
                switch (msg.message) {
                    case 'no_email':
                        $(document).fingerValidator.notify('Ezt az e-mail-t nem találtam a listában!');
                        $('#email').val('');
                        break;
                    default:
                        $(document).fingerValidator.notify(msg.message);
                }
                break;
            case 'ok':
                $(document).fingerValidator.notify('Az e-mail címed töröltük a listából.');
                $('#email').val('');
                break;
        }
        grecaptcha.reset();
    }

    newslettersubscribe(msg) {
        switch (msg.result) {
            case 'error' :
                switch (msg.message) {
                    case 'duplicate_email':
                        $(document).fingerValidator.notify('Ezzel az e-mail címmel már megtörtént a regisztráció!');
                        $('#email').val('');
                        break;
                    default:
                        $(document).fingerValidator.notify(msg.message);
                }
                break;
            case 'ok':
                $(document).fingerValidator.notify('Az e-mail címed rögítettük.');
                $('#email').val('');
                break;
        }
        grecaptcha.reset();
    }

    profile(msg) {
        switch (msg.result) {
            case 'error' :
                switch (msg.message) {
                    default:
                        $(document).fingerValidator.notify(msg.message);
                }
                grecaptcha.reset();
                break;
            case 'ok':
                $(document).fingerValidator.notify('Adataid frissítése megtörtént.');
                break;
        }
    }

    itcrowd_secure_user_lostpasswordconfirm(msg) {
        switch (msg.result) {
            case 'error' :
                $(document).fingerValidator.notify('Helytelen adatok!');
                grecaptcha.reset();
                break;
            case 'ok':
                window.location.href = '/';
                break;
        }
    }

    subscribeconfirmstep2(msg) {
        switch (msg.result) {
            case 'error' :
                switch (msg.message) {
                    default:
                        $(document).fingerValidator.notify(msg.message);
                }
                grecaptcha.reset();
                break;
            case 'ok':
                this._showOK();
                break;
        }
    }

    newsadd(msg) {
        switch (msg.result) {
            case 'error' :
                switch (msg.message) {
                    case 'nodatafound':
                        $(document).fingerValidator.notify('Az URL-en nem találtam információt.');
                        break;
                    case 'duplicateurl':
                        $(document).fingerValidator.notify('Ez az URL már szerepel a rendszerben.');
                        break;
                    default:
                        $(document).fingerValidator.notify(msg.message);
                }
                grecaptcha.reset();
                break;
            case 'ok':
                $('#url').val('');
                $(document).fingerValidator.notify('A linket rögzítettük a rendszerben.');
                break;
        }
    }

    lostpassword(msg) {
        switch (msg.result) {
            case 'error' :
                switch (msg.message) {
                    case 'nouser':
                        $(document).fingerValidator.notify('Ehhez az e-mail címhe nem találtam fiókot!');
                        break;
                    default:
                        $(document).fingerValidator.notify(msg.message);
                }
                grecaptcha.reset();
                break;
            case 'ok':
                $('#email').val('');
                $(document).fingerValidator.notify('A e-mail címedre elküldtük a jelszó megváltoztatásához szükséges linket.', 10000);
                break;
        }
    }

    registration(msg) {
        switch (msg.result) {
            case 'error' :
                switch (msg.message) {
                    case 'duplicate_email':
                        $(document).fingerValidator.notify('Ezzel az e-mail címmel már megtörtént a regisztráció!');
                        $('#email').val('');
                        break;
                    default:
                        $(document).fingerValidator.notify(msg.message);
                }
                grecaptcha.reset();
                break;
            case 'ok':
                this._showOK();
                break;
        }
    }

    login(msg) {
        switch (msg.result) {
            case 'error' :
                switch (msg.message) {
                    case 'nouser':
                        $(document).fingerValidator.notify('Helytelen felhasználónév vagy jelszó!');
                        $('#email').val('');
                        $('#password').val('');
                        break;
                    default:
                        $(document).fingerValidator.notify(msg.message);
                }
                grecaptcha.reset();
                break;
            case 'ok':
                window.location.href = '/hirbekuldes/';
                break;
        }
    }
}

var myForm = new form();

$(document).ready(function () {
    if ($.cookie('policy') === undefined) {
        $('#cookiepolicy').removeClass('hidden');
    } else {
        $('#cookiepolicy').hide();
    }
    $("#cookiepolicy_ok").click(function (e) {
        e.preventDefault();
        $.cookie('policy', '1');
        $('#cookiepolicy').addClass('hidden');
    });
    var _mainSubmitText = '';
    var _mainSubmitButton;
    $('.user_form').fingerValidator().submit(function () {
        if (_mainSubmitText == '') {
            $.each($(this).find(':submit'), function (index, value) {
                _mainSubmitButton = $(this);
            });
            _mainSubmitText = _mainSubmitButton.html();
        }
        if ($(this).data('finger_valid') == '1') {
            _mainSubmitButton.html('<img id="form_submit_wait" style="height:25px" src="/site/itcrowd/images/svg-loaders/ring.svg"/> ' + _mainSubmitText);
            _mainSubmitButton.prop('disabled', true);
            myForm.setForm(this);
            $.ajax({
                method: 'POST',
                url: window.location.href,
                dataType: "json",
                cache: false,
                data: $(this).serialize()
            })
                .done(function (msg) {
                    _mainSubmitButton.innerHTML = _mainSubmitText;
                    _mainSubmitButton.removeAttr('disabled');
                    myForm[myForm.getMethod()](msg);
                    $('#form_submit_wait').remove();
                    _mainSubmitButton.html(_mainSubmitText);
                });
        }
    });
});

