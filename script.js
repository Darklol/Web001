"use strict";
let y, r, x;


document.onsubmit = function () {
    try {
        x = document.querySelector("input[type=checkbox]:checked").value;
        y = document.getElementById("y_textfield").value.replace(",", ".");
        r = document.querySelector('input[name="r"]:checked').value;
        let str = '?x=' + x + '&y=' + y + '&r=' + r;
        fetch("answer.php" + str, {
            method: "GET",
            headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"},
        }).then(response => response.text()).then(function (serverAnswer) {
            document.getElementById("outputContainer").innerHTML = serverAnswer;
        }).catch(err => alert("Ошибка HTTP. Повторите попытку позже." + err));
    } catch (e) {
        alert(e);
    }
};


function validateX() {
    try {
        x = document.getElementsByName('x').value;
        return true;
    } catch (err) {
        alert(err);
        return false;
    }
}

function validateY() {
    y = document.getElementById("y_textfield").value.replace(",", ".");
    alert(y);
    if (y === undefined) {
        return false;
    } else if (!isNumeric(y)) {
        return false;
    } else if (!((y > -3) && (y < 5))) {
        return false;
    } else return true;
}

function validateR() {
    try {
        r = document.getElementById('r').value;
        return true;
    } catch (err) {
        alert(err);
        return false;
    }
}

function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}