<template>
  <q-page padding>
    <!-- content -->
    <div class="row">
      <div class="col-12" style="direction: rtl">
        <h5 style="text-decoration: underline">همه دسته بندی ها</h5>
        <!-- items -->
        <div v-if="categories === null" class="flex flex-center">
          هیچ دسته بندی ثبت نشده!
        </div>
        <div v-else v-for="category in categories" :key="category.id + 1">
          <div
            class="row"
            style="margin: 15px 0px; border-bottom: 1px solid gray"
          >
            <div class="col-1 flex flex-column justify-center items-center">
              <p>{{ category.id }}</p>
            </div>
            <div class="col-2 flex flex-column justify-center items-center">
              <p>{{ category.displayName }}</p>
            </div>
            <div
              class="col-3 q-pa-sm flex flex-column justify-center items-center"
            >
              <!-- <p max="">{{ category.description }}</p> -->
              <q-btn
                label="دیدن چکیده"
                color="primary"
                @click="showDescription(category.id)"
              />
            </div>
            <div v-if="category.image === null" class="col-3 text-center">
              <img
                src="coming.gif"
                alt="gif"
                style="max-width: 60px; max-height: 60px; object-fit: cover"
              />
            </div>
            <div v-else class="col-3 text-center">
              <img
                :src="
                  'http://127.0.0.1:8000/storage/images/categories/' +
                  category.image
                "
                alt="image"
                style="max-width: 60px; max-height: 60px; object-fit: cover"
              />
            </div>
            <div
              class="col-3 q-gutter-x-sm flex flex-column justify-center items-center"
            >
              <q-btn
                @click="showEdit(category.id)"
                color="green"
                style="color: white"
                label="ویرایش"
              />
              <q-btn
                @click="showConfirmation(category.id)"
                style="background: #ff0000; color: white"
                label="حذف"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <q-dialog
      v-model="showModal"
      persistent
      transition-show="scale"
      transition-hide="scale"
    >
      <q-card class="bg-teal text-white" style="width: 300px; direction: rtl">
        <q-card-section>
          <div class="text-h6">شرح/خلاصه</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          {{ descriptionInModal }}
        </q-card-section>

        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn flat label="بستن" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
    <!-- confirm delete -->
    <q-dialog
      v-model="confirm"
      backdropFilter="blur(4px) saturate(150%)"
      persistent
    >
      <q-card>
        <q-card-section class="row items-center">
          <span class="q-ml-sm"
            >مطمعنید که میخواید این دسته بندی شماره {{ selectedCategory.id }} را
            حذف کنید؟</span
          >
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="لغو" color="secondary" v-close-popup />
          <q-btn
            @click="deleteCategory"
            flat
            label="حذف"
            color="red"
            v-close-popup
          />
        </q-card-actions>
      </q-card>
    </q-dialog>
    <!-- edit dialog -->
    <q-dialog
      v-model="edit"
      backdropFilter="blur(4px) saturate(150%)"
      persistent
    >
      <q-card style="width: 800px; direction: rtl">
        <q-card-section class="text-center">
          <img style="max-width: 200px;max-height: 200px;object-fit: cover;" :src=" 'http://127.0.0.1:8000/storage/images/categories/'+selectedCategory.image" alt="img" />
        </q-card-section>
        <q-card-section class="row items-center">
          <q-input
            class="full-width"
            standout="bg-teal text-white"
            v-model="name"
          >
            <template v-slot:before>
              <span style="font-size: 14px">نام دسته بندی: </span>
            </template>
          </q-input>
        </q-card-section>

        <q-card-section>
          <q-input standout="bg-teal text-white" v-model="displayName">
            <template v-slot:before>
              <span style="font-size: 14px">نام نمایشی دسته بندی: </span>
            </template>
          </q-input>
        </q-card-section>

        <q-card-section>
          <q-input
            standout="bg-teal text-white"
            type="textarea"
            v-model="description"
            style="direction: rtl"
          >
            <template v-slot:before>
              <span style="font-size: 14px">چکیده دسته بندی: </span>
            </template>
          </q-input>
        </q-card-section>
        <q-card-actions style="direction: rtl !important">
          <q-input
            class="full-width"
            standout="bg-teal text-white"
            v-model="colorPallet"
          >
            <template v-slot:before>
              <span style="font-size: 14px">رنگ :</span>
            </template>
          </q-input>
        </q-card-actions>

        <q-card-actions align="right">
          <q-file class="full-width" v-model="image">
            <template v-slot:before>
              <span style="font-size: 14px">تصویر :</span>
            </template>
          </q-file>
        </q-card-actions>

        <q-card-actions align="right">
          <q-btn flat label="برگشت" color="gray" v-close-popup />
          <q-btn
            @click="updateCategory"
            label="ویرایش"
            color="secondary"
            :loading="loading"
            :disable="loading"
            v-close-popup
          />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
