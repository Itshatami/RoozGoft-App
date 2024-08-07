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
            @click="$router.push('categories/' + category.id)"
            class="q-pa-sm q-gutter-x-sm cursor-pointer"
            style="
              display: flex;
              justify-content: center;
              align-items: center;
              border-radius: 10px;
            "
            :style="{ 'background-color': '#' + category.colorPallet }"
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
            <div>
              <img
                :src="
                  'http://127.0.0.1:8000/storage/images/categories/' +
                  category.image
                "
                alt="img"
                style="max-width: 70px; max-height: 70px; object-fit: cover"
              />
            </div>
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
          background: linear-gradient(90deg, #e68200 0%, #ff8d22 100%);
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
      <!-- article -->

      <q-scroll-area class="col-12" style="height: 600px">
        <div class="row q-mt-sm" style="direction: rtl">
          <div
            v-for="article in articles"
            class="col-6 q-pa-md"
            :key="article.id"
          >
            <div
              class="cursor-pointer"
              @click="$router.push('articles/' + article.id)"
              style="
                border-radius: 10px;
                box-shadow: 0px 9px 30px -5px rgba(0, 0, 0, 0.68);
              "
            >
              <div>
                <q-img
                  :src="
                    'http://127.0.0.1:8000/storage/images/articles/' +
                    article.image
                  "
                  style="
                    max-height: 200px;
                    border-top-left-radius: 10px;
                    border-top-right-radius: 10px;
                  "
                />
              </div>
              <div class="q-pa-md">
                <p
                  style="
                    font-weight: 600;
                    font-size: 18px;
                    font-family: kalameh;
                  "
                >
                  {{ article.title }}
                </p>

                <q-btn
                  rounded
                  class="q-mb-md"
                  :label="article.category.displayName"
                  :style="{ background: '#' + article.category.colorPallet }"
                  size="10px"
                />
                <p style="text-align: justify">
                  {{ article.content.substring(0, 200) + "..." }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </q-scroll-area>

    
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
