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
        <q-form
          @submit="onSubmit"
          @reset="onReset"
          class="q-gutter-md full-width"
        >
          <!-- username -->
          <q-input
            v-model="username"
            label="Username"
            hint="Enter Your Username"
            lazy-rules
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
        </q-form>
      </div>
      <!-- right -->
      <div
        class="col-3"
        style="
          background-color: white !important;
          border-radius: 0px 15px 15px 0px;
          box-shadow: 27px 0px 50px 2px rgba(0, 0, 0, 0.40);
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
import { ref } from "vue";
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
    const username = ref("");
    const email = ref("");
    const password = ref("");
    const confirmPassword = ref("");
    const terms = ref(false);

    return {
      username,
      email,
      password,
      confirmPassword,
      terms,
      modules: [Autoplay, Pagination, Navigation],
    };
  },
};
</script>
