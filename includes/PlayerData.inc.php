<?php 

require_once('Rank.inc.php');
require_once('Stats.inc.php');
require_once('Time.inc.php');

class PlayerData {
    private $playerName;
    private $playerId;
    private $platform;
    private $region;
    private $command;

    private $rank;
    private $stats;
    private $time;

    function __construct() {
        $this->rank = new Rank();
        $this->stats = new Stats();
        $this->time = new Time();
    }

    function processPlayerNameOrId($name, $id) {
        //Checks if players id or name was inserted or if both are inserted
        if (empty($name) && empty($id)) {
            die('Missing player id/name');
        } elseif (!empty($name) && !empty($id) ) {
            die("You can't have a player's ID and Name introduzed at the same time");
        }
    }

    function definePlayerNameOrId($name, $id) {
        if (!empty($id)) {
            $this->playerId = $id;
        } elseif (!empty($name)) {
            $this->playerName = $name;
        }
    }

    function checkForPlatform($platform) {
        if (empty($platform)) {
            die('Missing platform');
        } else {
            switch ($platform) {
                //Check for Uplay
                case 'uplay':
                $this->platform = 'uplay';
                break;

                case 'pc':
                $this->platform = 'uplay';
                break; 

                //Check for PSN
                case 'psn':
                $this->platform = 'psn';
                break;

                case 'ps4':
                $this->platform = 'psn';
                break; 

                //Check for XBL
                case 'xbl':
                $this->platform = 'xbl';
                break;

                case 'xbox':
                $this->platform = 'xbl';
                break;

                //If platform does not match any of the expected inputs, returns error
                default:
                die('Invalid platform inserted');
            }
        }
    }

    function checkForRegion($region) {
        if (empty($region)) {
            die('Missing region');
        } else {
            switch (strtoupper($region)) {
                //Check for Europe
                case 'EU':
                $this->region = 'EU';
                break;

                case 'EUROPE':
                $this->region = 'EU';
                break;

                //Check for North America
                case 'NA':
                $this->region = 'NA';
                break;
    
                case 'NORTHAMERICA':
                $this->region = 'NA';
                break;

                //Check for Asia
                case 'AS':
                $this->region = 'AS';
                break;
        
                case 'ASIA':
                $this->region = 'AS';
                break;

                //If region does not match any of the expected inputs, returns error
                default:
                die('Invalid region inserted');
            }
        }
    }
    
    function checkForCommand($command) {
        switch ($command) {
            case 'rank':
            $this->command = 'rank';
            break;

            case 'stats':
            $this->command = 'stats';
            break;

            case 'time':
            $this->command = 'time';
            break;

            default:
            $this->command = 'rank';
        }
    }

    function processRequest() {
        switch ($this->command) {
            case 'rank':
                if (!empty($this->playerName)) {
                    $this->rank->getPlayerRankByName($this->playerName, $this->platform, $this->region);
                } elseif (!empty($this->playerId)) {
                    $this->rank->getPlayerRankById($this->playerId, $this->platform, $this->region);
                }
            break;
            
            case 'stats':
                if (!empty($this->playerName)) {
                    $this->stats->getPlayerStatsByName($this->playerName, $this->platform, $this->region);
                } elseif (!empty($this->playerId)) {
                    $this->stats->getPlayerStatsById($this->playerId, $this->platform, $this->region);
                }
            break;
            
            case 'time':
                if (!empty($this->playerName)) {
                    $this->time->getPlayerTimeByName($this->playerName, $this->platform, $this->region);
                } elseif (!empty($this->playerId)) {
                    $this->time->getPlayerTimeById($this->playerId, $this->platform, $this->region);
                }
            break;
        }
    }
    
}
