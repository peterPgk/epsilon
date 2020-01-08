import axios from "axios";

axios.defaults.baseUrl = 'http://test.test/api';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default {
    destroyAuth(context) {
        if (context.getters.loggedIn) {
            //TODO: If we handle auth process from BE, we need to make request to the server here
            localStorage.removeItem('auth');
            context.commit('destroyAuth');
        }
    },
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
                    localStorage.setItem('auth', JSON.stringify(response.data));
                    commit('storeAuth', response.data);

                    resolve(response)
                })
                .catch(error => {
                    reject(error);
                })
        });
    },

    retrieveServices(context) {
        console.log(context.getters.hasServices);

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
                    console.log(data, 'from server');
                    //Save to the LS
                    // localStorage.setItem('auth', data);
                    // localStorage.setItem('auth', JSON.stringify(response.data));
                    context.commit('storeServices', data.services);

                    // resolve(response)
                })
                .catch(error => {
                    // reject(error);
                    console.log(error)
                })
        }
    }
}
