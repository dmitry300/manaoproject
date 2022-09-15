"use strict"

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');
    let h1input=form.querySelector('h1');
    form.addEventListener('submit', formSend);
    let nameInput = form.querySelector('input[name="name"]');
    let loginInput = form.querySelector('input[name="login"]');
    let emailInput = form.querySelector('input[name="email"]');
    let passwordInput = form.querySelector('input[name="password"]');
    let confirmPasswordInput = form.querySelector('input[name="confirm_password"]');

    async function formSend(e) {
        e.preventDefault();

        let error = formValidate(form);
        if (error === 0) {
            let response = await fetch($(this).attr('action'), {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                mode: 'same-origin',
                credentials: 'same-origin',
                body: JSON.stringify({
                    name: nameInput.value,
                    login: loginInput.value,
                    email: emailInput.value,
                    password: passwordInput.value,
                    confirm_password: confirmPasswordInput.value
                }),
            }).then(async response => {
                console.log(response);
                if (response.redirected) {
                    document.location = response.url;
                } else {
                    let result = await response.json();
                    rmvAllMessages(form);
                    h1input.insertAdjacentHTML('afterend', `<div class="form_err-msg warn">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true">${result.message}</i>
                    </div>`);
                }
            })
        }
    }
    function formValidate(form) {
        let error = 0;
        let formReq = document.querySelectorAll('._req');
        rmvAllMessages(form);
        for (let index = 0; index < formReq.length; index++) {
            const input = formReq[index];
            formRemoveError(input);
            if (input.classList.contains('_name')) {
                if (input.value.length !== 2) {
                    formAddError(input);
                    nameInput.insertAdjacentHTML('beforebegin', `<p
                         class="form_err-msg">The field «Name» must be 2 characters!</p>`);
                    error++;
                } else if (!/^[а-яёa-z]+$/i.test(input.value)) {
                    formAddError(input);
                    nameInput.insertAdjacentHTML('beforebegin', `<p
                     class="form_err-msg">The field «Name» must contain only letters!</p>`);
                    error++;
                }
            }
            if (input.classList.contains('_email')) {
                if (input.value === '') {
                    formAddError(input);
                    emailInput.insertAdjacentHTML('beforebegin', `<p
                         class="form_err-msg">The field «Email» cannot be empty!</p>`);
                    error++;
                } else if (!/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i.test(input.value)) {
                    formAddError(input);
                    emailInput.insertAdjacentHTML('beforebegin', `<p
                         class="form_err-msg">The field «Email» is not valid!</p>`);
                    error++;
                }
            }
            if (input.classList.contains('_login')) {
                if (input.value.length < 6) {
                    formAddError(input);
                    loginInput.insertAdjacentHTML('beforebegin', `<p
                         class="form_err-msg">The field «Login» must consist >= 6 characters!</p>`);
                    error++;
                }
            }
            if (input.classList.contains('_password')) {
                if (input.value.toString().length < 6) {
                    formAddError(input);
                    passwordInput.insertAdjacentHTML('beforebegin', `<p
                         class="form_err-msg">The field «Password» must consist >= 6 characters!</p>`);
                    error++;
                } else if (!/(?=.*[0-9])(?=.*[a-zа-яё])/i.test(input.value)) {
                    formAddError(input);
                    passwordInput.insertAdjacentHTML('beforebegin', `<p
                         class="form_err-msg">The field «Password» must consist at least 1 symbol and 1 number!</p>`);
                    error++;
                }
            }
            if (input.classList.contains('_confirmed_password')) {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    formAddError(input);
                    confirmPasswordInput.insertAdjacentHTML('beforebegin', `<p
                         class="form_err-msg">Password mismatch!</p>`);
                    error++;
                }
            }
        }
        return error;
    }
});

function rmvAllMessages(form) {
    form.querySelectorAll('[class*="msg"]').forEach(msg => {
        msg.remove();
    })
}

function formAddError(input) {
    input.parentElement.classList.add('_error');
    input.classList.add('_error');
}

function formRemoveError(input) {
    input.parentElement.classList.remove('_error');
    input.classList.remove('_error');
}