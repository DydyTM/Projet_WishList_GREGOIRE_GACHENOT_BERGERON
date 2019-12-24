'use strict';

const nouvelleListe = document.querySelector('#newlist-form')
if (nouvelleListe != undefined) {
    nouvelleListe.addEventListener('submit', e => {
        e.preventDefault();

        const titre = e.target[0].value
        const description = e.target[1].value
        const date = e.target[2].value

        const data = new FormData();

        data.append('titre', escapeHTMLEncode(titre))
        data.append('description', escapeHTMLEncode(description))
        data.append('expiration', escapeHTMLEncode(date))
        fetch('/nouveau/liste', {body: data, method: 'POST'})
          .then(r => {
              if (!r.ok)
                throw new Error('Cannot post new list: ' + r.status)
        }).then(_ => {
            alert('Nouvelle liste créée')
            window.location.href = '/nouveau/liste'
        }).catch(e => alert(e) /* TODO: add a HTML dialog */)
    })
}

function partager(tk) {
    let port = ""
    if ((port = window.location.port) !== 80)
        port = `:${port}`
    const host = window.location.hostname
    alert(`Voici le lien de partage de votre liste : ${host}${port}/liste/${tk}`)
}