<template>
  <v-navigation-drawer v-model="drawer" app class="bg-opacity-blue">
    <v-list>
      <v-list-item-group v-model="selectedItem">
        <v-list-item
          v-for="(item, index) in menuItems"
          :key="index"
          @click="toggleSubMenu(item)"
        >
          <v-list-item-content>
            <v-list-item-title @click="redirectTo(item.url)">
              <v-icon>{{ item.icon }}</v-icon>
              <span class="menu-name">{{ item.title }}</span>
              <v-icon class="arrow-icon" v-if="item.submenu">{{
                getSubMenuIcon(item)
              }}</v-icon>
            </v-list-item-title>
          </v-list-item-content>
          <transition name="fade">
            <v-list-item-group
              v-if="item.submenu && item.open"
              v-model="selectedSubItem"
            >
              <v-list-item
                v-for="(subItem, subIndex) in item.submenu"
                :key="subIndex"
                @click.stop
              >
                <v-list-item-content>
                  <v-list-item-title>
                    <v-icon>{{ subItem.icon }}</v-icon>
                    <span class="menu-name">{{ subItem.title }}</span>
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </transition>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-navigation-drawer>

  <v-app-bar app>
    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
    <v-toolbar-title>{{ pageName }}</v-toolbar-title>
  </v-app-bar>
</template>

<script>
export default {
  props: {
    pageName: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      drawer: true,
      selectedItem: null,
      selectedSubItem: null,
      menuItems: [
        {
          title: "Dashboard",
          icon: "mdi-view-dashboard",
          url: "/",
        },
      ],
    };
  },
  methods: {
    toggleSubMenu(item) {
      if (item.submenu) {
        if (item.open) {
          item.open = false;
        } else {
          this.menuItems.forEach((menu) => {
            if (menu !== item) {
              menu.open = false;
            }
          });
          item.open = true;
        }
      } else {
        this.menuItems.forEach((menu) => {
          if (menu !== item) {
            menu.open = false;
          }
        });
      }
    },
    getSubMenuIcon(item) {
      return item.open ? "mdi-chevron-down" : "mdi-chevron-right";
    },
    redirectTo(url) {
      if (url !== "") {
        this.$inertia.visit(url, { method: "get" });
      }
    },
  },
};
</script>
