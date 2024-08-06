<template>
  <q-page padding style="max-width: 1200px; margin: 0px auto">
    <!-- content -->
    <main class="row q-gutter-x-sm">
      <!-- posts -->
      <div class="col-7" style="direction: rtl">
        <q-scroll-area visible="false" style="height: 90vh; width: 100%">
          <div class="row q-gutter-y-sm q-pa-md">
            <!-- if no post -->
            <div v-if="!posts" class="flex flex-center">
              <h1>there is no post</h1>
            </div>
            <!-- post -->
            <div
              v-else
              v-for="post in posts"
              :key="post.id"
              class="col-12 q-pa-md"
              style="
                border-radius: 10px;
                box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.4);
              "
            >
              <!-- user info -->
              <div class="flex justify-start q-gutter-x-md">
                <q-avatar>
                  <img src="avatar.png" alt="profile" />
                </q-avatar>
                <div>
                  <p class="text-body1">{{ post.title }}</p>
                  <p class="text-body2">{{ post.user.username }}</p>
                </div>

                <div>
                  <p>{{ post.content }}</p>
                </div>
              </div>
              <!-- post image -->
              <div v-if="post.image" class="text-center">
                <q-img
                  :src="'http://127.0.0.1:8000/storage/images/posts/' + post.image"
                  style="max-width: 500px; max-height: 300px; object-fit: cover"
                />
              </div>

              <!-- tags -->
              <div class="q-gutter-x-sm">
                <span>#روزگفت</span>
                <span>#زندگی_خوب</span>
                <span>#برنامه_ریزی</span>
              </div>
            </div>
          </div>
        </q-scroll-area>
      </div>

      <!-- sidebar -->
      <div class="col-4 q-mt-sm text-white">
        <div
          class="text-center q-px-md q-pb-md"
          style="background-color: rgb(0, 146, 127); border-radius: 10px"
        >
          <h6 class="q-my-sm q-py-md">نظری برای ثبت دارید ؟</h6>
          <!-- message -->
          <q-input
            class=""
            v-model="title"
            placeholder="تیتر..."
            style="direction: rtl"
            filled
          />
          <q-input
            class="q-my-md"
            v-model="content"
            filled
            type="textarea"
            placeholder="بنویسید..."
            style="direction: rtl"
          />
          <!-- file picker -->
          <q-file
            class="q-pb-sm"
            v-model="image"
            label="ارسال تصویر"
            filled
            style="width: 100%"
          >
            <template v-slot:prepend>
              <q-icon name="attach_file" />
            </template>
          </q-file>

          <q-btn
            @click="send"
            class="q-py-sm text-body1 full-width bg-white text-dark"
            label="ثبت"
          />
          <!-- list -->
          <ul style="direction: rtl; text-align: start">
            <li>حجم تصویر حداکثر 1mb</li>
          </ul>
        </div>
      </div>
    </main>
  </q-page>
</template>

<script>
import { ref, onMounted } from "vue";
import { useQuasar } from "quasar";
import { useRouter } from "vue-router";
import { api } from "src/boot/axios.js";

export default {
  name: "PostsPage",
  setup() {
    const router = useRouter();
    const q = useQuasar();
    const title = ref(null);
    const content = ref(null);
    const image = ref(null);
    const posts = ref([]);

    onMounted(() => {
      fetchPosts();
    });

    function fetchPosts() {
      api
        .get("/api/posts")
        .then((res) => {
          console.log(res.data);
          if (res.data.status) {
            posts.value = res.data.posts;
          } else {
            q.notify({
              color: "red",
              position: "top",
              message: res.data.message,
            });
          }
        })
        .catch((err) => {
          console.log(err.message);
          q.notify({
            color: "red",
            position: "top",
            message: err.message,
          });
        });
    }

    function send() {
      // validate inputs

      // post request api
      api
        .post(
          "api/posts",
          {
            title: title.value,
            content: content.value,
            image: image.value,
          },
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        )
        .then((res) => {
          console.log(res.data);
          if (res.data.status) {
            q.notify({
              color: "green",
              position: "top",
              icon: "done",
              message: "پست با موفقیت ارسال شد",
            });
          }
        })
        .catch((err) => {
          console.log(err);
          q.notify({
            color: "red",
            position: "top",
            message: err.data.message,
          });
        });
    }
    return { title, content, send, image, posts, router };
  },
};
</script>
