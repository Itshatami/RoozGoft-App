<template>
  <q-page padding>
    <!-- content -->
    <main
      class="fullscreen row items-center justify-center"
      style="background-color: rgb(77, 168, 190)"
    >
      <div
        class="col-4 q-py-xl q-px-xl"
        style="
          z-index: 99;
          height: 550px;
          display: flex;
          flex-direction: column;
          align-items: center;
          border-radius: 10px;
          position: relative;
          background-color: white !important;
          box-shadow: -16px 0px 31px -2px rgba(0, 0, 0, 0.59);
        "
      >
        <!-- avatar -->
        <q-avatar class="absolute" style="left: 10px; top: 10px" size="30px">
          <q-img src="public/RG.png" />
        </q-avatar>
        <!-- brand -->
        <h4 class="text-h3 q-my-md">Admin</h4>
        <h4 class="text-body1 q-my-md">خوش آمدید</h4>
        <div class="q-gutter-md full-width">
          <!-- username -->
          <q-input
            v-model="username"
            label="نام کاربری"
            lazy-rules
            ref="usernameRef"
            :rules="[(val) => (val && val.length > 0) || 'لطفا خالی نذارید']"
          />

          <!-- password -->
          <q-input
            v-model="password"
            label="رمز عبور"
            :type="isPwd ? 'password' : 'text'"
            lazy-rules
            ref="passwordRef"
            :rules="[(val) => (val && val.length > 0) || 'لطفا خالی نذارید']"
          >
            <template v-slot:append>
              <q-icon
                :name="isPwd ? 'visibility_off' : 'visibility'"
                class="cursor-pointer"
                @click="isPwd = !isPwd"
              />
            </template>
          </q-input>

          <div style="display: flex; justify-content: space-between">
            <q-checkbox v-model="remeber" label="مرا بخاطر بسپار" />
            <q-btn
              label="تنظیم مجدد"
              type="reset"
              color="primary"
              flat
              class="q-ml-sm"
            />
          </div>

          <div>
            <q-btn
              label="ورود"
              @click="login"
              color="primary"
              class="full-width q-py-sm"
            />
          </div>
        </div>
      </div>
      <!-- right -->
      <div
        class="col-3 flex justify-center items-center"
        style="
          position: relative;
          left: -20px;
          height: 550px;
          background-color: rgb(197, 120, 33) !important;
          border-radius: 0px 10px 10px 0px;
          box-shadow: 27px 0px 50px 2px rgba(0, 0, 0, 0.4);
        "
      >
        <h4>ادمین</h4>
      </div>
    </main>
  </q-page>
</template>

<script>
import { ref } from "vue";
import { useQuasar } from "quasar";
import { api } from "src/boot/axios.js";
import { useRouter } from "vue-router";

export default {
  // name: 'LoginAdminPage',
  components: {},
  setup() {
    const q = useQuasar();
    const router = useRouter();
    const username = ref("");
    const usernameRef = ref(null);
    const password = ref("");
    const passwordRef = ref(null);
    const remeber = ref(false);

    function login() {
      usernameRef.value.validate();
      passwordRef.value.validate();

      if (usernameRef.value.hasError || passwordRef.value.hasError) {
        q.notify({
          message: "اطلاعات نادرست وارد شدند!",
          color: "red",
          position: "top",
        });
      } else {
        api
          .post("api/admin/login", {
            username: username.value,
            password: password.value,
          })
          .then((res) => {
            // console.log(res.data.status);
            if (res.status) {
              console.log(res.data);
              q.cookies.set("token", res.data.token, { expires: "1d" });
              router.push("/admin/dashboard");
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
    }

    return {
      username,
      usernameRef,
      password,
      passwordRef,
      remeber,
      login,
      isPwd: ref(true),
    };
  },
};
</script>
