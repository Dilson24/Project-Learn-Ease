document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const registerParam = urlParams.get('register');
    const chk = document.getElementById('chk');
    const originalTitle = document.title;

    if (registerParam === 'newUser') {
        chk.checked = true;
        document.title = 'Register';
    }

    chk.addEventListener('click', function () {
        if (chk.checked) {
            history.pushState(null, '', '?register=newUser');
            document.title = 'Register';
        } else {
            history.pushState(null, '', window.location.pathname);
            document.title = originalTitle;
        }
    });
});





