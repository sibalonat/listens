<template>
  <section class="flex flex-col items-center justify-between px-16 py-6 mx-auto">
    <div
      class="w-24 border-4 border-double rounded-full ml-28 h-7"
      :class="background"
    >
     <!-- <p class="text-xl font-extrabold leading-5 text-center text-gray-800"> -->
     <p class="text-xl font-light leading-5 text-center text-cyan-200">
      <slot></slot>
    </p>
    </div>
    <!-- <p class="mx-1 text-2xl font-extrabold text-gray-800"> -->
    <!-- <p class="text-2xl font-extrabold text-gray-800 ml-28">
      <slot></slot>
    </p> -->
  </section>
</template>

<script>
export default {
  props: ["background"],
};
</script>
