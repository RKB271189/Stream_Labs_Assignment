<template>
  <v-expand-transition>
    <v-card v-show="expand2" class="mx-auto bg-secondary">
      <v-snackbar
        v-model="snackbar"
        timeout="3000"
        location="top right"
        multi-line
        :color="messageColor"
      >
        <v-alert
          :icon="responseIcon"
          :title="responseType"
          :text="text"
          variant="tonal"
        ></v-alert>
      </v-snackbar>
    </v-card>
  </v-expand-transition>
</template>
  <script>
export default {
  data() {
    return {
      messageColor: "red-darken-2",
      responseType: "Error",
      text: "",
      responseIcon: "mdi-alert-circle-outline",
      snackbar: true,
    };
  },
  props: {
    errorMessage: null,
    successMessage: null,
    errorFlag: {
      type: Boolean,
      required: true,
    },
  },
  created: function () {
    if (!this.errorFlag) {
      this.messageColor = "green-darken-2";
      this.responseType = "Success";
      this.responseIcon = "mdi-check-circle-outline";
      this.text = this.successMessage;
    } else {
      let result = [];
      for (let [key, value] of Object.entries(this.errorMessage)) {
        result.push(`${value}`);
      }
      this.text = result.join("<br/>");
    }
  },
};
</script>