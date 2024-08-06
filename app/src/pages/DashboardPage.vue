<template>
  <q-page padding style="max-width: 1200px; margin: 0px auto">
    <!-- content -->
    <!-- first category -->
    <section class="row q-py-lg">
      <!-- billboard -->
      <div
        class="col-12 flex justify-between q-pa-lg q-mb-md"
        style="
          background: linear-gradient(
            90deg,
            rgba(255, 71, 96, 1) 0%,
            rgba(97, 4, 4, 1) 100%
          );
          border-radius: 15px;
        "
      >
        
        <div>
          <q-icon size="50px" name="dashboard" />
        </div>
       
        <div class="text-white" style="direction: rtl">
          <h6 class="q-my-sm">تمامی دسته بندی ها</h6>
        </div>
      </div>
      <swiper
        v-if="categories"
        :slidesPerView="3"
        :spaceBetween="30"
        :loop="true"
        :autoplay="{
          delay: 1500,
          disableOnInteraction: false,
        }"
      
        :navigation="true"
        :modules="modules"
        class="mySwiper"
      >
        <swiper-slide v-for="category in categories" :key="category.id">
          <div
            class="q-pa-sm q-gutter-x-sm"
            style="
              display: flex;
              justify-content: center;
              align-items: center;
              background-color: rgb(250, 118, 118);
              border-radius: 10px;
            "
          >
            <div style="direction: rtl">
              <p
                style="font-weight: 600; font-family: kalameh; font-size: 16px"
              >
                {{ category.displayName }}
              </p>
              <p class="text-body2 q-mb-none">
                {{ category.description.substring(0, 50) + "..." }}
              </p>
            </div>
            <q-img
              :src="
                'http://127.0.0.1:8000/storage/images/categories/' +
                category.image
              "
              style="
                max-width: 100px;
                max-height: 80px;
                object-fit: inherit !important;
              "
            />
          </div>
        </swiper-slide>
      </swiper>
      <div v-else class="text-center">no category yet!</div>
      <!-- articles -->
    </section>

    <!-- second category -->
    <section class="row">
       <!-- billboard -->
       <div
        class="col-12 flex justify-between q-pa-lg q-mb-md"
        style="
          background: linear-gradient(
            90deg,
            #e68200 0%,
            #ff8d22 100%
          );
          border-radius: 15px;
        "
      >
        
        <div>
          <q-icon size="50px" name="article" />
        </div>
       
        <div class="text-white" style="direction: rtl">
          <h6 class="q-my-sm">تمامی مقاله ها</h6>
        </div>
      </div>
      <!-- articles -->
      <div
        class="q-py-md full-width row justify-between"
        style="direction: rtl"
      >
        <div
          class="my-card q-pa-lg"
          style="
            width: 24%;
            background-color: rgb(238, 211, 179);
            border-radius: 15px;
          "
        >
          <div class="flex justify-center">
            <img src="sleep.png" width="100px" alt="sleep" class="q-mb-md" />
          </div>
          <div>
            <span
              class="q-mt-lg"
              style="
                padding: 6px;
                background-color: rgb(255, 255, 255);
                border-radius: 15px;
                font-size: 8px;
                font-weight: 900;
              "
              >توسعه شخصیت فردی</span
            >
            <h5 class="q-my-sm" style="font-weight: 900">خواب</h5>
            <p>نمیتوانید بخوابید و ساعت خوابتان بهم ریخته ؟</p>
          </div>
        </div>

        <div
          class="my-card q-pa-lg"
          style="
            width: 24%;
            background-color: rgb(238, 211, 179);
            border-radius: 15px;
          "
        >
          <div class="flex justify-center">
            <img src="sleep.png" width="100px" alt="sleep" class="q-mb-md" />
          </div>
          <div>
            <span
              class="q-mt-lg"
              style="
                padding: 6px;
                background-color: rgb(255, 255, 255);
                border-radius: 15px;
                font-size: 8px;
                font-weight: 900;
              "
              >توسعه شخصیت فردی</span
            >
            <h5 class="q-my-sm" style="font-weight: 900">خواب</h5>
            <p>نمیتوانید بخوابید و ساعت خوابتان بهم ریخته ؟</p>
          </div>
        </div>

        <div
          class="my-card q-pa-lg"
          style="
            width: 24%;
            background-color: rgb(238, 211, 179);
            border-radius: 15px;
          "
        >
          <div class="flex justify-center">
            <img src="sleep.png" width="100px" alt="sleep" class="q-mb-md" />
          </div>
          <div>
            <span
              class="q-mt-lg"
              style="
                padding: 6px;
                background-color: rgb(255, 255, 255);
                border-radius: 15px;
                font-size: 8px;
                font-weight: 900;
              "
              >توسعه شخصیت فردی</span
            >
            <h5 class="q-my-sm" style="font-weight: 900">خواب</h5>
            <p>نمیتوانید بخوابید و ساعت خوابتان بهم ریخته ؟</p>
          </div>
        </div>

        <div
          class="my-card q-pa-lg"
          style="
            width: 24%;
            background-color: rgb(238, 211, 179);
            border-radius: 15px;
          "
        >
          <div class="flex justify-center">
            <img src="sleep.png" width="100px" alt="sleep" class="q-mb-md" />
          </div>
          <div>
            <span
              class="q-mt-lg"
              style="
                padding: 6px;
                background-color: rgb(255, 255, 255);
                border-radius: 15px;
                font-size: 8px;
                font-weight: 900;
              "
              >توسعه شخصیت فردی</span
            >
            <h5 class="q-my-sm" style="font-weight: 900">خواب</h5>
            <p>نمیتوانید بخوابید و ساعت خوابتان بهم ریخته ؟</p>
          </div>
        </div>
      </div>
    </section>
  </q-page>
</template>

<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";

import "swiper/css/pagination";
import "swiper/css/navigation";

// import "./style.css";

// import required modules
import { Pagination, Navigation, Autoplay } from "swiper/modules";

import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import { useQuasar } from "quasar";
import { api } from "src/boot/axios.js";

export default {
  name: "DashboardPage",

  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {
    const q = useQuasar();
    const router = useRouter();
    const route = useRoute();
    const categories = ref([]);
    const articles = ref([]);

    onMounted(() => {
      fetchCategories();
      fetchArticles();
    });

    function fetchCategories() {
      api
        .get("api/categories")
        .then((res) => {
          // console.log(res.data);
          if (res.data.status) {
            categories.value = res.data.categories;
            // let pElemnt = document.querySelector("#categoryDescription");
            // let text = pElemnt.textContent;
            // pElemnt.textContent = text.substring(0, 30) + "...";
          } else {
            q.notify({
              color: "red",
              position: "top",
              message: res.data.message,
            });
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

    function fetchArticles() {
      api
        .get("api/articles")
        .then((res) => {
          // console.log(res.data);
          if (res.data.status) {
            articles.value = res.data.articles;
          } else {
            q.notify({
              color: "red",
              position: "top",
              message: res.data.message,
            });
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
      modules: [Pagination, Navigation, Autoplay],
      categories,
      articles,
    };
  },
};
</script>
