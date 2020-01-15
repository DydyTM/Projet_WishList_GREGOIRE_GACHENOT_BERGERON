'use strict';

const ajoutParticipant = document.querySelector('#resitem-form')
if(ajoutParticipant != undefined) {
    ajoutParticipant.addEventListener('submit', e => {
        e.preventDefault()

        const participant = escapeHTMLEncode(e.target[0].value)
        const commentaire = escapeHTMLEncode(e.target[1].value)

        if (!participant)
            return alert('Un participant ne peut pas être anonyme')

        const data = new FormData()

        data.append('participant', participant)
        data.append('commentaire', commentaire)
        const url = e.target.attributes[2].value
        fetch(url, {body: data, method: 'POST'})
            .then(r => {
                if(!r.ok)
                    throw new Error('Impossible to add participant to item: ' + r.status)
            }).then(_ => {
                alert('Participant bien ajouté')
                window.location.href = url
            }).catch(e => alert(e))
    })
}

function modifier(tk, id) {
    let port = ""
    if ((port = window.location.port) !== 80)
        port = `:${port}`
    const host = window.location.hostname
    window.location.href = `http://${host}${port}/liste/${tk}/items/${id}/infos`
}

const modificationItem = document.querySelector('#modifitem-form')
if(modificationItem != undefined) {
    modificationItem.addEventListener('submit', e => {
        e.preventDefault()

        const nom = escapeHTMLEncode(e.target[0].value)
        const descr = escapeHTMLEncode(e.target[1].value)
        const tarif = escapeHTMLEncode(e.target[2].value)
        const url = escapeHTMLEncode(e.target[3].value)

        if (!nom)
            return alert('Le nom d\'un item ne peut pas être vide')
        if (!descr)
            return alert('La description d\'un item ne peut pas être vide')
        if (!tarif)
            return alert('Le tarif d\'un item ne peut pas être vide')

        const data = new FormData()

        data.append('nom', nom)
        data.append('descr', descr)
        data.append('tarif', tarif)
        data.append('url', url)
        fetch(`${window.location.href}`, {body: data, method: 'POST'})
            .then(r => {
                if (!r.ok)
                    throw new Error('Cannot post modifications of item: ' + r.status)
            }).then(_ => {
                alert('Item modifié avec succès')
                window.location.href = '/'
            }).catch(e => alert(e) /* TODO: add a HTML dialog */)
    })
}


const delItem = document.querySelector('#delitem-form')
if(delItem != undefined) {
    delItem.addEventListener('submit', e => {
        e.preventDefault()
        fetch(`${window.location.href}/del`, {method: 'POST'})
            .then(r => {
                if (!r.ok)
                    throw new Error('Cannot delete item: ' + r.status)
            }). then(_ => {
                alert('Item supprimé')
                window.location.href = `/profil`
            }).catch(e => alert(e))
    })
}