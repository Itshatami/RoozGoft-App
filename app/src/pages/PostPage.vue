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

        <!-- post -->
        <div>
          <h5>{{ post.title }}</h5>
          <p>{{ post.content }}</p>
        </div>
      </div>
    </section>
  </q-page>
</template>

<script>
import { ref, onMounted } from "vue";
import { useQuasar } from "quasar";
import { useRoute, useRouter } from "vue-router";
import { api } from "src/boot/axios.js";

export default {
  name: "PostPage",
  setup() {
    const q = useQuasar();
    const route = useRoute();
    const user = ref([]);
    
    const post = ref([]);

    onMounted(() => {
      fetchPost();
    });

    function fetchPost() {
      api
        .get("api/posts/" + route.params.id)
        .then((res) => {
          console.log(res.data);
          if (res.data.status) {
            user.value = res.data.user;
            
            post.value = res.data.post;
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
    return { user , post   };
  },
};
</script>
