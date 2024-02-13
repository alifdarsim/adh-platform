import Uppy from '@uppy/core';
import Dashboard from '@uppy/dashboard';

import '@uppy/core/dist/style.min.css';
import '@uppy/dashboard/dist/style.min.css';

// new Uppy().use(Dashboard, {
//     inline: true,
//     target: '#uppy-dashboard',
//     height: 180,
//     hideUploadButton: true,
//     autoOpenFileEditor: true,
//     proudlyDisplayPoweredByUppy: false,
// });

const uppy = new Uppy({
    meta: { type: 'feature_image' },
    restrictions: { maxNumberOfFiles: 1,  allowedFileTypes: ['image/*'] },
    autoProceed: true,
});

uppy.use(Dashboard, {
    id: 'Dashboard',
    trigger: '.UppyModalOpenerBtn',
    inline: true,
    target: '#uppy-dashboard',
    replaceTargetContent: true,
    showProgressDetails: true,
    hideUploadButton: true,
    note: 'Images and video only, 2–3 files, up to 1 MB',
    height: 350,
    browserBackButtonClose: true
})