<template>
    <section
    class="flex items-end py-6 px-44">
        <div
        :class="color"
        class="w-24 h-24 bg-gray-100 rounded-2xl">
        <slot></slot>
        </div>
        <p class="flex-1 mx-10 text-4xl font-extrabold">
            {{ title }}
        </p>
        <p class="flex-1 mx-10 text-2xl">
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
    ],
};
</script>
