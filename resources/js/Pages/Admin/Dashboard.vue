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
              <div
                id="activity"
                style="max-height: 400px; overflow-y: scroll"
              >
                <template v-for="(item, index) in eventList" :key="item">
                  <div
                    :class="[
                      'pa-2',
                      index % 2 === 0 ? 'bg-grey-lighten-2' : '',
                    ]"
                  >
                    <p v-html="item"></p>
                  </div>
                </template>
                <infinite-loading
                  target="#activity"
                  @infinite="getActivity"
                ></infinite-loading>
              </div>
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
import { mapGetters, mapActions } from "vuex";

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
      currentPage: 1,
      totalPage: null,
      pageName: "Dashboard",
    };
  },
  components: {
    Header,
    Menu,
    CountBox,
  },
  computed: {
    ...mapGetters("Dashboard", ["eventList"]),
  },
  mounted() {
    this.getActivity();
  },
  methods: {
    ...mapActions("Dashboard", ["GET_EVENT_ACTIVITY"]),
    async getActivity() {
      this.currentPage = Math.ceil(this.eventList.length / 100) + 1;
      let params = {
        page: this.currentPage,
      };
      this.loading = true;
      await this.GET_EVENT_ACTIVITY({ params: params });
      this.loading = false;
    },
  },
};
</script>