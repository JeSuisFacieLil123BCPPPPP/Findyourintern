<!--<template>-->
<!-- <div class="">
    <div v-if="user.user_type == 'admin'">
      <v-navigation-drawer
        dark
        class="d-flex flex-column flex-shrink-0 sidebar position-fixed top-0"
        id="sidebar1"
        :style="{
          width: sidebarlg,
          height: '100vh',
          color: 'white',
        }"
        v-if="sidebarstate"
      >
        <v-card class="mx-auto sidebar h-100" width="256" tile>
          <v-system-bar></v-system-bar>
          <div class="navbar-brand"><span class="bg-success">EtStudent</span></div>
          <v-divider></v-divider>
          <v-list>
            <v-list-item>
              <v-list-item-avatar>
                <v-img src="https://cdn.vuetifyjs.com/images/john.png"></v-img>
              </v-list-item-avatar>
            </v-list-item>
            <v-list-item link>
              <v-list-item-content>
                <v-list-item-title class="text-h6">
                  {{ user.pseudo }}
                </v-list-item-title>
                <v-list-item-subtitle>{{ user.email }}</v-list-item-subtitle>
              </v-list-item-content>

              <v-list-item-action>
                <v-icon>mdi-menu-down</v-icon>
              </v-list-item-action>
            </v-list-item>
          </v-list>
          <v-divider></v-divider>
          <v-list nav dense rounded>
            <v-list-item
              v-for="(item, index) in menuAdmin"
              :key="index"
              link
              :to="item.link"
            >
              <v-list-item-action class="mx-2">
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>{{ item.name }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
          <v-divider></v-divider>
        </v-card>
      </v-navigation-drawer>
      <v-navigation-drawer
        v-else
        class="d-flex flex-column flex-shrink-0 sidebar position-fixed top-0"
        id="sidebar2"
        :style="{
          width: sidebarlg,
          height: '100vh',
          background: 'white',
          color: 'blue',
        }"
      >
        <a
          href="/"
          class="d-block p-3 link-dark text-decoration-none"
          title="Icon-only"
          data-bs-toggle="tooltip"
          data-bs-placement="right"
        >
          <i class="fa fa-home"></i>
          <span class="visually-hidden">Icon-only</span>
        </a>
        <v-list nav dense rounded>
          <li class="nav-item">
            <a
              href="/admin/users"
              class="nav-link active py-3 border-bottom rounded-0"
              aria-current="page"
              title="Home"
              data-bs-toggle="tooltip"
              data-bs-placement="right"
            >
              <v-list-item-icon class="circle">
                <v-icon>mdi-account-multiple</v-icon>
              </v-list-item-icon>
            </a>
          </li>
          <li class="nav-item">
            <a
              href="/admin/users"
              class="nav-link active py-3 border-bottom rounded-0"
              aria-current="page"
              title="Home"
              data-bs-toggle="tooltip"
              data-bs-placement="right"
            >
              <v-list-item-icon class="circle">
                <v-icon>mdi-account-multiple</v-icon>
              </v-list-item-icon>
            </a>
          </li>
        </v-list>
      </v-navigation-drawer>
    </div>
    <div v-if="user.user_type == 'student' || user.user_type == 'company'">
      <v-navigation-drawer
        class="d-flex flex-column flex-shrink-0 sidebar position-fixed top-0"
        id="sidebar1"
        :style="{
          width: sidebarlg,
          height: '100vh',
          color: 'white',
        }"
        v-if="sidebarstate"
      >
        <v-card class="mx-auto sidebar h-100" width="256" tile>
          <v-system-bar></v-system-bar>
          <div class="navbar-brand"><span class="bg-success">EtStudent</span></div>
          <v-divider></v-divider>
          <v-list>
            <v-list-item>
              <v-list-item-avatar>
                <v-img src="https://cdn.vuetifyjs.com/images/john.png"></v-img>
              </v-list-item-avatar>
            </v-list-item>
            <v-list-item link>
              <v-list-item-content>
                <v-list-item-title class="text-h6">
                  {{ user.pseudo }}
                </v-list-item-title>
                <v-list-item-subtitle>{{ user.email }}</v-list-item-subtitle>
              </v-list-item-content>

              <v-list-item-action>
                <v-icon>mdi-menu-down</v-icon>
              </v-list-item-action>
            </v-list-item>
          </v-list>
          <v-divider></v-divider>
          <v-list nav dense rounded>
            <v-list-item
              v-for="(item, index) in menuSpecial"
              :key="index"
              link
              :to="item.link"
            >
              <v-list-item-action>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>{{ item.name }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
          <v-divider></v-divider>
        </v-card>
      </v-navigation-drawer>
      <v-navigation-drawer
        v-else
        class="d-flex flex-column flex-shrink-0 sidebar position-fixed top-0"
        id="sidebar2"
        :style="{
          width: sidebarlg,
          height: '100vh',
          background: 'white',
          color: 'blue',
        }"
      >
        <a
          href="/"
          class="d-block p-3 link-dark text-decoration-none"
          title="Icon-only"
          data-bs-toggle="tooltip"
          data-bs-placement="right"
        >
          <i class="fa fa-home"></i>
          <span class="visually-hidden">Icon-only</span>
        </a>
        <v-list nav dense rounded>
          <li class="nav-item">
            <a
              href="/admin/users"
              class="nav-link active py-3 border-bottom rounded-0"
              aria-current="page"
              title="Home"
              data-bs-toggle="tooltip"
              data-bs-placement="right"
            >
              <v-list-item-icon class="circle">
                <v-icon>mdi-account-multiple</v-icon>
              </v-list-item-icon>
            </a>
          </li>
          <li class="nav-item">
            <a
              href="/admin/users"
              class="nav-link active py-3 border-bottom rounded-0"
              aria-current="page"
              title="Home"
              data-bs-toggle="tooltip"
              data-bs-placement="right"
            >
              <v-list-item-icon class="circle">
                <v-icon>mdi-account-multiple</v-icon>
              </v-list-item-icon>
            </a>
          </li>
        </v-list>
      </v-navigation-drawer>
    </div>
  </div>-->
