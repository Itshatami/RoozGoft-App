<template>
  <q-page padding>
    <!-- content -->
    <main
      class="fullscreen row items-center justify-center"
      style="background-color: rgb(41, 112, 160)"
    >
      <div
        class="col-4 q-py-xl q-px-xl"
        style="
          display: flex;
          flex-direction: column;
          align-items: center;
          border-radius: 15px;
          position: relative;
          background-color: white !important;
          box-shadow: 0px 0px 50px 0px rgba(0, 0, 0, 0.72);
        "
      >
        <!-- avatar -->
        <q-avatar class="absolute" style="left: 10px; top: 10px" size="30px">
          <q-img src="public/RG.png" />
        </q-avatar>
        <!-- brand -->
        <h4 class="text-h3 q-my-md">RoozGoft</h4>
        <h4 class="text-body1 q-my-md">خوش آمدید</h4>
        <div class="q-gutter-md full-width">
          <!-- username -->
          <q-input
            v-model="username"
            label="Username"
            hint="Enter Your Username"
            lazy-rules
            :ref="usernameRef"
            :rules="[
              (val) => (val && val.length > 0) || 'Please type something',
            ]"
          />
          <!-- email -->
          <q-input
            type="email"
            v-model="email"
            label="Email *"
            hint="Example@info.com"
            lazy-rules
            :ref="emailRef"
            :rules="[
              (val) => (val && val.length > 0) || 'Please type something',
            ]"
          />
          <!-- password -->
          <q-input
            type="number"
            v-model="password"
            label="Password"
            lazy-rules
            :ref="passwordRef"
            :rules="[
              (val) => (val !== null && val !== '') || 'Please type your age',
              (val) => (val > 0 && val < 100) || 'Please type a real age',
            ]"
          />
          <!-- confirm-password -->
          <q-input
            type="number"
            v-model="confirmPassword"
            label="Confirm Password"
            lazy-rules
            :ref="confirmPasswordRef"
            :rules="[
              (val) => (val !== null && val !== '') || 'Please type your age',
              (val) => (val > 0 && val < 100) || 'Please type a real age',
            ]"
          />

          <div style="display: flex; justify-content: space-between">
            <q-checkbox v-model="terms" label="با شرایط و قوانین موافقم" />
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
              label="ثبت نام"
              type="submit"
              color="primary"
              class="full-width q-py-sm"
            />
          </div>
        </div>
      </div>
      <!-- right -->
      <div
        class="col-3"
        style="
          background-color: white !important;
          border-radius: 0px 15px 15px 0px;
          box-shadow: 27px 0px 50px 2px rgba(0, 0, 0, 0.4);
        "
      >
        <swiper
          :spaceBetween="30"
          :centeredSlides="true"
          :autoplay="{
            delay: 1800,
            disableOnInteraction: false,
          }"
          :pagination="{
            clickable: true,
          }"
          :modules="modules"
          class="mySwiper"
        >
          <swiper-slide class="text-center">
            <q-img src="public/avatar.png" style="width: 60%" />
            <div
              class="q-py-lg"
              style="
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
              "
            >
              <h5 class="text-bold q-my-md">حس خوب با برنامه بودن</h5>
              <p class="q-mb-lg">روتین های هفتگی و روزانه</p>
            </div>
          </swiper-slide>
          <swiper-slide class="text-center">
            <q-img src="public/calendar.png" style="width: 60%" />
            <div
              class="q-py-lg"
              style="
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
              "
            >
              <h5 class="text-bold q-my-md">حس خوب با برنامه بودن</h5>
              <p class="q-mb-lg">روتین های هفتگی و روزانه</p>
            </div>
          </swiper-slide>
          <swiper-slide class="text-center">
            <q-img src="public/video.png" style="width: 60%" />
            <div
              class="q-py-lg"
              style="
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
              "
            >
              <h5 class="text-bold q-my-md">حس خوب با برنامه بودن</h5>
              <p class="q-mb-lg">روتین های هفتگی و روزانه</p>
            </div>
          </swiper-slide>
          <swiper-slide class="text-center">
            <q-img src="public/support.png" style="width: 60%" />
            <div
              class="q-py-lg"
              style="
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
              "
            >
              <h5 class="text-bold q-my-md">حس خوب با برنامه بودن</h5>
              <p class="q-mb-lg">روتین های هفتگی و روزانه</p>
            </div>
          </swiper-slide>
        </swiper>
      </div>
    </main>
  </q-page>
</template>

<script>
import { ref , toRefs } from "vue";
import { useQuasar } from "quasar";
import { api } from "src/boot/axios.js";
import { useRouter } from "vue-router";

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";

import "swiper/css/pagination";
import "swiper/css/navigation";

// import "./style.css";

// import required modules
import { Autoplay, Pagination, Navigation } from "swiper/modules";

export default {
  // name: 'PageName',
  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {
    const q = useQuasar();
    const router = useRouter();
    const username = ref("");
    const usernameRef = ref(null);
    const email = ref("");
    const emailRef = ref(null);
    const password = ref("");
    const passwordRef = ref(null);
    const confirmPassword = ref("");
    const confirmPasswordRef = ref(null);
    const terms = ref(false);

    function register(evt) {
      usernameRef.value.validate();
      emailRef.value.validate();
      passwordRef.value.validate();
      confirmPasswordRef.value.validate();

      if (
        usernameRef.value.hasError &&
        emailRef.value.hasError &&
        passwordRef.value.hasError &&
        confirmPasswordRef.value.hasError
      ) {
        q.notify({
          message: "اطلاعات نادرست وارد شدند!",
          color: "red",
          position: "top",
        });
      } else if (password.value !== confirmPassword.value) {
        q.notify({
          message: "تکرار پسوورد اشتباه است!",
          color: "red",
          position: "top",
        });
      } else {
        api.post("api/auth/register", {
          username: username.value,
          email: email.value,
          password: password.value,
        }).then(res => {
          console.log(res.data.status);
          if (res.data.status) {
            router.push("/")
          }
        });
      }
    }

    return {
      username,
      usernameRef,
      email,
      emailRef,
      password,
      passwordRef,
      confirmPassword,
      confirmPasswordRef,
      terms,
      register,
      modules: [Autoplay, Pagination, Navigation],
    };
  },
};
</script>
