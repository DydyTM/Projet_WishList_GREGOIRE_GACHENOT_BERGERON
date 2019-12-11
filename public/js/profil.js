function randomSalt() {
    return [...Array(10)].map( _ => (Math.random()*36|0).toString(36)).join``
}

const signup = document.querySelector('#signup-form')
if (signup != undefined) {
    signup.addEventListener('submit', e => {
        e.preventDefault()

        let data = new FormData()
        data.append('pseudo', e.target[0].value)

        let pass = e.target[1].value
        let salt = randomSalt();

        argon2.hash({pass, salt, type: argon2.ArgonType.Argon2i}).then(r => {
            data.append('pass', r.encoded)
            fetch('/signup', {body: data, method: 'POST'})
                .then(response => {
                    if (!response.ok) {
                        response.text()
                            .then(err => {
                                document.open()
                                document.write(err)
                                document.close()
                            })
                    } else {
                        alert("Successfully registered!")
                    }
                })
        })
    })
}