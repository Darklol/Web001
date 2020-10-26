"use strict";
let x, y, r;

$('.y_value').on('input', validate);
function validate(e) {
    var $item = $(this),
        value = $item.val();
    var st = new RegExp('[^a-zA-Z0-9]+');
    if (!st.test(value)) {
        // прошли проверку - всё ок
        return true;
    } else {
        // не даю ввести неправильный символ
        e.preventDefault();
        // подключен скрипт sweetalert.js
        // показываю алерт, что это была опечатка
        swal ( 'Опечатка' ,  'можно только буквы и цифры' ,  'error' );
    }
}