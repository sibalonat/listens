<template>
  <app-layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Skills</h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <table v-if="skills.length > 0" class="w-full">
          <thead class="text-indigo-600 border border-b-2 border-gray-300">
            <tr>
              <th class="px-6 py-3 text-left">Name</th>
              <th class="px-6 py-3 text-left">Color</th>
              <th class="px-6 py-3 text-left">Actions</th>
            </tr>
          </thead>
          <tbody v-for="skill in skills" :key="skill.id">
            <tr class="text-sm text-indigo-900 border-b border-gray-400">
              <td class="px-6 py-4">
                {{ skill.name }}
              </td>
              <td class="px-6 py-4">
                <p>
                  <span class="p-4 mr-5 rounded" :class="skill.color"></span>
                  {{ skill.color }}
                </p>
                <!-- {{ skill.name }} -->
              </td>
              <td class="px-6 py-4">
                <jet-button
                  class="mr-2 text-indigo-500 border border-indigo-500 bg-indigo-50 hover:bg-indigo-100"
                  >Edit</jet-button
                >
                <jet-button
                  class="mr-2 text-red-500 border border-red-500 bg-red-50 hover:bg-red-100"
                  >Delete</jet-button
                >
              </td>
            </tr>
          </tbody>
        </table>
        <div
          v-else
          class="p-3 text-red-800 bg-red-100 border border-red-400 rounded-lg"
        >
          You have not created any skills yet
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
  components: {
    JetButton,
    AppLayout
  },
  props: {
      skills: Object
  }
};
</script>

<style>
</style>
