<?php

include_once("game_engine.php"); //game engine functions

$mysql_data = get_val($current_village_id); //Final values for viewing to player

$res_p_h = res_calc($current_village_id); //Calcs production and resources returns hourly production

include_once("event_manager.php"); //will be migrated to game_engine.php

$mysql_data = get_val($current_village_id); //Final values for viewing to player