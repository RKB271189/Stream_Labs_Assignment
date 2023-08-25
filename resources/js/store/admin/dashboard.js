import { commonInitialState, commonGetters, commonMutations } from "../common"
function initialState() {
    return {
        ...commonInitialState,
        eventList: [],
    }
}
const getters = {
    ...commonGetters,
    eventList: state => state.eventList
}
const actions = {
    async GET_EVENT_ACTIVITY({ commit }, params) {
        try {
            commit('RESET_RESPONSE_FLAG')
            let res = await axios.get('get-activity', params);
            if (res.status == 200) {
                commit('SET_SUCCESS', res.data.message)
                commit('SET_EVENT_DETAILS', res.data.events)
            }
        } catch (error) {
            commit('SET_ERROR', error.response.data)
        }
    }
}
const mutations = {
    ...commonMutations,
    SET_EVENT_DETAILS(state, value) {
        state.eventList = value    
    }
}
export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}