'use strict';

function randomSalt() {
    return [...Array(10)].map(_ => (Math.random()*36|0).toString(36)).join``
}

const signup = document.querySelector('#signup-form')
if (signup != undefined) {
    signup.addEventListener('submit', e => {
        e.preventDefault()

        let data = new FormData()
        const pseudo = escapeHTMLEncode(e.target[0].value)
        data.append('pseudo', pseudo)

        if (!pseudo)
            return alert('Votre pseudo ne peut pas être vide')

        let pass = e.target[1].value

        if (!pass || pass.length < 6)
            return alert('Votre mot de passe ne peut pas être moins long que 6 caractères')

        let salt = randomSalt();

        argon2.hash({pass, salt, type: argon2.ArgonType.Argon2i})
            .then(r => data.append('pass', r.encoded))
            .then(_ => fetch('/signup', {body: data, method: 'POST'}))
            .then(response => {
                if (!response.ok) {
                    alert("Unable to register")
                    // TODO: add a HTML dialog box
                } else {
                    alert("Successfully registered!")
                    // TODO: add a HTML dialog box
                    window.location.href = '/'
                }
            })
    })
}

const login = document.querySelector('#login-form')
if (login != undefined) {
    login.addEventListener('submit', e => {
        e.preventDefault();

        let data = new FormData()
        const pseudo = escapeHTMLEncode(e.target[0].value)
        data.append('pseudo', pseudo)

        if (!pseudo)
            return alert('Votre pseudo ne peut pas être vide')

        fetch('/login', {body: data, method: 'POST'})
            .then(response => response.ok ? response.json() : JSON.parse({}))
            .then(json => {
                if (!json)
                    throw new Error()
                data.append('pass', json.pass)
                return json.pass
            })
            .then(pass => argon2.verify({pass: e.target[1].value, encoded: pass, type: argon2.ArgonType.Argon2i}))
            .then(_ => data.append('checked', 1))
            .then(_ => fetch('/login', {body: data, method: 'POST'}))
            .then(response => {
                if (!response.ok)
                    throw new Error()
            })
            .then(_ => {
                alert("Successfully connected!")
                window.location.href = '/'
            })
            .catch(_ => alert("Username or password incorrect!") /* TODO: add a HTML dalog box */)
    })
}

function logout() {
    fetch('/logout', { method: 'POST' })
        .then(resp => {
            if (!resp.ok) {
                alert('Couldn\'t disconnect.')
                // TODO: add a HTML dialog box
            } else {
                document.write('<span id="disconnected">Disconnected!</span>')
                setTimeout(() => {
                    document.getElementById('disconnected').remove()
                    window.location.href = '/';
                }, 1500);
            }
        })
}