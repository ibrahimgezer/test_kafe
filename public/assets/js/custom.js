function showNotification(type, icon = "", title, msg, duration, gravity = "top", position = "right") {
    let styles = {
        'success': {
            'title': "text-success",
            'msg': "text-secondary-soft",
            'background': "linear-gradient(to right, #cac531, #f3f9a7)",
        },
        'danger': {
            'title': "text-danger",
            'msg': "text-secondary-soft",
            'background': "linear-gradient(to right, #cac531, #f3f9a7)",
        },
        'error': {
            'title': "text-danger",
            'msg': "text-secondary-soft",
            'background': "linear-gradient(to right, #cac531, #f3f9a7)",
        },
    };

    Toastify({
        text: '<div class="d-flex rounded-lg">' +
            '<span class="pt-2">' + icon + '</span>' +
            '<div class="ms-2 px-3" style="border-left: 1px solid;border-color: #eaeaea;">' +
            '<div class="' + styles[type].title + ' fw-sm-bold">' + title + '</div>' +
            '<div class="' + styles[type].msg + ' mt-1">' + msg + '</div>' +
            '</div>' +
            '</div>',
        style: {
            background: "white",
        },
        className: type + ' rounded-lg',
        duration: duration * 1000,
        newWindow: true,
        close: false,
        gravity: gravity,
        position: position,
        stopOnFocus: true,
        escapeMarkup: false
    }).showToast();
}
