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
          <v-card-title class="text-center"> Login Form </v-card-title>
          <v-card-text>
            <v-text-field
              variant="outlined"
              v-model="email"
              label="Username"
              :rules="emailRules"
              clearable
              required
            ></v-text-field>
            <v-text-field
              class="mt-2"
              variant="outlined"
              v-model="password"
              label="Password"
              :append-inner-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
              :type="showPassword ? 'text' : 'password'"
              @click:append-inner="showPassword = !showPassword"
              :rules="passwordRules"
              clearable
              required
            ></v-text-field>
            <v-btn
              type="button"
              :loading="loading"
              class="flex-grow-1 mt-2"
              height="48"
              color="primary"
              @click="verifyUser()"
              :disabled="!isFormValid"
              block
            >
              <v-icon class="mr-1">mdi-login</v-icon>
              Login
            </v-btn>
          </v-card-text>
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
  components: {
    ResponseMessage,
  },
  mixins: [commonGettersMixin("VerifyUser")],
  data() {
    return {
      loading: false,
      email: null,
      password: null,
      showPassword: false,
      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
      passwordRules: [
        (v) => !!v || "Password is required",
        (v) => v.length >= 6 || "Password must be atleast of 6 characters",
      ],
    };
  },
  computed: {
    isFormValid() {
      return (
        this.emailRules.every((rule) => rule(this.email) === true) &&
        this.passwordRules.every((rule) => rule(this.password) === true)
      );
    },
  },
  methods: {
    ...mapActions("VerifyUser", ["VERIFY_USER_CREDENTIALS"]),
    getParams() {
      return {
        email: this.email,
        password: this.password,
      };
    },
    async verifyUser() {
      this.loading = true;
      let params = this.getParams();
      await this.VERIFY_USER_CREDENTIALS(params);
      this.loading = false;
      if (!this.hasError) {
        this.$inertia.visit("admin-dashboard", { method: "get" });
      }
    },
  },
};
</script>

<style>
</style>