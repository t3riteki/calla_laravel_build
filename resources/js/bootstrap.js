// resources/js/bootstrap.js

import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// You can also import lodash or other utilities here if needed
