const logout = () => {
    post('/logout', _ => {
        alert('Vous êtes déconnecté')
        window.location.href = "/";
    })
}