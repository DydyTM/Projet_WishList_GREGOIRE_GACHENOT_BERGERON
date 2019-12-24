'use strict';

function escapeHTMLEncode(str) {
    const div = document.createElement('div')
    const text = document.createTextNode(str)
    div.appendChild(text)
    const innerHTML = div.innerHTML
    div.remove()
    return innerHTML
}