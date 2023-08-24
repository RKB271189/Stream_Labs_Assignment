export const commonInitialState = {
    hasError: false,
    errorMessage: {},
    hasSuccess: false,
    successMessage: null,
}
export const commonGetters = {
    hasError: state => state.hasError,
    errorMessage: state => state.errorMessage,
    hasSuccess: state => state.hasSuccess,
    successMessage: state => state.successMessage
};
export const commonMutations = {
    RESET_RESPONSE_FLAG(state) {
        state.hasError = false;
        state.hasSuccess = false;
    },
    SET_ERROR(state, value) {
        state.hasError = true;
        state.errorMessage = value;
    },
    SET_SUCCESS(state, value) {
        state.hasSuccess = true;
        state.successMessage = value;
    }
};
