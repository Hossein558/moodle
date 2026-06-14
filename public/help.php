<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Help tooltip rendering script.
 *
 * This script is responsible for displaying help content either via AJAX calls
 * or in a new popup page. It fetches the requested formatted help string based
 * on the provided identifier and component. To optimize performance and avoid
 * session side-effects, it defines `NO_MOODLE_COOKIES`.
 *
 * Use {@link core_renderer::help_icon()} or {@link addHelpButton()} to display
 * the help icon in the UI.
 *
 * @copyright 2002 onwards Martin Dougiamas
 * @package   core
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_MOODLE_COOKIES', true);

require_once(__DIR__ . '/config.php');

$identifier = required_param('identifier', PARAM_STRINGID);
$component  = required_param('component', PARAM_COMPONENT);
$lang       = optional_param('lang', 'en', PARAM_LANG);

// We don't actually modify the session here as we have NO_MOODLE_COOKIES set.
$SESSION->lang = $lang;

$PAGE->set_url('/help.php');
$PAGE->set_pagelayout('popup');
$PAGE->set_context(context_system::instance());

$data = get_formatted_help_string($identifier, $component, false);
if (!empty($data->heading)) {
    $PAGE->set_title($data->heading);
} else {
    $PAGE->set_title(get_string('help'));
}
echo $OUTPUT->header();
if (!empty($data->heading)) {
    echo $OUTPUT->heading($data->heading, 1, 'helpheading');
}
echo $data->text;
if (isset($data->completedoclink)) {
    echo $data->completedoclink;
}
echo $OUTPUT->footer();
