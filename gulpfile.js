const syncDir = require('sync-directory');

const beginLiveUpdates = () => {
    syncDir (
        `/Users/owen/Documents/Dev/Seven Dials Study/DEV/SD Theme/theme`,
        `/Users/owen/Sites/sd/wp-content/themes/sd-ow`,
        {
            watch: true
        }
    )
}

exports.default = beginLiveUpdates;