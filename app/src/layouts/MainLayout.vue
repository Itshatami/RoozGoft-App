<template>
  <q-layout view="hHh lpR fFf">
    <q-page-container>
      <div
        class="q-gutter-y-md"
        style="
          position: absolute;
          bottom: 100px;
          width: 100%;
          display: flex;
          justify-content: center;
          z-index: 99;
        "
      >
        <q-tabs
          v-model="tab"
          inline-label
          class="bg-purple text-white shadow-2"
        >
          <q-tab name="mails" icon="mail" label="Mails" />
          <q-tab name="alarms" icon="alarm" label="Alarms" />
          <q-tab name="movies" icon="movie" label="Movies" />
        </q-tabs>
      </div>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { ref } from "vue";

export default {
  name: "MainLayout",

  setup() {
    return {};
  },
};
</script>
