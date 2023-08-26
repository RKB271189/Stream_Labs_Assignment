import { commonInitialState, commonGetters, commonMutations } from "../common"
function initialState() {
    return {
        ...commonInitialState,
        passportToken: null
    }
}
const getters = {
    ...commonGetters,
    passportToken: state => state.passportToken,
}
const actions = {
    async VALIDATE_PROVIDER_USER({ commit }, params) {
        commit('RESET_RESPONSE_FLAG')
        try {
            let res = await axios.post('/provider/callback', params)
            if (res.status === 200) {
                commit('SET_PASSPORT_TOKEN', res.data.token)
                commit('SET_SUCCESS', res.data.message)
            }
        } catch (error) {
            commit('SET_ERROR', error.response.data)
        }
    },
}
const mutations = {
    ...commonMutations,
    SET_PASSPORT_TOKEN(state, value) {
        state.passportToken = value
    }
}
export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}