<!--<div>
    <div>-->
<!-- <a-layout-sider
        class="sider"
        :style="{
          overflow: 'auto',
          height: '100vh',
          position: 'fixed',
          left: 0,
        }"
        :width="sidebarlg"
      >
        <div class="logo sider" />
        <v-main class="my-0 block-user sider">
          <v-card class="mx-auto block-user" tile>
            <v-system-bar></v-system-bar>
            <v-list class="sider">
              <v-list-item>
                <img
                  v-if="user.avatar != null"
                  :src="user.avatar.variants['small'].secure_url"
                  :height="user.avatar.variants['small'].height"
                  :width="user.avatar.variants['small'].width"
                />
                <v-icon dark v-else :size="50"> mdi-account-circle </v-icon>
              </v-list-item>

              <v-list-item link>
                <v-list-item-content v-if="sidebarstate == true">
                  <v-list-item-title class="text-h6"
                    ><span class="text-white">{{ user.pseudo }}</span></v-list-item-title
                  >
                  <v-list-item-subtitle>
                    <span class="text-white">{{ user.email }}</span></v-list-item-subtitle
                  >
                </v-list-item-content>

                <v-list-item-action>
                  <v-icon>mdi-menu-down</v-icon>
                </v-list-item-action>
              </v-list-item>
            </v-list>
          </v-card>
        </v-main>
        <a-menu mode="inline" :default-selected-keys="['1']" class="sider">
          <a-menu-item key="1" class="menu-sidebar">
            <router-link :to="{ path: '/admin/dashboard' }"
              ><a-icon type="user" />
              <span v-if="sidebarstate == true">Dashboard</span>
            </router-link>
          </a-menu-item>
          <a-menu-item key="2" class="menu-sidebar">
            <router-link :to="{ path: '/' }" tag="a"
              ><a-icon type="user" />
              <span v-if="sidebarstate == true">Contact</span></router-link
            >
          </a-menu-item>
          <a-menu-item key="3" class="menu-sidebar">
            <router-link :to="{ path: '/admin/users' }"
              ><a-icon type="user" />
              <span v-if="sidebarstate == true">Users</span></router-link
            >
          </a-menu-item>
          <a-menu-item key="4" class="menu-sidebar">
            <router-link :to="{ path: '/admin/categories' }"
              ><a-icon type="user" />
              <span v-if="sidebarstate == true">Catégories</span></router-link
            >
          </a-menu-item>
          <a-menu-item key="5" class="menu-sidebar">
            <router-link :to="{ path: '/admin/realisations' }"
              ><a-icon type="user" />
              <span v-if="sidebarstate == true">Réalisations</span></router-link
            >
          </a-menu-item>
        </a-menu>
      </a-layout-sider>-->
