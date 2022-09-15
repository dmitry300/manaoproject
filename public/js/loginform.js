"use strict"

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm');
    form.addEventListener('submit', formSend);
    let loginInput = form.querySelector('input[name="login"]');
    let passwordInput = form.querySelector('input[name="password"]');

    async function formSend(e) {
        e.preventDefault();
        let response = await fetch($(this).attr('action'), {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            mode: 'same-origin',
            credentials: 'same-origin',
            body: JSON.stringify({
                login: loginInput.value,
                password: passwordInput.value,
            }),
        }).then(async response => {
            console.log(response);
            if (response.redirected) {
                document.location = response.url;
            } else {
                rmvAllMessages(form);
                let result = await response.json();
                loginInput.insertAdjacentHTML('beforebegin', `<p
                         class="form_err-msg">${result.message}</p>`);
            }
        })
    }
})

function rmvAllMessages(form) {
    form.querySelectorAll('[class*="msg"]').forEach(msg => {
        msg.remove();
    })
}