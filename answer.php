<?php
error_reporting(0);

function check($x, $y, $r)
{
    return in_array($x, array(-3, -2, -1, 0, 1, 2, 3, 4, 5)) &&
        is_numeric($y) && ($y > -5 && $y < 5) &&
        in_array($r, array(1, 1.5, 2, 2.5, 3));
}

function rectangle($x, $y, $r)
{
    return (($x >= 0) && ($x <= $r ) && ($y >= 0) && ($y <= $r ));
}

function triangle($x, $y, $r)
{
    return ((-$y <= ($r / 2 - $x) * 2 ) && ($x >= 0) && ($x <= $r / 2) && ($y <= 0) && (-$y <= $r));
}

function circle($x, $y, $r)
{
    return (($x <= 0) && ($y >= 0) && (($x * $x + $y * $y) <= $r * $r / 4 ));
}

function checkCoordinates($x, $y, $r)
{
    if (rectangle($x, $y, $r) || triangle($x, $y, $r) || circle($x, $y, $r)) {
        return "<span style='color: green'>o</span>";
    } else return "<span style='color: red'>x</span>";
}

@session_start();
if (!isset($_SESSION["tableRows"])) {
    $_SESSION["tableRows"] = array();
}

date_default_timezone_set("Europe/Moscow");
$x = (float)$_GET["x"];
$y = (float)$_GET["y"];
$r = (float)$_GET["r"];

if (check($x, $y, $r)) {
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
    echo "<table>
                 <tr>
                     <th>&nbsp;x&nbsp;</th>
                     <th>&nbsp;y&nbsp;</th>
                     <th>&nbsp;r&nbsp;</th>
                     <th>&nbsp;valid&nbsp;</th>
                     <th>&nbsp;current time&nbsp;</th>
                     <th>&nbsp;script time&nbsp;</th>
                 </tr>";
    foreach ($_SESSION["tableRows"] as $tableRow) echo $tableRow;
    echo "</table>"; }
    else {
        http_response_code(400);
        return;
    }