<!--<div
        class="sidebar-page"
        v-if="user.user_type == 'admin'"
        ;
        style="margin-top: 80px"
      >
        <section class="sidebar-layout">
          <b-sidebar type="is-light" :open="sidebarstate" :reduce="false">
            <div class="p-1">
              <div class="block">
                <img
                  src="https://raw.githubusercontent.com/buefy/buefy/dev/static/img/buefy-logo.png"
                  alt="Lightweight UI components for Vue.js based on Bulma"
                />
              </div>
              <b-menu class="is-custom-mobile">
                <b-menu-list label="Menu">
                  <b-menu-item icon="information-outline" label="Info"></b-menu-item>
                  <b-menu-item active expanded icon="settings" label="Administrator">
                    <b-menu-item icon="account" label="Users"></b-menu-item>
                    <b-menu-item icon="cellphone-link" label="Devices"></b-menu-item>
                    <b-menu-item
                      icon="cash-multiple"
                      label="Payments"
                      disabled
                    ></b-menu-item>
                  </b-menu-item>
                  <b-menu-item icon="account" label="My Account">
                    <b-menu-item icon="account-box" label="Account data"></b-menu-item>
                    <b-menu-item icon="home-account" label="Addresses"></b-menu-item>
                  </b-menu-item>
                </b-menu-list>
                <b-menu-list>
                  <b-menu-item label="Expo" icon="link"></b-menu-item>
                </b-menu-list>
                <b-menu-list label="Actions">
                  <b-menu-item icon="logout" label="Logout"></b-menu-item>
                </b-menu-list>
              </b-menu>
            </div>
          </b-sidebar>

          <div class="p-1">
            <b-field>
              <b-switch v-model="reduce">Reduced</b-switch>
            </b-field>
            <b-field>
              <b-switch v-model="expandOnHover">Expand on hover</b-switch>
            </b-field>
            <b-field>
              <b-switch v-model="expandWithDelay">Hover with delay</b-switch>
            </b-field>
            <b-field label="Mobile Layout">
              <b-select v-model="mobile">
                <option :value="null"></option>
                <option value="reduce">Reduced</option>
                <option value="hide">Hidden</option>
                <option value="fullwidth">Fullwidth</option>
              </b-select>
            </b-field>
          </div>
        </section>
      </div>
    </div>
    <div v-if="user.user_type == 'student'">
      <a-layout-sider
        class="sider"
        :style="{
          overflow: 'auto',
          height: '100vh',
          position: 'fixed',
          left: 0,
          background: '#90CAF9',
        }"
        :width="sidebarlg"
      >
        <div class="logo" />
        <v-main class="my-0 block-user sider">
          <v-card class="mx-auto block-user" tile>
            <v-system-bar></v-system-bar>
            <v-list class="block-user">
              <v-list-item>
                <img
                  v-if="user.avatar != null"
                  :src="user.avatar.variants['small'].secure_url"
                  :height="user.avatar.variants['small'].height"
                  :width="user.avatar.variants['small'].width"
                />
                <v-icon dark v-else :size="50"> mdi-account-circle </v-icon>
              </v-list-item>

              <v-list-item link>
                <v-list-item-content v-if="sidebarstate == true">
                  <v-list-item-title class="text-h6"
                    ><span class="text-white">{{ user.pseudo }}</span></v-list-item-title
                  >
                  <v-list-item-subtitle>
                    <span class="text-white">{{ user.email }}</span></v-list-item-subtitle
                  >
                </v-list-item-content>

                <v-list-item-action>
                  <v-icon>mdi-menu-down</v-icon>
                </v-list-item-action>
              </v-list-item>
            </v-list>
          </v-card>
        </v-main>
        <a-menu mode="inline" theme="dark" :default-selected-keys="['1']" class="sider">
          <a-menu-item key="1" class="menu-sidebar">
            <router-link :to="{ path: '' }"
              ><a-icon type="user" />
              <span v-if="sidebarstate == true">Dashboard</span>
            </router-link>
          </a-menu-item>
          <a-menu-item key="2">
            <router-link :to="{ path: '' }"
              ><a-icon type="user" />
              <span v-if="sidebarstate == true">Contact</span>
            </router-link>
          </a-menu-item>
          <a-menu-item key="3">
            <router-link :to="{ path: '/specialappli/realisations' }"
              ><a-icon type="user" />
              <span v-if="sidebarstate == true">Réalisations</span>
            </router-link>
          </a-menu-item>
          <a-menu-item key="4">
            <router-link :to="{ path: '/specialappli/userprofile' }"
              ><a-icon type="user" :size="25" />
              <span v-if="sidebarstate == true">Profile</span>
            </router-link>
          </a-menu-item>
        </a-menu>
      </a-layout-sider>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {};
  },
  props: ["sidebarlg", "sidebarstate", "user"],
  data: () => ({
    menuAdmin: [
      {
        name: "Home",
        link: "/admin/home",
        icon: "mdi-home",
      },
      {
        name: "Contact",
        link: "/",
        icon: "mdi-email",
      },
      {
        name: "Users",
        link: "/admin/users",
        icon: "mdi-account-multiple",
      },
      {
        name: "Categories",
        link: "/admin/categories",
        icon: "mdi-account-multiple",
      },
      {
        name: "Subcategories",
        link: "/admin/subcategories",
        icon: "mdi-account-multiple",
      },
      {
        name: "Realisations",
        link: "/admin/realisations",
        icon: "mdi-account-multiple",
      },
      {
        name: "UserProfile",
        link: "UserProfile",
        icon: "mdi-account-multiple",
      },
    ],
    menuSpecial: [
      {
        name: "Dashboard",
        link: "#",
        icon: "mdi-account-multiple",
      },
      {
        name: "Contact",
        link: "/",
        icon: "mdi-email",
      },
      {
        name: "Realisations",
        link: "/specialappli/realisations",
        icon: "mdi-account-multiple",
      },
      {
        name: "UserProfile",
        link: "UserProfile",
        icon: "mdi-account-multiple",
      },
    ],
    collapsed: true,
    expandOnHover: false,
    expandWithDelay: false,
    mobile: "reduce",
    // sidebarstateE: this.sidebarstate,
  }),
};
</script>
<style lang="scss" scoped>
$sidebarbgcolor: rgba(26, 26, 28, 0.3);
$grey: #9e9e9e;
$blueaccent4: #2962ff;
$bluelight3: #90caf9;
.sider {
  width: 100% !important;
  background-color: $bluelight3;
}

