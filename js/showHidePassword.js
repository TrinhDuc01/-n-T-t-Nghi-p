const showPass = document.getElementsByClassName('password');
const currentType = document.getElementsByClassName('password');
const buttonShowHide = document.getElementsByClassName('showHide');

function showHidePass(index) {
    if (currentType[index].type === 'password') {
        showPass[index].setAttribute("type", "text");
        buttonShowHide[index].innerHTML = '<i class="fa-solid fa-eye"></i>';
    }
    else {
        showPass[index].setAttribute("type", "password");
        buttonShowHide[index].innerHTML = '<i class="fa-solid fa-eye-slash"></i>'
    }

}
