<?php
// My API key
$MyKey = "346D0A5B6B913C14EC1591F66AC5C2DB";
// Steam ID for my personal Steam account
$SteamID = "76561198079595737";

// CALLS
// Example for GetRecentlyPlayedGames
//  http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key=XXXXXXXXXXXXXXXXX&steamid=76561197960434622&format=json
// replace key and steam ID with above

// Example for GetOwnedGames
//  http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=XXXXXXXXXXXXXXXXX&steamid=76561197960434622&format=json 
// Same as above, replace key and steam ID

/*
// API CALLS AND PROCESSING
$ipv4 = stripcslashes($_POST['ipv4']);
// make the call
$data = json_decode(file_get_contents('http://ip-api.com/json/'.$ipv4), true);
$state_abbr = $data['region'];
$zip = $data['zip'];
$isp = $data['isp'];
*/
?>