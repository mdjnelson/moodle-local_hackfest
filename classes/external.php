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
 * This is the external API for this plugin.
 *
 * @package    local_hackfest
 * @copyright  2015 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_hackfest;

global $CFG;

require_once($CFG->libdir . '/externallib.php');

/**
 * This is the external API for this plugin.
 *
 * @copyright  2015 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class external extends \external_api {

    /**
     * Wrap the core function get_random_users_picture.
     *
     * @return \external_function_parameters
     */
    public static function get_random_users_picture_parameters() {
        return new \external_function_parameters(
            array()
        );
    }

    /**
     * Wrap the core function get_random_users_picture.
     */
    public static function get_random_users_picture() {
        global $DB, $OUTPUT, $PAGE;

        $PAGE->set_context(\context_system::instance());

        $user = $DB->get_records('user', array(), 'random()', '*', '0', '1');
        $user = reset($user);

        $html = '<div id=\'userpicture\'>';
        $html .= $OUTPUT->user_picture($user, array('size' => 100));
        $html .= '</div>';

        return $html;
    }

    /**
     * Wrap the core function get_random_users_picture.
     *
     * @return \external_description
     */
    public static function get_random_users_picture_returns() {
        return new \external_value(PARAM_RAW, 'The HTML for the user\'s picture');
    }
}
