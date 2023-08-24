import { createStore } from 'vuex'
import VerifyUser from './auth/verify-user'
import Dashboard from './admin/dashboard'
import Tabular from './admin/tabular'
import Form from './admin/form'
const store = createStore({
    modules: {
        VerifyUser,
        Dashboard,
        Tabular,
        Form
    }
})
export default store