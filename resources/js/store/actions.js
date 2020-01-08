import axios from "axios";

axios.defaults.baseUrl = 'http://test.test/api';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default {
    /**
     * Logout user.
     * @param context
     */
    destroyAuth(context) {
        if (context.getters.loggedIn) {
            localStorage.removeItem('auth');
            context.commit('destroyAuth');
        }
    },
    /**
     * Make request to obtain access tokens
     *
     * @param commit
     * @param credentials
     * @returns {Promise<unknown>}
     */
    authenticate({commit}, credentials) {
        return new Promise((resolve, reject) => {
            axios
                .post('http://test.test/api/login', {
                    'username': credentials.username,
                    'password': credentials.password
                }, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/vnd.cloudlx.v1+json'
                    }
                })
                .then(response => {
                    //Save to the LS
                    // Use vue-persistedstate ?
                    localStorage.setItem('auth', JSON.stringify(response.data));
                    commit('storeAuth', response.data);

                    resolve(response)
                })
                .catch(error => {
                    //TODO
                    reject(error);
                })
        });
    },

    /**
     * Make request to get services. There are not be stored persistent
     * (use vuex-persistedstate otherwise)
     *
     * @param context
     */
    retrieveServices(context) {
        if (!context.getters.hasServices ) {
            axios
                .get('http://test.test/api/services', {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/vnd.cloudlx.v1+json',
                        'Authorization': 'Bearer ' + context.state.auth.access_token,
                        // 'Access-Control-Allow-Origin'
                    }
                })
                .then(({data}) => {
                    //Save to the LS.
                    context.commit('storeServices', data.services);
                })
                .catch(error => {
                    //TODO Handle errors
                    //TODO If Unauthorized and isLogged -> hit refresh to refresh token
                    console.log(error)
                })
        }
    }
}
