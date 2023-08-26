<template>
  <response-message
    v-if="hasError || hasSuccess"
    :errorFlag="hasError"
    :errorMessage="errorMessage"
    :successMessage="successMessage"
  ></response-message>
  <v-container class="fill-height">
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="4">
        <v-card>
          <v-card-title class="text-center">Login</v-card-title>
          <v-card-text class="text-center">
            <v-btn
              color="red"
              dark
              large
              @click="signInWithGmail"
              :disabled="successfullRedirect"
            >
              <v-icon left>mdi-google</v-icon>
              <span class="px-3">Sign in with Gmail</span>
            </v-btn>
          </v-card-text>
          <v-snackbar v-model="snackbar" :timeout="null">
            Please wait vaildating..
          </v-snackbar>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import ResponseMessage from "../General/Response-Message.vue";
import { mapActions } from "vuex";
import { commonGettersMixin } from "../../mixins/response-message";
export default {
  props: {
    clientId: {
      type: String,
    },
    redirectURL: {
      type: String,
    },
    code: {
      type: String,
      default: null,
    },
  },
  components: {
    ResponseMessage,
  },
  mixins: [commonGettersMixin("VerifyUser")],
  data() {
    return {
      loading: false,
      successfullRedirect: false,
    };
  },
  computed: {
    snackbar() {
      return this.successfullRedirect || this.loading;
    },
  },
  created() {
    if (this.$page.props.code) {
      this.successfullRedirect = true;
    }
  },
  watch: {
    successfullRedirect() {
      if (this.successfullRedirect) {
        this.validateUser();
      }
    },
  },
  methods: {
    ...mapActions("VerifyUser", ["VALIDATE_PROVIDER_USER"]),
    getParams() {
      return { code: this.$page.props.code };
    },
    async signInWithGmail() {
      this.loading = true;
      const clId = this.$page.props.clientId;
      const rdURL = this.$page.props.redirectURL;
      const authUrl = `https://accounts.google.com/o/oauth2/v2/auth?client_id=${clId}&redirect_uri=${rdURL}&scope=openid%20profile%20email&response_type=code`;
      window.location.href = authUrl;
    },
    async validateUser() {
      this.loading = true;
      let params = this.getParams();
      await this.VALIDATE_PROVIDER_USER(params);
      this.loading = false;
      if (!this.hasError) {
        this.$inertia.visit("/", { method: "get" });
      }
    },
  },
};
</script>

<style>
</style>