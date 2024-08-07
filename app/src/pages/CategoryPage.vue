<template>
  <q-page padding style="max-width: 1200px; margin: 0px auto">
    <!-- content -->
    <!-- first category -->
    <q-btn @click="$router.back" outline round class="q-mb-md" icon="arrow_back" />
    <section class="row">
      <!-- billboard first -->
      <div
        class="col-12 q-pa-lg"
        style=" display: flex ;justify-content: space-between;align-items: center ;border-radius: 15px"
        :style="{ 'background-color': '#' + category.colorPallet }"
      >
        <!-- left -->
        <div>
          <q-img
            :src="
              'http://127.0.0.1:8000/storage/images/categories/' +
              category.image
            "
            width="100px"
          />
        </div>
        <!-- right  -->
        <div class="text-white" style="direction: rtl">
          <h6 class="q-my-sm">{{ category.displayName }}</h6>
          <p>
            {{ category.description }}
          </p>
        </div>
      </div>
    </section>

    <section class="row q-mt-md">
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
          <h6 class="q-my-sm">تمامی مقاله های این دسته</h6>
        </div>
      </div>
      <!-- article -->

      <q-scroll-area class="col-12" style="height: 600px">
        <div  class="row q-mt-sm" style="direction: rtl">
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
        <!-- <div class="text-center">
          <h3>مقاله ای نوشته نشده است!</h3>
        </div> -->
      </q-scroll-area>
    </section>
  </q-page>
</template>

<script>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { api } from "src/boot/axios.js";
import { useQuasar } from "quasar";

export default {
  name: "CategoryPage",
  setup() {
    const router = useRouter();
    const route = useRoute();
    const q = useQuasar();
    const category = ref([]);
    const articles = ref([]);

    onMounted(() => {
      fetchCategory();
    });

    function fetchCategory() {
      api
        .get("api/categories/" + route.params.id)
        .then((res) => {
          console.log(res.data);
          if (res.data.status) {
            category.value = res.data.category;
            articles.value = res.data.articles;
          }
        })
        .catch((err) => {
          console.log(err);
          q.notify({
            color: "red",
            position: "top",
            message: err.response.data.message,
          });
        });
    }

    return { category, articles };
  },
};
</script>
