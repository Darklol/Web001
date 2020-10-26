"use strict";
let y, r, x = [];


document.getElementById("submit").onclick = function () {
    try {
        if (validateX() && validateY() && validateR()) {
            for (let i = 0; i < x.length; i++) {
                let x_val = x[i];
                let str = '?x=' + x_val + '&y=' + y + '&r=' + r;
                fetch("answer.php" + str, {
                    method: "GET",
                    headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"},
                }).then(response => response.text()).then(function (serverAnswer) {
                    document.getElementById("output").innerHTML = serverAnswer;
                }).catch(err => alert("Ошибка HTTP. Повторите попытку позже. " + err));
            }
        }
    } catch (e) {
    }
};

document.getElementById("clear_table").onclick = function () {
    try {
        fetch("clear.php", {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
        }).then(response => response.text()).then(function (serverAnswer) {
            document.getElementById("output").innerHTML = serverAnswer;
        }).catch(err => alert("Ошибка HTTP. Повторите попытку позже." + err));
    } catch (e) {
        alert(e);
    }
};


function validateX() {
    let checked = document.querySelectorAll("input[type=checkbox]:checked");
    x = Array.from(checked).map(box => box.value);
    if (x.length > 0) {
        return true;
    } else {
        alert("Выберите хотя бы одно значение X!");
        return false;
    }
}

function validateY() {
    y = document.getElementById("y_textfield").value.replace(",", ".");
    if (!isNumeric(y)) {
        alert("Y должен быть числом! Введите число в диапазоне (-5;5).");
        return false;
    } else if (!((y > -3) && (y < 5))) {
        alert("Число выходит за рамки диапазона! Введите число в диапазоне (-5;5).");
        return false;
    } else return true;
}

function validateR() {
    try {
        r = document.querySelector("input[type=radio]:checked").value;
        return true;
    } catch (err) {
        alert("Выберите значение R!");
        return false;
    }
}

function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}