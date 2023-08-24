import { createStore } from 'vuex'
import VerifyUser from './auth/verify-user'
import Dashboard from './admin/dashboard'
const store = createStore({
    modules: {
        VerifyUser,
        Dashboard,       
    }
})
export default store