// Default Laravel bootstrapper, installs axios
import './bootstrap';

 // Added: Actual Bootstrap JavaScript dependency
import 'bootstrap';

 // Added: Popper.js dependency for popover support in Bootstrap
import '@popperjs/core';

import { createApp } from 'vue'

import app from './App.vue'

import router from './router.js'

import { library } from '@fortawesome/fontawesome-svg-core'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import { faList } from '@fortawesome/free-solid-svg-icons'

import { faPen } from '@fortawesome/free-solid-svg-icons'

import { faTrash } from '@fortawesome/free-solid-svg-icons';

library.add(faList, faPen, faTrash)

createApp(app)
    .component('font-awesome-icon', FontAwesomeIcon)
    .use(router)
    .mount("#app")
