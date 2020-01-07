'use strict';

const nouvelleListe = document.querySelector('#newlist-form')
if (nouvelleListe != undefined) {
    nouvelleListe.addEventListener('submit', e => {
        e.preventDefault()

        const titre = e.target[0].value
        const description = e.target[1].value
        const date = e.target[2].value

        console.log(e.target[3].checked)

        const data = new FormData();

        data.append('titre', escapeHTMLEncode(titre))
        data.append('description', escapeHTMLEncode(description))
        data.append('expiration', escapeHTMLEncode(date))
        data.append('publique', e.target[3].checked)
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

function partager(tk, modifs) {
    let port = ""
    if ((port = window.location.port) !== 80)
        port = `:${port}`
    const host = window.location.hostname
    alert(`Voici le lien de partage de votre liste : ${host}${port}/liste/${tk}${modifs ? '/infos' : ''}`)
}

function modifier(tk) {
    let port = ""
    if ((port = window.location.port) !== 80)
        port = `:${port}`
    const host = window.location.hostname
    window.location.href = `http://${host}${port}/liste/${tk}/infos`
}

const nouveauItem = document.querySelector('#newitem-form')
if (nouveauItem != undefined) {
    nouveauItem.addEventListener('submit', e => {
        e.preventDefault()

        const titre = e.target[0].value
        const description = e.target[1].value
        const prix = e.target[2].value

        const tk = e.target.attributes[2].value

        const data = new FormData()

        data.append('titre', escapeHTMLEncode(titre))
        data.append('description', escapeHTMLEncode(description))
        data.append('prixItem', prix)

        const url = `/liste/${tk}/ajouterItem`

        fetch(url, {body: data, method: 'POST'})
            .then(r => {
                if (!r.ok)
                    throw new Error()
            }).then(_ => {
                alert('Nouvel item créé')
                window.location.href = url
            }).catch(_ => alert(`Could not post to ${url}`))
    })
}

function ajouterItem(tk) {
    window.location.href = `/liste/${tk}/ajouterItem`
}

const modifListe = document.querySelector('#modlist-form')
if (modifListe != undefined) {
    modifListe.addEventListener('submit', e => {
        e.preventDefault()

        const titre = e.target[0].value
        const description = e.target[1].value
        const date = e.target[2].value

        const data = new FormData();

        data.append('titre', escapeHTMLEncode(titre))
        data.append('description', escapeHTMLEncode(description))
        data.append('expiration', escapeHTMLEncode(date))
        fetch(window.location.href, { body: data, method: 'POST' })
            .then(r => {
                if (!r.ok)
                    throw new Error('Cannot post modifications of list: ' + r.status)
            }).then(_ => {
                alert('Liste modifiée avec succès')
                window.location.href = window.location.href
            }).catch(e => alert(e) /* TODO: add a HTML dialog */)
    })
}

const delListe = document.querySelector('#delliste-form')
if (delListe != undefined) {
    delListe.addEventListener('submit', e => {
        e.preventDefault()
        const url = `/`
        fetch(window.location.href, {method: 'POST'})
            .then(r => {
                if (!r.ok)
                    throw new Error('Cannot delete list: ' + r.status)
            }). then(_ => {
                alert('Liste supprimée')
                window.location.href = url
            }).catch(e => alert(e))
    })
}