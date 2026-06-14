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
 * Failsafe textarea editor support.
 *
 * @package    editor
 * @subpackage textarea
 * @copyright  2009 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Class textarea_texteditor
 *
 * Implements a failsafe, standard HTML textarea based editor.
 */
class textarea_texteditor extends texteditor {
    /**
     * Determines whether the browser supports this editor.
     * Textarea is universally supported.
     *
     * @return bool True
     */
    public function supported_by_browser() {
        return true;
    }

    /**
     * Returns the array of text formats supported by this editor.
     *
     * @return array Array mapping format constants to themselves
     */
    public function get_supported_formats() {
        return array(FORMAT_HTML     => FORMAT_HTML,
                     FORMAT_MOODLE   => FORMAT_MOODLE,
                     FORMAT_PLAIN    => FORMAT_PLAIN,
                     FORMAT_MARKDOWN => FORMAT_MARKDOWN,
                    );
    }

    /**
     * Returns the preferred text format for this editor.
     *
     * @return int The preferred format constant
     */
    public function get_preferred_format() {
        return FORMAT_MOODLE;
    }

    /**
     * Determines if this editor supports repositories (file picking).
     *
     * @return bool True if it supports repositories
     */
    public function supports_repositories() {
        return true;
    }

    /**
     * Sets up the editor for a specific element.
     * For a plain textarea, there is no special initialization needed.
     *
     * @param string $elementid The ID of the element to turn into an editor
     * @param array|null $options Additional editor options
     * @param mixed $fpoptions File picker options
     */
    public function use_editor($elementid, ?array $options=null, $fpoptions=null) {
        return;
    }
}


