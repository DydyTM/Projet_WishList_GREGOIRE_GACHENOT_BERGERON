'use strict';

const nouvelleListe = document.querySelector('#newlist-form')
if (nouvelleListe != undefined) {
    nouvelleListe.addEventListener('submit', e => {
        e.preventDefault();

        const titre = e.target[0].value
        const description = e.target[1].value
        const date = e.target[2].value

        const data = new FormData();

        new Promise((resolve, _) => {
            if (isHTML(titre))
                throw new Error('Content violation: title cannot contain HTML')
            resolve()
        }).then(_ => {
            data.append('titre', titre)
            if (isHTML(description))
                throw new Error('Content violation: description cannot contain HTML')
        }).then(_ => {
            data.append('description', description)
            if (isHTML(date))
                throw new Error('Content violation: date cannot contain HTML')
        }).then(_ => { data.append('expiration', date) })
          .then(_ => fetch('/nouveau/liste', {body: data, method: 'POST'}))
          .then(r => {
              if (!r.ok)
                throw new Error('Cannot post new list: ' + r.status)
        }).then(_ => {
            alert('Nouvelle liste créée')
            window.location.href = '/nouveau/liste'
        }).catch(e => alert(e) /* TODO: add a HTML dialog */)
    })
}