const logout = () => {
    post('/logout', "", _ => {
        window.location.href = "/";
    })
}