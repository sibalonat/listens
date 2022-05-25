<template>
  <app-layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Skills</h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <table v-if="projects.length > 0" class="w-full">
          <thead class="text-indigo-600 border border-b-2 border-gray-300">
            <tr>
              <th class="px-6 py-3 text-left">Title</th>
              <th class="px-6 py-3 text-left">Description</th>
              <th class="px-6 py-3 text-left">Icon</th>
              <th class="px-6 py-3 text-left">Color</th>
              <th class="px-6 py-3 text-left">Actions</th>
            </tr>
          </thead>
          <tbody v-for="(project, index) in projects" :key="project.id">
            <tr class="text-sm text-indigo-900 border-b border-gray-400">
              <td class="px-6 py-4">
                {{ project.title }}
              </td>
              <td class="px-6 py-4">
                {{ project.description }}
              </td>
              <td class="px-6 py-4" :class="project.color">
                <!-- {{ project.description }} -->
                <component :is="componentName(index)"></component>
              </td>
              <!-- td -->
              <td class="px-6 py-4">
                <p>
                  <span class="p-4 mr-5 rounded" :class="project.color">
                  {{ project.color }}
                  </span>
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
          You have not created any projects yet
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineAsyncComponent } from "vue";
import JetButton from "@/Jetstream/Button";
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
  components: {
    JetButton,
    AppLayout,
  },
  props: {
    projects: Object,
  },
  methods: {
    componentName(index) {
      return defineAsyncComponent(() =>
        import(
          "@heroicons/vue/solid/" + this.projects[index].icon_name + "Icon.js"
        )
      );
    },
  },
};
</script>

<style>
</style>
