'use strict';

const ajoutParticipant = document.querySelector('#resitem-form')
if(ajoutParticipant != undefined) {
    ajoutParticipant.addEventListener('submit', e => {
        e.preventDefault()
        const participant = e.target[0].value
        const data = new FormData()
        data.append('participant', escapeHTMLEncode(participant))
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

const delItem = document.querySelector('#delitem-form')
if(delItem != undefined) {
    delItem.addEventListener('submit', e => {
        e.preventDefault()
        const url = `/`
        fetch(`${window.location.href}/del`, {method: 'POST'})
            .then(r => {
                if (!r.ok)
                    throw new Error('Cannot delete item: ' + r.status)
            }). then(_ => {
                alert('Item supprimé')
                window.location.href = url
            }).catch(e => alert(e))
    })
}