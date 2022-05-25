<template>
  <section class="flex items-center justify-between py-6 px-44">
    <div
      class="w-24 h-24 border-8 border-double rounded-full"
      :class="background"
    ></div>
    <p class="mx-1 text-2xl font-extrabold text-gray-800">
      <slot></slot>
    </p>
  </section>
</template>

<script>
export default {
  // setup() {

  // },
  props: ["background"],
};
</script>