.menu-sidebar {
  margin: 6px auto !important;
  //margin: 4px 0px;
  width: 75%;
  border-radius: 3px;
  color: $grey;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2), 0 1px 1px rgba(0, 0, 0, 0.14),
    0 2px 1px -1px rgba(0, 0, 0, 0.12) !important;
}
.menu-sidebar :link {
  // margin: 1px auto !important;
  //margin: 4px 0px;
  width: 75%;
  border-radius: 3px;
  color: $grey;
}

.menu-sidebar:active {
  background: $blueaccent4;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2), 0 1px 1px rgba(0, 0, 0, 0.14),
    0 2px 1px -1px rgba(0, 0, 0, 0.12) !important;
}
.menu-sidebar:hover {
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2), 0 1px 1px rgba(0, 0, 0, 0.14),
    0 2px 1px -1px rgba(0, 0, 0, 0.12);
  border-radius: 3px;
}

.menu-sidebar:focus {
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2), 0 1px 1px rgba(0, 0, 0, 0.14),
    0 2px 1px -1px rgba(0, 0, 0, 0.12);
  border-radius: 3px;
}
.block-user {
  color: black;
  background: black;
}
/*#sidebar1,
#sidebar2,
.sidebar {
  //background: $sidebarbgcolor;
}*/

