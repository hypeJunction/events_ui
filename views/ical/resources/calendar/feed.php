<?php

namespace Events\UI;

use Events\API\Calendar;
use Events\API\PAM;
use Events\API\Util;
use Exception;

set_time_limit(0);

$is_logged_in = elgg_is_logged_in();

$guid = get_input('guid');

if (!$is_logged_in) {
	try {
		PAM::authenticate();
	} catch (Exception $ex) {
		register_error($ex->getMessage());
		forward('', '403');
	}
}

$entity = get_entity($guid);

if (!$entity instanceof Calendar) {
	forward('', '404');
}

$now = time();
$start = (int) get_input('start', $now);
$end = (int) get_input('end', strtotime('+1 year', $start));

$start = (int) Util::getDayStart($start);
$end = (int) Util::getDayEnd($end);

$filename = get_input('filename', 'calendar.ics');
$entity->toIcal($start, $end, $filename);

if (!$is_logged_in) {
	logout();
}