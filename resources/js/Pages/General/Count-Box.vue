<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<template>
  <v-card class="count-box" :color="boxColor">
    <v-card-text style="padding: 1rem" :style="'color:' + textColor">
      <div class="d-flex align-center">
        <div class="mr-3">
          <h1 class="count-number">{{ countNumber }}</h1>
          <p class="mt-5 count-title">{{ countTitle }}</p>
        </div>
        <v-icon class="count-icon-big">{{ iconMain }}</v-icon>
      </div>
    </v-card-text>
    <v-card-actions
      v-if="enableAction"
      class="d-flex justify-center"
      :style="'background-color:' + moreInfoBackColor + ';color:' + textColor"
    >
      <Link
        :href="navigateURL"
        class="count-box-footer"
        :style="'color:' + textColor"
      >
        More info
        <v-icon class="ml-1">mdi-arrow-right-bold-circle-outline</v-icon>
      </Link>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  props: {
    textColor: {
      type: String,
      required: true,
    },
    boxColor: {
      type: String,
      required: true,
    },
    enableAction: {
      type: Boolean,
      required: true,
    },
    moreInfoBackColor: {
      type: String,
      required: true,
    },
    iconMain: {
      type: String,
      required: true,
    },
    countNumber: {
      type: Number,
      required: true,
    },
    countTitle: {
      type: String,
      required: true,
    },
    navigateURL: {
      type: String,
      required: true,
    },
  },
};
</script>

<style>
</style>