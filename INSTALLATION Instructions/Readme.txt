NOTE:
You probably also have to do other things to get it running

1. Place database_structure folder outside of /www/ and make a repeating cronjob to cron_replenish_nature.php
2. Place the root folder contents into /www/ OR /www/html/ if it exists
3. change database details in /tetrium_backend/configuration/databasecredentials.php
4. change database details in www/html/configuration/databasecredentials.php OR www/configuration/databasecredentials.php
5. put tetrium.sql database backup into the mysql:ish database software you have chosen
6. Use the reset map script
7. Create account and login