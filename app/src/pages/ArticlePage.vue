<template>
  <q-page padding style="max-width: 1200px; margin: 0px auto">
    <!-- content -->
    <q-btn
      @click="$router.back"
      outline
      round
      class="q-mb-md"
      icon="arrow_back"
    />
    <section class="row flex flex-center">
      <div
        class="col-8 q-pa-lg"
        style="
          direction: rtl;
          border: 1px solid #afafaf;
          border-radius: 15px;
          box-shadow: 0px 0px -80px 0px #000000;
        "
      >
        <!-- user info -->
        <div class="q-gutter-x-md" style="display: flex; align-items: center">
          <q-img src="avatar.png" width="100px" />
          <h5 style="font-weight: 800">{{ user.username }}</h5>
        </div>
        <!-- category -->
        <div class="q-gutter-x-md" style="display: flex; align-items: center">
          <p style="font-weight: 600">دسته بندی:</p>
          <q-btn

                  rounded
                  class="q-mb-md"
                  :label="category.displayName"
                  :style="{ background: '#' + category.colorPallet }"
                  size="10px"
                />
        </div>
        <!-- article -->
        <q-scroll-area style="height: 700px" visible="true">
          <img
            :src="
              'http://127.0.0.1:8000/storage/images/articles/' +
              article.image
            "
            alt="img"
            style="width: 100%;max-height: 300px;object-fit: cover;"
          />
          <h5 style="font-weight: bold">{{ article.title }}</h5>
          <p class="text-body1" style="text-align: justify">
            {{ article.content }}
          </p>
        </q-scroll-area>
      </div>
    </section>
  </q-page>
</template>

<script>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import { useQuasar } from "quasar";
import { api } from "src/boot/axios.js";

export default {
  name: "ArticlePage",
  setup() {
    const q = useQuasar();
    const route = useRoute();
    const user = ref([]);
    const category = ref([]);
    const article = ref([]);

    onMounted(() => {
      fetchArticle();
    });

    function fetchArticle() {
      api
        .get("api/articles/" + route.params.id)
        .then((res) => {
          console.log(res.data);
          if (res.data.status) {
            user.value = res.data.user;
            category.value = res.data.category;
            article.value = res.data.article;
            console.log(article.value);
            
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
      route,
      user,
      category,
      article,
    };
  },
};
</script>
