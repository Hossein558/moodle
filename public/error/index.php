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
 * Moodle 404 Error page
 *
 * This script serves as the global 404 error handler for the Moodle application.
 * It is typically configured in the webserver (e.g., Apache via ErrorDocument 404 /error/index.php)
 * to intercept 404 Not Found HTTP errors. The error is then passed to Moodle, allowing it to be
 * dynamically rendered using the active Moodle site theme and current language settings,
 * maintaining a consistent user experience.
 *
 * Example webserver configuration:
 * ErrorDocument 404 /error/index.php
 *
 * @package    core
 * @copyright  Brendan Heywood <brendan@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once("../r.php");
