<template>
  <q-page padding>
    <!-- content -->
    <section class="row flex flex-center">
      <div
        class="col-8 q-pa-xl"
        style="
          direction: rtl;
          border: 1px solid #afafaf;
          border-radius: 15px;
          box-shadow: 0px 0px 30px 0px #000000;
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
          <p class="q-pa-sm rounded-borders bg-amber-8 text-white">
            {{ category.displayName }}
          </p>
        </div>
        <!-- article -->
        <div>
          <h5>{{ article.title }}</h5>
          <p>{{ article.content }}</p>
        </div>
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
