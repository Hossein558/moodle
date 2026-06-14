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
 * Main Moodle configuration loader.
 *
 * This file acts as a bootstrap script for the public webroot. It locates and
 * includes the actual global `config.php` from the directory above. If the
 * configuration file is not found, it assumes Moodle is not installed and
 * redirects the user to `install.php`.
 *
 * @package    core
 * @copyright  2024 Andrew Lyons <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$configfile = __DIR__ . '/../config.php';
if (!file_exists($configfile)) {
    header("Location: install.php");
    die;
}

require_once($configfile);
