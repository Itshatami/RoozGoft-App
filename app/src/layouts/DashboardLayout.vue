<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated class="bg-white text-dark">
      <q-toolbar>
        <q-toolbar-title>
          <q-img src="dashboardLogo.png" width="100px" />
        </q-toolbar-title>
        <div class="q-mr-sm" style="font-size: 21px">داشبورد روزگفت</div>
        <q-btn dense flat round icon="menu" @click="toggleRightDrawer" />
      </q-toolbar>
    </q-header>

    <q-drawer show-if-above v-model="rightDrawerOpen" side="right" bordered>
      <!-- drawer content -->
      <!-- user info -->
      <div class="row">
        <div
          v-if="userData"
          class="col-12 text-white q-py-md"
          style="
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-bottom: 1px solid gray;
            background-color: #1976d2;
          "
        >
        <q-avatar class="q-mt-sm" size="80px">
            <q-img src="avatar.png" />
          </q-avatar>
          <div class="text-center">
            <p class="text-body1 q-my-sm">
              {{ userData.username }}
              <span>: نام کاربری</span>
            </p>
  
            <p class="text-body1 q-mb-sm">
              {{ userData.roles[0].role }}
              <span>: نقش </span>
            </p>
          </div>

        
        </div>
        <!-- fetch userData fails -->
        <div
          v-else
          class="full-width flex justify-center items-center"
          style="height: 200px"
        >
          <q-spinner-hourglass color="purple" size="4em" />
        </div>
        <!-- links -->
        <div class="col-12 q-gutter-y-sm q-pt-md q-px-sm">
          <q-btn
            @click="router.push('categories')"
            class="full-width q-py-md"
            icon-right="category"
            style="background: #1976d2; color: white"
            label="دسته بندی ها"
          />
          <q-btn
            @click="router.push('dashboard/articles')"
            class="full-width q-py-md"
            icon-right="article"
            style="background: #1976d2; color: white"
            label="مقاله ها"
          />
          <q-btn
            @click="router.push('dashboard/posts')"
            class="full-width q-py-md"
            icon-right="message"
            style="background: #1976d2; color: white"
            label="پست ها"
          />
          <q-btn
            @click="router.push('dashboard/users')"
            class="full-width q-py-md"
            icon-right="people"
            style="background: #1976d2; color: white"
            label="کاربران"
          />
        </div>
      </div>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { ref, onMounted } from "vue";
import { api } from "src/boot/axios.js";
import { useQuasar } from "quasar";
import { useRouter } from "vue-router";

export default {
  setup() {
    const q = useQuasar();
    const router = useRouter();
    const rightDrawerOpen = ref(false);
    const userData = ref(null);

    onMounted(() => {
      fetchUser();
    });

    function fetchUser() {
      api
        .get("/api/admin/dashboard")
        .then((res) => {
          console.log(res.data);
          if (res.data.status) {
            userData.value = res.data.user;
            console.log(userData.value);
          }
        })
        .catch((err) => {
          console.log(err);
          q.notify({
            color: "red",
            position: "top",
            message: err.message,
          });
        });
    }

    return {
      rightDrawerOpen,
      toggleRightDrawer() {
        rightDrawerOpen.value = !rightDrawerOpen.value;
      },
      userData,
      router,
    };
  },
};
</script>
