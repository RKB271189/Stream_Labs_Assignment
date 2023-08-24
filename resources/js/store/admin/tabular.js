import { commonInitialState, commonGetters, commonMutations } from "../common"
function initialState() {
    return {
        ...commonInitialState,
        tabData: {}
    }
}
const getters = {
    ...commonGetters,
    tabData: state => state.tabData
}
const actions = {
    async GET_TABLE_DETAILS({ commit }, params) {
        try {
            commit('RESET_RESPONSE_FLAG')
            let res = await axios.get('get-table-details', params);
            if (res.status == 200) {
                commit('SET_SUCCESS', res.data.message)
                commit('SET_TAB_DETAILS', res.data.details)
            }
        } catch (error) {
            commit('SET_ERROR', error.response.data)
        }
    }
}
const mutations = {
    ...commonMutations,
    SET_TAB_DETAILS(state, value) {
        state.tabData = value
    }
}
export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}