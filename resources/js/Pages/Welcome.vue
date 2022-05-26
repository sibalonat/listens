<template>

    <Head title="welcome" />
    <Section class="grid grid-cols-2 text-right text-gray-300 bg-gray-800">
        <div>
            <jet-application-mark class="w-auto h-12"></jet-application-mark>
        </div>
        <div v-if="canLogin">
            <button @click="$refs.skulls.$el.scrollIntoView({ behavior: 'smooth' })"
                class="text-base underline">Skills</button>
            <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm-underline">Dashboard</Link>


            <template v-else>
                <!-- <button></button> -->

                <Link :href="route('login')" class="text-base underline">Login</Link>
                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-base underline place-self-end">
                Register</Link>
            </template>
        </div>
    </Section>
    <div>
        <!-- first section -->
        <Section class="h-screen pt-16 bg-gray-800">
            <div class="flex flex-wrap content-between h-2/3 pb-36">
                <p class="w-full pb-3 font-bold text-gray-300 uppercase border-b-2 border-gray-400 ml15">
                    <span class="text-6xl word wrd1">Digital</span>
                    <span class="word text-9xl wrd2">Eco</span>
                </p>
                <div class="flex items-end pb-2 border-b-2 border-gray-500">
                    <p class="mr-5 text-xl font-bold text-gray-500">Want to know more</p>
                    <JetButton class="text-sm font-bold text-gray-800 bg-green-400 rounded hover:bg-green-800"
                        @click="contacting = true">
                        {{ $page.props.flash.contacted ? 'Thanks' : 'Know more' }}
                    </JetButton>
                </div>
            </div>
            <div class="mt-3 text-center text-gray-300 animate-pulse text-9xl">
                <a href="#skills">&#8675;</a>
            </div>
        </Section>

        <!-- second section -->
        <Section class="h-screen text-gray-800 bg-gray-200" ref="skulls" id="skills">
            <h2 class="pt-3 text-6xl font-bold">Skills</h2>
            <div class="grid grid-cols-2">
                <div v-for="skill in skills" :key="skill.id">
                    <Skill :background="skill.color">
                        {{ skill.name }}
                    </Skill>
                </div>
            </div>
            <div class="flex justify-center mt-10">
                <JetButton class="text-sm font-bold text-gray-800 bg-indigo-400 rounded hover:bg-green-800"
                    @click="contacting = true">
                    {{ $page.props.flash.contacted ? 'Thanks' : 'Know more' }}
                </JetButton>
            </div>
        </Section>

        <!-- third section -->
        <Section class="h-screen text-gray-200 bg-gray-600">
            <h2 class="pt-3 text-6xl font-bold">Projects</h2>

            <div v-for="(project, index) in projects" :key="project.id">
                <Project :title="project.title" :description="project.description" :color="project.color">
                    <!-- <BeakerIcon></BeakerIcon> -->
                    <component :is="componentName(index)"></component>
                </Project>
            </div>

            <div class="flex justify-center mt-10">
                <JetButton class="text-sm font-bold text-gray-800 bg-green-400 rounded hover:bg-green-800"
                    @click="contacting = true">
                    {{ $page.props.flash.contacted ? 'Thanks' : 'Know more' }}
                </JetButton>
            </div>
        </Section>

        <!-- forth section -->
        <Section class="flex justify-between text-xl text-gray-300 bg-gray-800">
            <p>&copy; Marini</p>
            <div class="flex items-center justify-evenly">
                <Link class="px-2 pb-1 border-b hover:text-gray-500" href="#">github</Link>
                <Link class="px-2 pb-1 border-b hover:text-gray-500" href="#">twitter</Link>
            </div>
        </Section>
    </div>
    <jet-modal :show="contacting" closeable="true" @close="contacting = null">
        <!-- <div class="p-8 shadow-2xl bg-gray-50"> -->
        <div class="p-8 font-bold text-center bg-green-400 shadow-2xl" v-if="$page.props.flash.contacted">
            <p class="m-5 text-8xl">done</p>
            <p class="m-2 text-5xl font-bold">thanks</p>
            <p class="m-2 text-xl">ill get to you</p>
        </div>
        <div v-else class="p-8 shadow-2xl bg-gray-50">
            <p class="text-2xl font-extrabold text-center text-gray-600">
                Let me know some details
            </p>
            <form class="flex flex-col items-center p-16" @submit.prevent="submit">
                <jet-input class="px-5 py-3 border border-gray-600 rounded w-96" type="email" name="email"
                    placeholder="Your Email" v-model="form.email"></jet-input>
                <jet-input-error :message="form.errors.email" />
                <textarea name="message" class="px-5 py-3 mt-5 border border-gray-600 rounded w-96"
                    placeholder="The details" v-model="form.message"></textarea>
                <jet-input-error :message="form.errors.message" />
                <jet-button :disabled="form.processing"
                    class="justify-center px-5 py-3 mt-5 text-sm bg-purple-400 w-96 rounded-xl">
                    <span class="mr-1 animate-spin" v-show="form.processing">
                        &#9696;
                    </span>
                    <span v-show="!form.processing">Get in Touch</span>
                </jet-button>
            </form>
        </div>
        <!-- </div> -->
    </jet-modal>
</template>
<script>
import { defineAsyncComponent, defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetButton from "@/Jetstream/Button";
import JetModal from "@/Jetstream/Modal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";

// custom components
import Section from "@/Components/Section";
import Skill from "@/Components/Skill";
import Project from "@/Components/Project";
import route from "../../../vendor/tightenco/ziggy/src/js";

export default defineComponent({
    components: {
        Head,
        Link,
        JetApplicationMark,
        Section,
        JetButton,
        Skill,
        Project,
        JetModal,
        JetInput,
        JetInputError,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        skills: Object,
        projects: Object,
    },
    // mounted() {
    //     // console.log('mounted!')

    // },
    methods: {
        componentName(index) {
            return defineAsyncComponent(() =>
                import(
                    "@heroicons/vue/solid/" + this.projects[index].icon_name + "Icon.js"
                )
            );
        },
        animate: function() {
            console.log("Here");
            anime({
                targets: '.bar2',
                duration: 1500,
                // easing: 'easeInSine',
                elasticity: 400,
                width: this.width
            });
        },
        submit() {
            this.form.post(route("contact"));
        },
    },
    data() {
        return {
            contacting: null,
            form: this.$inertia.form({
                email: "",
                message: "",
            }),
        };
    },
});
</script>

<style scoped>

.wrd1 {
    /* font-family: 'Xanh Mono', monospace; */
    font-family: 'Barrio', cursive;

}
.wrd1 {
    font-family: 'Xanh Mono', monospace;
    /* font-family: 'Barrio', cursive; */
}

.ml15 {
  font-weight: 800;
  font-size: 3.8em;
  text-transform: uppercase;
  letter-spacing: 0.5em;
}

.ml15 .word {
  display: inline-block;
  line-height: 1em;
}
</style>
