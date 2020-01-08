export default {
    storeAuth(state, authData) {
        state.auth = authData
    },
    destroyAuth(state) {
        state.auth = null;
    },
    storeServices(state, services) {
        state.services = services;
    }
}