.p-1 {
  padding: 1em;
}
.sidebar-page {
  display: flex;
  flex-direction: column;
  width: 100%;
  min-height: 100%;
  // min-height: 100vh;
  .sidebar-layout {
    display: flex;
    flex-direction: row;
    min-height: 100%;
    // min-height: 100vh;
  }
}
@media screen and (max-width: 1023px) {
  .b-sidebar {
    .sidebar-content {
      &.is-mini-mobile {
        &:not(.is-mini-expand),
        &.is-mini-expand:not(:hover):not(.is-mini-delayed) {
          .menu-list {
            li {
              a {
                span:nth-child(2) {
                  display: none;
                }
              }
              ul {
                padding-left: 0;
                li {
                  a {
                    display: inline-block;
                  }
                }
              }
            }
          }
          .menu-label:not(:last-child) {
            margin-bottom: 0;
          }
        }
      }
    }
  }
}
@media screen and (min-width: 1024px) {
  .b-sidebar {
    .sidebar-content {
      &.is-mini {
        &:not(.is-mini-expand),
        &.is-mini-expand:not(:hover):not(.is-mini-delayed) {
          .menu-list {
            li {
              a {
                span:nth-child(2) {
                  display: none;
                }
              }
              ul {
                padding-left: 0;
                li {
                  a {
                    display: inline-block;
                  }
                }
              }
            }
          }
          .menu-label:not(:last-child) {
            margin-bottom: 0;
          }
        }
      }
    }
  }
}
.is-mini-expand {
  .menu-list a {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}
</style>-->
<template>
  <div>
    <!-- <b-sidebar :open="sidebarstate" id="sidebar1" class="bg-danger">
      <div class="m-5">
        <v-btn @click="changeSidebar"> <v-icon>mdi-list</v-icon></v-btn>
        <b-menu class="is-custom-mobile mt-3">
          <b-menu-list>
            <b-menu-item
              position="fixed"
              tag="router-link"
              label="Dashboard"
              :to="{ path: '/admin/dashboard' }"
              icon="account"
              :class="{
                active: cle == 1 ? true : false,
                elevation_3: cle == 1 ? true : false,
              }"
              class="m-2 menu-item"
            >
            </b-menu-item>
            <b-menu-item
              label="Contact"
              :to="{ path: '/admin/dashboard' }"
              icon="account"
              class="m-2 menu-item"
              tag="router-link"
              :class="{
                active: cle == 2 ? true : false,
                elevation_3: cle == 2 ? true : false,
              }"
            >
            </b-menu-item>
            <b-menu-item
              :to="{ path: '/admin/users' }"
              tag="router-link"
              label="Users"
              icon="account"
              class="m-2 menu-item"
              :class="{
                active: cle == 3 ? true : false,
                elevation_3: cle == 3 ? true : false,
              }"
            >
            </b-menu-item>
            <b-menu-item
              tag="router-link"
              :to="{ path: '/admin/categories' }"
              label="Catégories"
              icon="account"
              class="m-2 menu-item"
              :class="{
                active: cle == 4 ? true : false,
                elevation_3: cle == 4 ? true : false,
              }"
            >
            </b-menu-item>
            <b-menu-item
              tag="router-link"
              :to="{ path: '/admin/subcategories' }"
              label="Sous- catégorie"
              icon="account"
              class="m-2 menu-item"
              :class="{
                active: cle == 5 ? true : false,
                elevation_3: cle == 5 ? true : false,
              }"
            >
            </b-menu-item>
          </b-menu-list>
        </b-menu>
      </div>
    </b-sidebar>

    <b-sidebar :open="sidebarstate" id="sidebar1" class="bg-danger">
      <div class="m-5">
        <v-btn @click="changeSidebar"> <v-icon>mdi-person</v-icon></v-btn>
        <b-menu class="is-custom-mobile mt-3">
          <b-menu-list>
            <b-menu-item
              tag="router-link"
              label="Dashboard"
              :to="{ path: '/admin/dashboard' }"
              icon="account"
              :class="{
                active: cle == 1 ? true : false,
                elevation_3: cle == 1 ? true : false,
              }"
              class="m-2 menu-item"
            >
            </b-menu-item>
            <b-menu-item
              label="Contact"
              :to="{ path: '/admin/dashboard' }"
              icon="account"
              class="m-2 menu-item"
              tag="router-link"
              :class="{
                active: cle == 2 ? true : false,
                elevation_3: cle == 2 ? true : false,
              }"
            >
            </b-menu-item>
            <b-menu-item
              :to="{ path: '/admin/users' }"
              tag="router-link"
              label="Users"
              icon="account"
              class="m-2 menu-item"
              :class="{
                active: cle == 3 ? true : false,
                elevation_3: cle == 3 ? true : false,
              }"
            >
            </b-menu-item>
            <b-menu-item
              tag="router-link"
              :to="{ path: '/admin/categories' }"
              label="Catégories"
              icon="account"
              class="m-2 menu-item"
              :class="{
                active: cle == 4 ? true : false,
                elevation_3: cle == 4 ? true : false,
              }"
            >
            </b-menu-item>
            <b-menu-item
              tag="router-link"
              :to="{ path: '/specialappli/realisations' }"
              label="Réalisations"
              icon="account"
              class="m-2 menu-item"
              :class="{
                active: cle == 5 ? true : false,
                elevation_3: cle == 5 ? true : false,
              }"
            >
            </b-menu-item>
          </b-menu-list>
        </b-menu>
      </div>
    </b-sidebar>-->

    <a-layout-sider
      v-if="user.user_type == 'student'"
      theme="light"
      v-model="collapsed"
      :trigger="null"
      collapsible
      breakpoint="lg"
      class="h-100 bttn-primary"
      style="position: fixed"
    >
      <div class="w-100 position-relative h-100">
        <v-btn
          @click="changeSidebar"
          color="blue"
          medium
          shaped
          class="position-absolute"
          style="
            cursor: pointer;
            z-index: 500;
            top: 40%;
            right: 0px;
            border-radius: 30px 0px 0px 30px;
            width: 40px;
            height: 40px;
            color: inherit;
          "
        >
          <span
            v-if="collapsed == false"
            class="material-icons ms-3"
            style="font-size: 15px"
          >
            arrow_back_ios
          </span>
          <span v-else class="material-icons" style="font-size: 15px">
            arrow_forward_ios
          </span>
        </v-btn>
        <a-menu
          theme="light"
          mode="inline"
          class="w-100"
          :default-selected-keys="[cle]"
          style="margin-top: 25px"
        >
          <a-menu-item
            key="1"
            :class="{
              'elevation_2 text-muted rounded menu-ele': cle == 1 ? true : false,
            }"
          >
            <router-link
              :to="{
                path: '/realisationsStudents',
                /*query: {
                  search: search || '',
                },*/
              }"
            >
              <a-icon type="project" />
              <span>Projets étudiants</span></router-link
            >
            <b-navbar-item>
              <router-link :to="{ path: '/list/realisations' }">
                <span style="color: black">Mes projets</span></router-link
              >
            </b-navbar-item>
          </a-menu-item>
          <b-navbar-item>
            <router-link :to="{ path: '/list/realisations' }">
              <span style="color: black">Mes projets</span></router-link
            >
          </b-navbar-item>
          <a-sub-menu key="sub1" :expanded="true">
            <span slot="title"
              ><a-icon type="build" v-if="cle == 2 || cle == 3" style="color: #42a5f5" />
              <a-icon type="build" v-else />
              <span v-if="cle == 2 || cle == 3" style="color: #42a5f5">Réalisations</span>
              <span v-else>Réalisations</span></span
            >
            <a-menu-item
              key="2"
              :class="{
                'elevation_2 text-muted rounded menu-ele': cle == 2 ? true : false,
              }"
            >
              <router-link :to="{ path: '/create/realisations' }">
                <a-icon type="plus" />
                <span>Créer</span></router-link
              >
            </a-menu-item>
            <a-menu-item
              key="3"
              :class="{
                'elevation_2 text-muted rounded menu-ele': cle == 3 ? true : false,
              }"
            >
              <router-link :to="{ path: '/list/realisations' }">
                <a-icon type="unordered-list" />
                <span>Liste</span></router-link
              ></a-menu-item
            >
          </a-sub-menu>
          <a-sub-menu key="sub2">
            <span slot="title"> <a-icon type="user" /><span class="">Compte</span></span>
            <a-menu-item key="4">
              <router-link :to="{ path: '/userprofile' }" tag="a">
                <a-icon type="profile" />
                <span>Profile</span></router-link
              >
            </a-menu-item>
            <a-menu-item key="5">
              <router-link :to="{ path: '/userprofile' }" tag="a">
                <a-icon type="lock" />
                <span>Mot de passe</span></router-link
              >
              >
            </a-menu-item>
          </a-sub-menu>
          <!--<a-menu-item key="4">
          <router-link :to="{ path: '/create/realisations' }" tag="a"
            ><a-icon type="user" /> <span>nathet</span></router-link
          >
        </a-menu-item>-->
          <!-- <a-sub-menu key="sub2">
          <span slot="title"><a-icon type="appstore" /><span>Navigation Two</span></span>
          <a-menu-item key="9"> Option 9 </a-menu-item>
          <a-menu-item key="10"> Option 10 </a-menu-item>
          <a-sub-menu key="sub3" title="Submenu">
            <a-menu-item key="11"> Option 11 </a-menu-item>
            <a-menu-item key="12"> Option 12 </a-menu-item>
          </a-sub-menu>
        </a-sub-menu>-->
        </a-menu>
      </div>
    </a-layout-sider>

    <a-layout-sider
      v-else-if="user.user_type == 'admin'"
      theme="dark"
      v-model="collapsed"
      :trigger="null"
      collapsible
      breakpoint="lg"
      :reverseArrow="true"
      class="position-fixed w-100 h-100"
      style="position: fixed"
    >
      <div class="w-100 position-sctiky h-100">
        <v-btn
          @click="changeSidebar"
          color="blue"
          medium
          shaped
          class="position-absolute"
          style="
            cursor: pointer;
            z-index: 500;
            top: 40%;
            right: 0px;
            border-radius: 60px 0px 0px 60px;
            width: 60px;
            height: 50px;
          "
        >
          <span v-if="collapsed == false" class="material-icons ms-3">
            arrow_back_ios
          </span>
          <span v-else class="material-icons ms-2"> arrow_forward_ios </span>
        </v-btn>
        <a-menu theme="dark" :default-selected-keys="['1']" mode="inline">
          <a-menu-item key="1" class="menu-sidebar">
            <router-link :to="{ path: '/admin/dashboard' }"
              ><a-icon type="user" />
              <span>Dashboard</span>
            </router-link>
          </a-menu-item>
          <a-menu-item key="2" class="menu-sidebar">
            <router-link :to="{ path: '/realisationsStudents' }" tag="a"
              ><a-icon type="user" /> <span>Contact</span></router-link
            >
          </a-menu-item>
          <a-menu-item key="3" class="menu-sidebar">
            <router-link :to="{ path: '/admin/users' }"
              ><a-icon type="user" /> <span>Users</span></router-link
            >
          </a-menu-item>
          <a-menu-item key="4" class="menu-sidebar">
            <router-link :to="{ path: '/admin/categories' }"
              ><a-icon type="user" /> <span>Catégories</span></router-link
            >
          </a-menu-item>
          <a-sub-menu key="sub1">
            <span slot="title"
              ><a-icon type="mail" /><span>Gestion réalisations</span></span
            >
            <a-menu-item key="5" class="menu-sidebar">
              <router-link :to="{ path: '/admin/realisations' }"
                ><a-icon type="user" /> <span>Réalisations</span></router-link
              >
            </a-menu-item>
            <a-menu-item key="6"> Option 6 </a-menu-item>
            <a-menu-item key="7"> Option 7 </a-menu-item>
            <a-menu-item key="8"> Option 8 </a-menu-item>
          </a-sub-menu>
        </a-menu>
      </div>
    </a-layout-sider>
    <a-layout-sider
      v-else
      theme="light"
      v-model="collapsed"
      :trigger="null"
      collapsible
      breakpoint="lg"
      class="h-100 bttn-primary"
      style="position: fixed"
      :width="width"
    >
      <div class="w-100 position-relative h-100">
        <v-btn
          @click="changeSidebar"
          color="blue"
          medium
          shaped
          class="position-absolute"
          style="
            cursor: pointer;
            z-index: 500;
            top: 40%;
            right: 0px;
            border-radius: 60px 0px 0px 60px;
            width: 60px;
            height: 50px;
          "
        >
          <span v-if="collapsed == false" class="material-icons ms-3">
            arrow_back_ios
          </span>
          <span v-else class="material-icons ms-2"> arrow_forward_ios </span>
        </v-btn>
        <a-menu theme="light" mode="inline" :default-selected-keys="['1']" class="w-100">
          <a-menu-item key="1">
            <router-link :to="{ path: '/realisationsStudents' }" tag="div">
              <a-icon type="project" />
              <span>Projets étudiants</span></router-link
            >
          </a-menu-item>
          <a-menu-item key="1">
            <router-link :to="{ path: '/realisationsStudents' }" tag="div">
              <a-icon type="project" />
              <span>Entreprises</span></router-link
            >
          </a-menu-item>
          <a-sub-menu key="sub2">
            <span slot="title"> <a-icon type="user" /><span class="">Compte</span></span>
            <a-menu-item key="4">
              <router-link :to="{ path: '/userprofile' }" tag="div">
                <a-icon type="profile" />
                <span>Profile</span></router-link
              >
            </a-menu-item>
            <a-menu-item key="5">
              <router-link :to="{ path: '/userprofile' }" tag="div">
                <a-icon type="lock" />
                <span>Mot de passe</span></router-link
              >
              >
            </a-menu-item>
          </a-sub-menu>
        </a-menu>
      </div>
    </a-layout-sider>
  </div>
