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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Script to update the @moodlehq/design-system bundle.
 *
 * @copyright  Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import path from 'path';
import { fileURLToPath } from 'url';
import { copyFromNodeModules, getPackageVersion, getRootDir } from '../lib/util.mjs';

/**
 * Initializes the update process for the @moodlehq/design-system package.
 * This function locates the current root directory, retrieves the desired version of the design system
 * from package dependencies, and copies necessary distribution files and SCSS tokens to Moodle's bundle directory.
 * It also manages the update of third-party library descriptions.
 *
 * @returns {Promise<void>} Resolves when the update process completes.
 */
export async function init() {
    const rootDir = getRootDir();
    const version = getPackageVersion('@moodlehq/design-system');
    const bundleRoot = path.join(rootDir, 'lib', 'bundles', 'design-system');
    const bundleJsRoot = path.join(bundleRoot, 'js');
    const bundleScssRoot = path.join(bundleRoot, 'scss');

    copyFromNodeModules({
        packageName: '@moodlehq/design-system',
        version,
        cleanDirs: [bundleRoot],
        copies: [
            { src: 'dist', dest: bundleJsRoot, label: '@moodlehq/design-system JS bundles' },
            {
                src: path.join('tokens', 'scss'),
                dest: path.join(bundleScssRoot, 'tokens', 'scss'),
                label: '@moodlehq/design-system tokens',
            },
        ],
        readmePaths: [bundleRoot],
        thirdpartylibs: [
            { componentPath: path.join(rootDir, 'lib'), packageLocation: 'bundles/design-system' },
        ],
    });
}

if (process.argv[1] === fileURLToPath(import.meta.url)) {
    init().catch((err) => {
        console.error(err.message);
        process.exit(1);
    });
}
