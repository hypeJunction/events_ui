<?php

namespace Events\UI;

use Events\API\Util;

$entity = elgg_extract('entity', $vars);

echo '<div>';
echo '<label>' . elgg_echo('events:settings:sitecalendar:enable') . '</label>';
echo elgg_view('input/dropdown', array(
	'name' => "params[sitecalendar]",
	'value' => (int) $entity->sitecalendar,
	'options_values' => array(
		1 => elgg_echo('option:yes'),
		0 => elgg_echo('option:no')
	)
));
echo '</div>';


echo '<h3>' . elgg_echo('events:settings:timezone') . '</h3>';

echo '<p class="elgg-text-help">' . elgg_echo('events:settings:timezone:help') . '</p>';

$timezones = Util::getTimezones(false, Util::TIMEZONE_FORMAT_FULL, time(), Util::TIMEZONE_SORT_OFFSET);

echo '<div>';
echo '<label>' . elgg_echo('events:settings:timezone:picker') . '</label>';
echo elgg_view('input/dropdown', array(
	'name' => "params[timezone_picker]",
	'value' => $entity->timezone_picker,
	'options_values' => array(
		true => elgg_echo('option:yes'),
		false => elgg_echo('option:no')
	)
));
echo '</div>';

echo '<div>';
echo '<label>' . elgg_echo('events:settings:timezone:default') . '</label>';
echo elgg_view('input/dropdown', array(
	'name' => "params[default_timezone]",
	'value' => $entity->default_timezone,
	'options_values' => $timezones
));
echo '</div>';

echo '<div>';
echo '<label>' . elgg_echo('events:settings:timezone:config') . '</label>';
echo elgg_view('input/checkboxes', array(
	'options' => array_flip($timezones),
	'name' => "params[custom_timezones]",
	'value' => (isset($entity->custom_timezones)) ? unserialize($entity->custom_timezones) : array_keys($timezones),
));
echo '</div>';

echo '<div>';
echo '<label>' . elgg_echo('events:settings:ical:help_page_url') . '</label>';
echo elgg_view('input/text', array(
	'name' => "params[ical_help_page_url]",
	'value' => $entity->ical_help_page_url,
));
echo '</div>';