</template>

<script>
export default {
  props: ["sidebarlg", "collapsed", "user", "cle", "search"],
  data() {
    return {
      key: null,
      /*expandOnHover: false,
      expandWithDelay: false,
      mobile: "reduce",
      reduce: false,*/
    };
  },
  /*watch: {
    search() {
      console.log("verra");
      this.$router.push({
        name: "realisationprinc",
        meta: {
          middleware: "guest",
        },
        query: {
          search: this.search,
        },
      });
    },
  },*/
  methods: {
    /*changeSidebar() {
      console.log("side");
      this.$emit("change-sidebar");
    },*/
    changeSidebar() {
      //this.collapsed = !this.collapsed;
      console.log("changer oooh");
      this.$emit("change-sidebar");
    },
    selectMenu(item, key, selectedKeys) {
      this.key = key;
    },
  },
};
</script>

<style lang="scss" scoped>
.menu-ele {
  border-right-color: #42a5f5;
  background-color: #e3f2fd;
  border-right-style: solid;
  border-right-width: 3px;
}
/*.router-link-active {
  background: green;
  color: red;
}*/
/*$bluedarken4: #0d47a1;
.sidebar {
  background: blue;
  // position: fixed;
}*/ /*
.position-relative {
  position: relative;
}
.p-1 {
  padding: 1em;
}
.sidebar-page {
  // margin-top: 80px !important;
  display: flex;
  flex-direction: column;
  max-width: 260px;
  min-height: 100%;
  margin-right: 6px;
  // min-height: 100vh;
  .sidebar-layout {
    display: flex;
    flex-direction: row;
    min-height: 100%;
    // min-height: 100vh;
  }
}*/

