export default {
    loggedIn(state) {
        return state.auth !== null;
    },
    hasServices(state) {
        return state.services.length !== 0;
    }
}
