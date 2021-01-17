import Vue from 'vue';
import Vuex from 'vuex';
import { EventBus } from '../eventBus';
import { apiService } from '../_services/apiService'

Vue.use(Vuex)

let routeUser = '/api/users';

export const store = new Vuex.Store({

    state: {
        barColor: '',
        drawer: null,
        page: 0,
        users: [],
        pagination: {
            visible: 10,
            pageCount: 0,
        }
    },

    mutations: {
        SET_DRAWER (state, payload) {
          state.drawer = payload
        },
      },

    actions: {
        getPagesUsers({ state }) {

            state.users = [];
            EventBus.$on('updatePage', (page) => {
                state.page = page;
            })
            apiService.get(routeUser + '?page=' + state.page).then(({ data }) => {
                data.data.forEach(user => {
                    state.users.push(user);
                });
                state.pagination.pageCount = data.last_page
            })
        }
    }
})