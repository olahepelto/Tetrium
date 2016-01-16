<center>
    <br><br><br>
    <?php
    $data = mysql_query("SELECT * FROM messages where receiver='$id'") or die(mysql_error());
    ?>

    <table align=center border cellpadding=0>
        <th>Topic:</th>
        <th>Message:</th>
        <th>Sender:</th>
        <th>time:</th>
        </tr> <?php

        while ($info = mysql_fetch_array($data)) {
            //Check sender name
            $sender = $info["sender"];
            $bob = mysql_query("SELECT username FROM members where id='$sender'") or die(mysql_error());

            while ($infoo = mysql_fetch_array($bob)) {
                $sender = $infoo["username"];
            }

            Print "<tr>";
            Print "<td>" . $info['topic'] . "</td><td>" . $info['message'] . "</td><td>" . $sender . "</td><td>" . $info['time'] . "</td></tr>";
        } ?>

    </table>
    <a href=sendmailgui.php>
        <button>Send</button>
    </a>
</center>