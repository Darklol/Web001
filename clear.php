<?php

session_start();
$_SESSION['tableRows'] = array();
echo "<table>
                 <tr>
                     <th>&nbsp;x&nbsp;</th>
                     <th>&nbsp;y&nbsp;</th>
                     <th>&nbsp;r&nbsp;</th>
                     <th>&nbsp;valid&nbsp;</th>
                     <th>&nbsp;current time&nbsp;</th>
                     <th>&nbsp;script time&nbsp;</th>
                 </tr>
       </table>";