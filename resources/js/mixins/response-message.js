import { mapGetters } from 'vuex';

export const commonGettersMixin = (moduleName) => ({
    computed: {
        ...mapGetters(moduleName, [
            'hasError',
            'errorMessage',
            'hasSuccess',
            'successMessage',
        ]),
    },
});