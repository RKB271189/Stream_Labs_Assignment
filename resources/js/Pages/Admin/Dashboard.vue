<template>
  <v-app>
    <Header></Header>
    <Menu :page-name="pageName"></Menu>
    <v-main>
      <v-container class="fluid">
        <v-row>
          <v-col md="3">
            <count-box
              :boxColor="'#9dc6ff'"
              :textColor="'white'"
              :countNumber="$page.props.follower"
              :countTitle="'Followers'"
              :iconMain="'mdi-account-group'"
              :moreInfoBackColor="'#007bff'"
              :navigateURL="''"
              :enableAction="false"
            ></count-box>
          </v-col>
          <v-col md="3">
            <count-box
              :boxColor="'#6eed72'"
              :textColor="'black'"
              :countNumber="$page.props.total"
              :countTitle="'Revenue'"
              :iconMain="'mdi-currency-usd'"
              :moreInfoBackColor="'#fd7e14'"
              :navigateURL="''"
              :enableAction="false"
            ></count-box>
          </v-col>
          <v-col md="6">
            <v-card variant="tonal">
              <v-card-title class="alert-warning">
                <span class="headline">Top Items</span>
              </v-card-title>
              <v-list lines="one">
                <v-list-item
                  v-for="item in items"
                  :key="item.id"
                  :title="item.item_name"
                ></v-list-item>
              </v-list>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="12">
            <v-card>
              <v-card-title class="alert-warning">
                <span class="headline">Your Activity</span>
              </v-card-title>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import Header from "./Layout/Header.vue";
import Menu from "./Layout/Menu.vue";
import CountBox from "../General/Count-Box.vue";
import { mapActions } from "vuex";
export default {
  props: {
    follower: {
      type: Number,
    },
    total: {
      type: Number,
    },
    items: {
      type: Array,
    },
  },
  data() {
    return {
      dialog: false,
      loading: false,
      pageName: "Dashboard",
    };
  },
  components: {
    Header,
    Menu,
    CountBox,
  },
  methods: {
    ...mapActions("Dashboard", ["SOME_SERVER_ACTION"]),
    async someAction() {
      this.loading = true;
      await this.SOME_SERVER_ACTION();
      this.loading = false;
    },
    closeDialog() {
      this.dialog = false;
    },
    saveDialog() {},
  },
};
</script>