import { ref, onMounted } from "vue";
import { api } from "src/boot/axios.js";
import { useQuasar } from "quasar";
import { useRoute, useRouter } from "vue-router";

export default {
  name: "CategoryPage",
  setup() {
    const route = useRoute();
    const categories = ref([]);
    const q = useQuasar();
    const descriptionInModal = ref(null);
    const selectedCategory = ref(null);
    const showModal = ref(false);
    const confirm = ref(false);
    const edit = ref(false);
    const loading = ref(false);

    const name = ref();
    const displayName = ref(null);
    const description = ref(null);
    const image = ref(null);
    const colorPallet = ref(null);

    onMounted(() => {
      getCategories();
    });

    function showDescription(id) {
      let category = categories.value.find((cat) => cat.id === id);
      descriptionInModal.value = category.description;
      showModal.value = true;
    }

    function getCategories() {
      api
        .get("api/categories")
        .then((res) => {
          console.log(res.data);
          if (res.data.status) {
            categories.value = res.data.categories;
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
    }

    function showEdit(id) {
      selectedCategory.value = categories.value.find((cat) => cat.id === id);
      edit.value = true;

      // seperating selected category - object to variable
      name.value = selectedCategory.value.name;
      displayName.value = selectedCategory.value.displayName;
      description.value = selectedCategory.value.description;
      colorPallet.value = selectedCategory.value.colorPallet;
      image.value = selectedCategory.value.image;
    }

    function showConfirmation(id) {
      let category = categories.value.find((cat) => cat.id === id);
      selectedCategory.value = category;
      confirm.value = true;
    }

    function updateCategory() {
      loading.value = true;
      api
        .put(
          "api/admin/categories/" + selectedCategory.value.id,
          {
            name: name.value,
            displayName: displayName.value,
            description: description.value,
            colorPallet: colorPallet.value,
            image: image.value,
            _method: PUT,
          },
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        )
        .then((res) => {
          console.log(res.data);
          loading.value = false;
          if (res.data.status) {
            categories.value[selectedCategory.value.id - 1] = res.data.category;
            q.notify({
              message: "باموفقیت ویرایش شد",
              color: "green",
              position: "top",
              icon: "done",
            });
            // getCategories();
          } else {
            q.notify({
              color: "red",
              message: "could not update the category",
              position: "top",
            });
          }
        })
        .catch((err) => {
          loading.value = false;
          console.log(err);
          q.notify({
            color: "red",
            position: "top",
            message: err.message,
          });
        });
    }

    function deleteCategory() {
      api
        .delete("/api/admin/categories/" + selectedCategory.value.id)
        .then((res) => {
          if (res.data.status) {
            categories.value = categories.value.filter(
              (cat) => cat.id !== selectedCategory.value.id
            );
            confirm.value = false;
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

    return {
      showConfirmation,
      categories,
      showModal,
      description,
      colorPallet,
      showDescription,
      showEdit,
      deleteCategory,
      selectedCategory,
      confirm,
      edit,
      name,
      displayName,
      descriptionInModal,
      image,
      updateCategory,
      loading,
    };
  },
};
</script>
