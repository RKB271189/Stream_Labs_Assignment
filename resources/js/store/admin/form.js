import { commonInitialState, commonGetters, commonMutations } from "../common"
function initialState() {
    return {
        ...commonInitialState,
        formData: {}
    }
}

const getters = {
    ...commonGetters,
    formData: state => state.formData
}

const actions = {
    async SAVE_FORM_DETAILS({ commit }, params) {
        commit('RESET_RESPONSE_FLAG')
        try {
            let config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let res = await axios.post('/save-form-details', params, config);
            if (res.status === 200) {
                commit('SET_SUCCESS', res.data.message)
                commit('SET_FORM_DATA', res.data.details)
            }
        } catch (error) {
            commit('SET_ERROR', error.response.data)
        }
    }
}

const mutations = {
    ...commonMutations,
    SET_FORM_DATA(state, value) {
        state.formData = value
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}