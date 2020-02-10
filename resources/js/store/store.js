import Vue from 'vue'
import Vuex from 'vuex'
import prospectos from '../store/modules/prospectos'
import llamadas from '../store/modules/llamadas'
import reuniones from '../store/modules/reuniones'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        prospectos,
        llamadas,
        reuniones
    }
})
