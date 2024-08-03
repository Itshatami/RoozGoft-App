<template>
  <q-page padding>
    <!-- content -->
    <div class="row">
      <div class="col-12" style="direction: rtl">
        <h5 style="text-decoration: underline">همه دسته بندی ها</h5>
        <!-- items -->
        <div v-for="category in categories" :key="category.id">
          {{ category.name }}
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
import { ref } from "vue";
import { api } from "src/boot/axios.js";
import { useQuasar } from "quasar";

export default {
  name: "CategoryPage",
  setup() {
    const categories = ref([null]);
    const q = useQuasar();
    api
      .get("api/categories")
      .then((res) => {
        console.log(res.data);
        if (res.data.status) {
          categories.value.push(res.data.categories);
        } else {
          throw new Error(res.data.message);
        }
      })
      .catch((err) => {
        q.notify({
          message: err.message,
          color: "red",
          position: "top",
        });
      });
    return { categories };
  },
};
</script>
