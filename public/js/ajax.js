function get(url, success) {
    return _ajax(url, 'GET', success)
}

function post(url, success) {
    return _ajax(url, 'POST', success)
}

function _ajax(url, method, success) {
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
    xhr.open(method, url)
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) success(xhr.responseText)
    }
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
    xhr.send()
    return xhr
}