/*.menu-list :focus {
  //background: #1565c0;
  li {
    background: #82b1ff;
    box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px rgba(0, 0, 0, 0.14),
      0 1px 10px rgba(0, 0, 0, 0.12);
    border-radius: 5px;
    a {
      color: white;
    }
  }
}*/

/*.active :hover {
  box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px rgba(0, 0, 0, 0.14),
    0 1px 10px rgba(0, 0, 0, 0.12);
  border-radius: 5px;
  background: #82b1ff;
  color: white;
}
.active :focus {
  box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px rgba(0, 0, 0, 0.14),
    0 1px 10px rgba(0, 0, 0, 0.12);
  border-radius: 5px;
  background: $bluedarken4;
  color: white;
}
.active :active {
  box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px rgba(0, 0, 0, 0.14),
    0 1px 10px rgba(0, 0, 0, 0.12);
  border-radius: 5px;
  background: $bluedarken4;
}*/
/*.active {
  box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px rgba(0, 0, 0, 0.14),
    0 1px 10px rgba(0, 0, 0, 0.12);
  border-radius: 5px;
  background: $bluedarken4;
  color: white !important;
  a {
    color: white !important;
  }
}
*/
/*.menu-list :hover {
  //background: #1565c0;
  li {
    background: #82b1ff;
    box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px rgba(0, 0, 0, 0.14),
      0 1px 10px rgba(0, 0, 0, 0.12);
    border-radius: 5px;
    a {
      color: white;
    }
  }
}*/
/*@media screen and (max-width: 1023px) {
  .b-sidebar {
    width: 80px;
  }
  .b-sidebar {
    .sidebar-content {
      &.is-mini-mobile {
        &:not(.is-mini-expand),
        &.is-mini-expand:not(:hover):not(.is-mini-delayed) {
          .menu-list {
            li {
              a {
                span:nth-child(2) {
                  display: none;
                }
              }
              ul {
                padding-left: 0;
                li {
                  a {
                    display: inline-block;
                  }
                }
              }
            }
          }
          .menu-label:not(:last-child) {
            margin-bottom: 0;
          }
        }
      }
    }
  }
}
@media screen and (min-width: 1024px) {
  .b-sidebar {
    .sidebar-content {
      &.is-mini {
        &:not(.is-mini-expand),
        &.is-mini-expand:not(:hover):not(.is-mini-delayed) {
          .menu-list {
            li {
              a {
                span:nth-child(2) {
                  display: none;
                }
              }
              ul {
                padding-left: 0;
                li {
                  a {
                    display: inline-block;
                  }
                }
              }
            }
          }
          .menu-label:not(:last-child) {
            margin-bottom: 0;
          }
        }
      }
    }
  }
}
.is-mini-expand {
  .menu-list a {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}*/
</style>
