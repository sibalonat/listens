<template>
    <section
    class="flex items-end py-6 px-36">
        <div
        :class="color"
        class="w-40 h-40 rounded-2xl">
        <img :src="url" class="object-cover w-full" alt="">
        </div>

        <p class="flex-1 mx-10 mb-10 text-4xl font-extrabold">
            {{ title }}
        </p>
        <p class="flex-1 mx-10 text-lg">
            {{ description }}
        </p>
    </section>
</template>

<script>
export default {
  props: [
      "title",
      "description",
      "color",
      "url"
    ],
};
</script>
