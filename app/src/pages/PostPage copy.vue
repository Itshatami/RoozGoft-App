<template>
  <q-page padding style="max-width: 1200px; margin: 0px auto">
    <!-- content -->
    <main class="row q-gutter-x-sm">
      <!-- posts -->
      <div class="col-7" style="direction: rtl">
        <div class="row q-gutter-y-sm">
          <!-- post -->
          <div
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
                <p>مهندس خسته</p>
                <p>@mobin_khademi</p>
              </div>
            </div>
            <!-- post image -->
            <div class="text-center">
              <img
                style="max-width: 500px; max-height: 300px;object-fit: cover;"
                src="ali.jpg"
                alt="postimage"
              />
            </div>
            <!-- description -->
            <p>
              از زندگیم راضیم و خیلی خوشحالم که با برنامه شدم . دیگه از اون
              وضعیت خسته شده بودم که نمیدونستم چیکار کنم
            </p>
            <!-- tags -->
            <div class="q-gutter-x-sm">
              <span>#روزگفت</span>
              <span>#زندگی_خوب</span>
              <span>#برنامه_ریزی</span>
            </div>
          </div>
          <!-- post -->
          <div
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
                <p>مهندس خسته</p>
                <p>@mobin_khademi</p>
              </div>
            </div>
            <!-- post image -->
            <div class="text-center">
              <img
                style="max-width: 500px; max-height: 300px;object-fit: cover;"
                src="ali.jpg"
                alt="postimage"
              />
            </div>
            <!-- description -->
            <p>
              از زندگیم راضیم و خیلی خوشحالم که با برنامه شدم . دیگه از اون
              وضعیت خسته شده بودم که نمیدونستم چیکار کنم
            </p>
            <!-- tags -->
            <div class="q-gutter-x-sm">
              <span>#روزگفت</span>
              <span>#زندگی_خوب</span>
              <span>#برنامه_ریزی</span>
            </div>
          </div>
          <!-- post -->
          <div
            class="col-12 q-pa-md"
            style="
              border-radius: 10px;
              box-shadow: 0px 0px 50px 2px rgba(0, 0, 0, 0.4);
            "
          >
            <!-- user info -->
            <div class="flex justify-start q-gutter-x-md">
              <q-avatar>
                <img src="avatar.png" alt="profile" />
              </q-avatar>
              <div>
                <p>مهندس خسته</p>
                <p>@mobin_khademi</p>
              </div>
            </div>
            <!-- description -->
            <p>
              از زندگیم راضیم و خیلی خوشحالم که با برنامه شدم . دیگه از اون
              وضعیت خسته شده بودم که نمیدونستم چیکار کنم
            </p>
            <!-- tags -->
            <div class="q-gutter-x-sm">
              <span>#روزگفت</span>
              <span>#زندگی_خوب</span>
              <span>#برنامه_ریزی</span>
            </div>
          </div>
          <!-- post -->
          <div
            class="col-12 q-pa-md"
            style="
              border-radius: 10px;
              box-shadow: 0px 0px 50px 2px rgba(0, 0, 0, 0.4);
            "
          >
            <!-- user info -->
            <div class="flex justify-start q-gutter-x-md">
              <q-avatar>
                <img src="avatar.png" alt="profile" />
              </q-avatar>
              <div>
                <p>مهندس خسته</p>
                <p>@mobin_khademi</p>
              </div>
            </div>
            <!-- description -->
            <p>
              از زندگیم راضیم و خیلی خوشحالم که با برنامه شدم . دیگه از اون
              وضعیت خسته شده بودم که نمیدونستم چیکار کنم
            </p>
            <!-- tags -->
            <div class="q-gutter-x-sm">
              <span>#روزگفت</span>
              <span>#زندگی_خوب</span>
              <span>#برنامه_ریزی</span>
            </div>
          </div>
          <!-- post -->
          <div
            class="col-12 q-pa-md"
            style="
              border-radius: 10px;
              box-shadow: 0px 0px 50px 2px rgba(0, 0, 0, 0.4);
            "
          >
            <!-- user info -->
            <div class="flex justify-start q-gutter-x-md">
              <q-avatar>
                <img src="avatar.png" alt="profile" />
              </q-avatar>
              <div>
                <p>مهندس خسته</p>
                <p>@mobin_khademi</p>
              </div>
            </div>
            <!-- description -->
            <p>
              از زندگیم راضیم و خیلی خوشحالم که با برنامه شدم . دیگه از اون
              وضعیت خسته شده بودم که نمیدونستم چیکار کنم
            </p>
            <!-- tags -->
            <div class="q-gutter-x-sm">
              <span>#روزگفت</span>
              <span>#زندگی_خوب</span>
              <span>#برنامه_ریزی</span>
            </div>
          </div>
        </div>
      </div>
      <!-- sidebar -->
      <div class="col-4 text-white">
        <div
          class="column text-center"
          style="
            height: 80vh;
            background-color: rgb(0, 146, 127);
            border-radius: 10px;
          "
        >
          <h6 class="q-my-sm">نظری برای ثبت دارید ؟</h6>
          <!-- message -->
          <q-input
            v-model="message"
            filled
            type="textarea"
            placeholder="بنویسید..."
            style="direction: rtl"
          />
          <!-- file picker -->
          <div>
            <q-file
              v-model="file"
              label="ارسال تصویر"
              filled
              style="width: 100%"
            >
              <template v-slot:prepend>
                <q-icon name="attach_file" />
              </template>
            </q-file>
           
          </div>
        </div>
      </div>
    </main>
  </q-page>
</template>

<script>
import { ref } from "vue";
import { useQuasar } from "quasar";
export default {
  name: "PostPage",
  setup() {
    const $q = useQuasar();
    const file = ref(null);
    const message = ref("");

    function send() {}
    return { message, send, file };
  },
};
</script>
