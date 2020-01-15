'use strict';

const nouvelleListe = document.querySelector('#newlist-form')
if (nouvelleListe != undefined) {
    nouvelleListe.addEventListener('submit', e => {
        e.preventDefault()

        const titre = escapeHTMLEncode(e.target[0].value)
        const description = escapeHTMLEncode(e.target[1].value)
        const date = escapeHTMLEncode(e.target[2].value)

        if (!titre)
            return alert('Le titre d\'une liste ne peut pas être vide')
        if (!description)
            return alert('La description d\'une liste ne peut pas être vide')

        const data = new FormData();

        data.append('titre', titre)
        data.append('description', description)
        data.append('expiration', date)
        data.append('publique', escapeHTMLEncode(e.target[3].checked))
        fetch('/nouveau/liste', {body: data, method: 'POST'})
            .then(r => {
                if (!r.ok)
                    throw new Error('Cannot post new list: ' + r.status)
            }).then(_ => {
                alert('Nouvelle liste créée')
                window.location.href = '/profil'
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

        const titre = escapeHTMLEncode(e.target[0].value)
        const description = escapeHTMLEncode(e.target[1].value)
        const prix = escapeHTMLEncode(e.target[2].value)
        const urlP = escapeHTMLEncode(e.target[3].value) || ''

        if (!titre)
            return alert('Le titre d\'un item ne peut pas être vide')
        if (!description)
            return alert('La description d\'un item ne peut pas être vide')
        if (!prix)
            return alert('Le prix d\'un item ne peut pas être vide')

        const tk = e.target.attributes[2].value

        const data = new FormData()

        data.append('titre', titre)
        data.append('description', description)
        data.append('prixItem', prix)
        data.append('urlProduit', urlP)

        const url = `/liste/${tk}/ajouterItem`

        fetch(url, {body: data, method: 'POST'})
            .then(r => {
                if (!r.ok)
                    throw new Error()
            }).then(_ => {
                alert('Nouvel item créé')
                window.location.href = `/profil`
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

        const titre = escapeHTMLEncode(e.target[0].value)
        const description = escapeHTMLEncode(e.target[1].value)
        const date = escapeHTMLEncode(e.target[2].value)

        if (!titre)
            return alert('Le titre d\'une liste ne peut pas être vide')
        if (!description)
            return alert('La description d\'une liste ne peut pas être vide')
        if (!date)
            return alert('La date d\'échance d\'une liste ne peut pas être vide')

        const data = new FormData();

        data.append('titre', titre)
        data.append('description', description)
        data.append('expiration', date)
        data.append('publique', escapeHTMLEncode(e.target[3].checked))
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
        const url = `/profil`
        fetch(`${window.location.href}/del`, {method: 'POST'})
            .then(r => {
                if (!r.ok)
                    throw new Error('Cannot delete list: ' + r.status)
            }). then(_ => {
                alert('Liste supprimée')
                window.location.href = url
            }).catch(e => alert(e))
    })
}

function ajoutCommentaire(tk) {
    window.location.href = `/liste/${tk}/ajoutCommentaire`
}

const nouveauCommentaire = document.getElementById('newcomm-form')
if (nouveauCommentaire != undefined) {
    nouveauCommentaire.addEventListener('submit', e => {
        e.preventDefault()

        const pseudo = escapeHTMLEncode(e.target[0].value)
        const message = escapeHTMLEncode(e.target[1].value)

        if (!message)
            return alert('Le message d\'un commentaire ne peut pas être vide')

        const data = new FormData();
        data.append('pseudo', pseudo)
        data.append('message', message)
        const token = e.target.attributes[2].value

        const url = `/liste/${token}`

        fetch(`/liste/${token}/ajoutCommentaire`, {body: data, method: 'POST'})
            .then(r => {
                if (!r.ok)
                    throw new Error("Could not post: " + r.status)
            })
            .then(_ => {
                alert('Commentaire ajouté')
                window.location.href = url
            })
    })
}