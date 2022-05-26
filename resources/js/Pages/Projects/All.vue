<template>
    <app-layout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Skills</h2>
        </template>
        <div class="py-12">
            <div class="mx-auto text-right max-w-7xl sm:px-6 lg:px-8">
                <jet-button class="p-3 mb-4 text-gray-800 border border-blue-400 bg-blue-50 hover:bg-blue-500"
                    @click="acting = true">
                    Add new +
                </jet-button>

                <!-- //modal  -->
                <jet-modal :show="acting" closeable="true" @close="acting = null">
                    <!-- <div class="p-8 shadow-2xl bg-gray-50"> -->
                    <div class="p-8 shadow-2xl bg-gray-50">
                        <p class="text-2xl font-extrabold text-center text-gray-600">
                            Let me know some details
                        </p>
                        <form class="flex flex-col items-center p-16" @submit.prevent="submit">
                            <!-- //title -->
                            <jet-input class="px-5 py-3 mb-3 border border-gray-600 rounded w-96" type="text" name="title"
                                placeholder="Name of the project" v-model="form.title"></jet-input>
                            <jet-input-error :message="form.errors.title" />

                            <!-- //description -->
                            <textarea class="px-5 py-3 border border-gray-600 rounded w-96" type="text"
                                name="description" placeholder="Project Description" v-model="form.description">
                            </textarea>
                            <jet-input-error :message="form.errors.description" />
                            <!-- //icons -->
                            <select class="mt-5 border border-gray-600 rounded w-96" v-model="form.icon_name">
                                <option value="">select a icon</option>
                                <option v-for="icon in availableIcons" :key="icon" :value="icon"> {{ icon }}
                                </option>
                            </select>
                            <jet-input-error :message="form.errors.icon_name" />
                            <!-- //color -->
                            <select class="mt-5 border border-gray-600 rounded w-96" v-model="form.color">
                                <option value="">select a icon</option>
                                <option v-for="color in availableColor" :key="color" :value="color"> {{ color }}
                                </option>
                            </select>
                            <jet-input-error :message="form.errors.color" />

                            <jet-button :disabled="form.processing"
                                class="justify-center px-5 py-3 mt-5 text-sm bg-purple-400 w-96 rounded-xl">
                                <span class="mr-1 animate-spin" v-show="form.processing">
                                    &#9696;
                                </span>
                                <span v-show="!form.processing">Submit</span>
                            </jet-button>
                        </form>
                    </div>
                    <!-- </div> -->
                </jet-modal>

                <br />
                <table v-if="projects.length > 0" class="w-full text-left">
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
                                    class="mr-2 text-indigo-500 border border-indigo-500 bg-indigo-50 hover:bg-indigo-100">
                                    Edit</jet-button>
                                <jet-button class="mr-2 text-red-500 border border-red-500 bg-red-50 hover:bg-red-100">
                                    Delete</jet-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else class="p-3 text-red-800 bg-red-100 border border-red-400 rounded-lg">
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

import JetModal from "@/Jetstream/Modal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";

export default {
    components: {
        JetButton,
        AppLayout,
        JetModal,
        JetInput,
        JetInputError
    },
    props: {
        projects: Object,
        availableIcons: Object,
        availableColor: Object,
    },
    methods: {
        componentName(index) {
            return defineAsyncComponent(() =>
                import(
                    "@heroicons/vue/solid/" + this.projects[index].icon_name + "Icon.js"
                )
            );
        },
        submit() {
            this.form.submit('post', route("projects.store"), {
                onSuccess: () => {
                    this.form.reset('title');
                    this.form.reset('description');
                    this.form.reset('color');
                    this.form.reset('icon_name');
                    this.acting = null;
                },
            });
        },
    },
    data() {
        return {
            acting: null,
            form: this.$inertia.form({
                title: "",
                description: "",
                color: "",
                icon_name: "",
            }),
        }
    },
};
</script>

<style>
</style>
