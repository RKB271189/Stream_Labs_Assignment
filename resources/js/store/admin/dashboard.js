function initialState() {

}
const getters = {

}
const actions = {
    async SOME_SERVER_ACTION({ commit }) {
        try {
            let res = await axios.post('/testing-token');
            if (res.status == 200) {

            }
        } catch (error) {
        }
    }
}
const mutations = {

}
export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}