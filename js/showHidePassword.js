const showPass = document.getElementsByClassName('password');
const currentType = document.getElementsByClassName('password');
const buttonShowHide = document.getElementsByClassName('showHide');

function showHidePass() {
    if (currentType[0].type === 'password') {
        showPass[0].setAttribute("type", "text");
        buttonShowHide[0].innerHTML = '<i class="fa-solid fa-eye"></i>';
    }
    else {
        showPass[0].setAttribute("type", "password");
        buttonShowHide[0].innerHTML = '<i class="fa-solid fa-eye-slash"></i>'
    }

}

function showHidePassConfirm() {
    if (currentType[1].type === 'password') {
        showPass[1].setAttribute("type", "text");
        buttonShowHide[1].innerHTML = '<i class="fa-solid fa-eye"></i>';
    }
    else {
        showPass[1].setAttribute("type", "password");
        buttonShowHide[1].innerHTML = '<i class="fa-solid fa-eye-slash"></i>'
    }

}