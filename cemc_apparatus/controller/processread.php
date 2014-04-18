<?php
/**
 * Created by PhpStorm.
 * User: cwilson
 * Date: 10/25/13
 * Time: 11:52 AM
 */

    include_once("../model/Station.php");
    include_once("../model/Regulator.php");
    include_once("../model/Breaker.php");
    include_once("../model/RegulatorRead.php");
    include_once("../model/BreakerRead.php");

    $station = new Station($_POST["station_name"], $_POST["date"]);

    foreach($station->getStationRegulators() as $sr) {
        $rid = $sr->getID();
        $rr = new RegulatorRead($sr, $_POST["date"]);
        $rr->setReadDate($_POST["date"]);
        $rr->setACount($_POST['r'. $rid.'a_count']);
        $rr->setARaise($_POST['r'. $rid.'a_raise']);
        $rr->setALower($_POST['r'. $rid.'a_lower']);
        $rr->setAAmp($_POST['r'. $rid.'a_amp']);
        $rr->setAHighVoltage($_POST['r'. $rid.'a_high_voltage']);
        $rr->setALowVoltage($_POST['r'. $rid.'a_low_voltage']);
        $rr->setAComments($_POST['r'. $rid.'a_comments']);
        $rr->setBCount($_POST['r'. $rid.'b_count']);
        $rr->setBRaise($_POST['r'. $rid.'b_raise']);
        $rr->setBLower($_POST['r'. $rid.'b_lower']);
        $rr->setBAmp($_POST['r'. $rid.'b_amp']);
        $rr->setBHighVoltage($_POST['r'. $rid.'b_high_voltage']);
        $rr->setBLowVoltage($_POST['r'. $rid.'b_low_voltage']);
        $rr->setBComments($_POST['r'. $rid.'b_comments']);
        $rr->setCCount($_POST['r'. $rid.'c_count']);
        $rr->setCRaise($_POST['r'. $rid.'c_raise']);
        $rr->setCLower($_POST['r'. $rid.'c_lower']);
        $rr->setCAmp($_POST['r'. $rid.'c_amp']);
        $rr->setCHighVoltage($_POST['r'. $rid.'c_high_voltage']);
        $rr->setCLowVoltage($_POST['r'. $rid.'c_low_voltage']);
        $rr->setCComments($_POST['r'. $rid.'c_comments']);
        $rr->submitRegulatorRead();
    }

    foreach($station->getStationBreakers() as $sb) {
        $bid = $sb->getID();
        $br = new BreakerRead($sb, $_POST["date"]);
        $br->setReadDate($_POST["date"]);
        $br->setCount($_POST['b'. $bid.'count']);
        $br->setAFlag($_POST['b'. $bid.'a_flag']);
	    $br->setBFlag($_POST['b'. $bid.'b_flag']);
        $br->setCFlag($_POST['b'. $bid.'c_flag']);
        $br->setNFlag($_POST['b'. $bid.'n_flag']);
        $br->setBattery($_POST['b'. $bid.'battery']);

        if ($sb->hasMult() == 1 && $sb->hasAmp() == 1) {
            $br->setAAmps($_POST['b'. $bid.'a_amps']);
            $br->setBAmps($_POST['b'. $bid.'b_amps']);
            $br->setCAmps($_POST['b'. $bid.'c_amps']);
            $br->setAMult($_POST['b'. $bid.'a_mult']);
            $br->setBMult($_POST['b'. $bid.'b_mult']);
            $br->setCMult($_POST['b'. $bid.'c_mult']);
        }

        else if ($sb->hasMult() == 1 && $sb->hasAmp() == 0) {
            $br->setAMult($_POST['b'. $bid.'a_mult']);
            $br->setBMult($_POST['b'. $bid.'b_mult']);
            $br->setCMult($_POST['b'. $bid.'c_mult']);
        }

        else {
            $br->setAAmps($_POST['b'. $bid.'a_amps']);
            $br->setBAmps($_POST['b'. $bid.'b_amps']);
            $br->setCAmps($_POST['b'. $bid.'c_amps']);
        }

        $br->setComments($_POST['b'. $bid.'comments']);
        $br->submitBreakerRead();
    }

    echo("success");

?>