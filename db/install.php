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


defined('MOODLE_INTERNAL') || die();

function xmldb_local_testmoodlemootanalytics_install() {
    global $DB;

    \core\session\manager::set_user(get_admin());

    $usedtargets = $DB->get_fieldset_select('analytics_models', 'DISTINCT target', '');

    $indicator = \core_analytics\manager::get_indicator('\local_testmoodlemootanalytics\analytics\indicator\just_files_resources_and_a_forum');
    $indicators = array($indicator->get_id() => $indicator);

    if (!in_array('\local_testmoodlemootanalytics\analytics\target\for_your_files_only', $usedtargets)) {
        $target = \core_analytics\manager::get_target('\local_testmoodlemootanalytics\analytics\target\for_your_files_only');
        $model = \core_analytics\model::create($target, $indicators, '\core\analytics\time_splitting\no_splitting');
        $model->enable();
    }

}
