import { createStore } from 'vuex'
import axios from 'axios';

let userInfo = localStorage.getItem('userInformation');
if(!userInfo) {
  userInfo = ''
} else {
  userInfo = JSON.parse(userInfo);
}

export default createStore({
  state: {
    error: '',
    userInfo: userInfo
  },
  getters: {
  },
  mutations: {
    USER_INFO(state, user) { 
      state.userInfo = user;
      localStorage.setItem('userInformation',JSON.stringify(state.userInfo));
    },
    logout(state) {
      state.userInfo = '';
      localStorage.removeItem('userInformation');
    }
  },
  actions: {
    login({ commit }, datas) {
      return new Promise((resolve, reject) => {
        axios.post('http://localhost:80/recette_fiscale/signin',datas)
        .then((res) => resolve(res))
        .catch(err => reject(err));
      })
    },
    userInfo({ commit }, data) {
      commit('USER_INFO', data);
    }
  },
  modules: {
  }
})
