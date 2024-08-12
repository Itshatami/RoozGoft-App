<template>
  <q-page
    padding
    class="flex flex-center"
    style="max-width: 1200px; margin: 0px auto"
  >
    <!-- content -->
    <div
      class="q-pa-md text-center q-gutter-y-md"
      style="border: 1px solid gray; border-radius: 10px"
    >
      <!-- <div v-if="user.profle.image">
        <q-img :src="'http://127.0.0.1:8000/storage/profiles/' + user.image" />
      </div> -->
      <div>
        <q-img src="avatar.png" width="120px" />
      </div>
      <q-input
        outlined
        standout="bg-teal text-white"
        v-model="username"
        label="نام کاربری"
      />
      <q-input
        outlined
        standout="bg-teal text-white"
        v-model="email"
        label="ایمیل"
      />
    </div>
  </q-page>
</template>

<script>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { api } from "src/boot/axios.js";
import { useQuasar } from "quasar";

export default {
  name: "ProfilePage",

  setup() {
    const router = useRouter();
    const route = useRoute();
    const q = useQuasar();
    const user = ref();
    const userId = ref(null);
    const username = ref(null);
    const email = ref(null);

    onMounted(() => {
      fetchUser();
    });

    function fetchUser() {
      api
        .get("api/user")
        .then((res) => {
          console.log(res.data);
          if (res.data.status) {
            user.value = res.data.user;
            userId.value = res.data.user.id;
            username.value = res.data.user.username;
            email.value = res.data.user.email;
          }
        })
        .catch((err) => {
          q.notify({
            color: "red",
            position: "top",
            message: err.response.data.message,
          });
        });
    }

    return { user, username, email };
  },
};
</script>
