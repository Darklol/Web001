<?php
error_reporting(0);

function checkData($x, $y, $r)
{
    return in_array($x, array(-3, -2, -1, 0, 1, 2, 3, 4, 5)) &&
        is_numeric($y) && ($y > -5 && $y < 5) &&
        in_array($r, array(1, 1.5, 2, 2.5, 3));
}

function rectangle($x, $y, $r)
{
    return (($x <= 0) && ($x >= -$r / 2) && ($y >= 0) && ($y <= $r));
}

function triangle($x, $y, $r)
{
    return (($y <= -$x + $r / 2) && ($x >= 0) && ($x <= $r / 2) && ($y >= 0) && ($y <= $r / 2));
}

function circle($x, $y, $r)
{
    return (($x >= 0) && ($y <= 0) && (($x * $x + $y * $y) <= $r * $r));
}

function checkCoordinates($x, $y, $r)
{
    if (rectangle($x, $y, $r) || triangle($x, $y, $r) || circle($x, $y, $r)) {
        return "<span style='color: green'>да</span>";
    } else return "<span style='color: red'>X</span>";
}

@session_start();
if (!isset($_SESSION["tableRows"])) {
    $_SESSION["tableRows"] = array();
}

date_default_timezone_set("Europe/Moscow");
$x = (float)$_GET["x"];
$y = (float)$_GET["y"];
$r = (float)$_GET["r"];


    $coordsStatus = checkCoordinates($x, $y, $r);
    $currentTime = date("H : i : s");
    $benchmarkTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    array_unshift($_SESSION["tableRows"], "<tr>
    <td>$x</td>
    <td>$y</td>
    <td>$r</td>
    <td>$coordsStatus</td>
    <td>$currentTime</td>
    <td>$benchmarkTime</td>
    </tr>");
    echo "<table id='outputTable'>
        <tr>
            <th>x</th>
            <th>y</th>
            <th>r</th>
            <th>Точка входит в ОДЗ</th>
            <th>Текущее время</th>
            <th>Время работы скрипта</th>
        </tr>";
    foreach ($_SESSION["tableRows"] as $tableRow) echo $tableRow;
echo "</table>";
