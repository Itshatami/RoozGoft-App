<template>
  <q-layout view="hHh lpR fFf">
    <q-page-container style="overflow-y:hidden;">
      <div
        class="q-gutter-y-md"
        style="
          position: absolute;
          bottom: 50px;
          width: 100%;
          display: flex;
          justify-content: center;
          z-index: 99;
        "
      >
        <q-tabs
          style="border-radius: 10px"
          v-model="tab"
          inline-label
          class="bg-dark text-white shadow-2"
        >
          <q-tab @click="router.push('/posts')" name="posts" icon="message" label="پست ها" />
          <q-tab @click="router.push('/')" name="dashboard" icon="dashboard" label="روزگفت" />
          <q-tab name="profile" icon="man" label="پروفایل" />
        </q-tabs>
      </div>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { ref } from "vue";
import { useRouter } from "vue-router";
export default {
  name: "MainLayout",

  setup() {
    const router = useRouter()
    const tab = ref("dashboard");
    
    return { tab , router };
  },
};
</script>
