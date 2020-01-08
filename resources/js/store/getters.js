import { isEmpty } from 'lodash';
export default {
    loggedIn(state) {
        return state.auth !== null;
    },
    hasServices(state) {
        return ! isEmpty(state.services);
    }
}
