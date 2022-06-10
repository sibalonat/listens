<template>

    <Section class="bg-cyan-200">
            <div class="grid w-full grid-cols-1 gap-4 px-4 ml-0 bg-teal-500 rounded-full sm:px-6">
                 <div class="flex items-center justify-between w-1/2 py-2 mx-auto md:space-x-10">
                    <button @click="$refs.skulls.$el.scrollIntoView({ behavior: 'smooth' })"
                    class="inline-flex items-center px-10 py-2 text-base font-medium rounded-md text-cyan-200 hover:text-cyan-50 focus:outline-none">Aree di competenza</button>

                    <button @click="$refs.projects.$el.scrollIntoView({ behavior: 'smooth' })"
                    class="inline-flex items-center px-10 py-2 text-base font-medium rounded-md text-cyan-200 hover:text-cyan-50 focus:outline-none">Cosa ofriamo</button>
                 </div>
            </div>
    </Section>
    <div>
        <!-- first section -->
        <Section class="h-screen pt-16 bg-cyan-200">
            <div class="flex flex-wrap content-between h-2/3 pb-36">
                    <transition
                    appear
                    @before-enter="onBeforeEnter"
                    @enter="onEnter"
                    @after-enter="afterEnter">
                    <p
                    class="w-full pb-3 font-bold text-green-500 uppercase ml-15 text-9xl"
                    >
                    Digital
                    </p>
                    </transition>

                    <transition
                    appear
                    @before-enter="onBeforeEnter"
                    @enter="onEnterSecond"
                    @after-enter="afterEnter">
                    <p class="w-full pb-3 font-bold text-green-500 uppercase ml-15 text-[10rem]">
                    Eco
                    </p>
                    </transition>
                    <br>
                <div class="flex items-end pb-2">
                    <div class="grid grid-cols-2">
                    <p data-aos="flip-up" data-aos-duration="500"
                    data-aos-anchor-placement="top-center" data-aos-offset="-200"
                    data-aos-easing="ease-in" data-aos-delay="150"
                    class="w-1/3 col-span-2 mr-5 text-xl font-thin text-green-500"
                    >Specialised in Web Development, Ecommerce.
                    Full-service agency specialised in Web Design, Web Development, Ecommerce Development.</p>
                    <JetButton class="w-40 text-sm font-light bg-teal-500 rounded text-cyan-200 hover:bg-green-500"
                        @click="contacting = true">
                        {{ $page.props.flash.contacted ? 'Grazie' : 'Scropra di piu' }}
                    </JetButton>
                    </div>
                    <br>
                </div>
            </div>
            <div class="mt-3 text-center text-teal-800 animate-bounce text-7xl">
                <a @click="$refs.skulls.$el.scrollIntoView({ behavior: 'smooth' })" class="cursor-pointer">&#8675;</a>
            </div>
        </Section>

        <!-- second section  v-animate-onscroll="'animated flip'" -->
        <Section class="h-screen bg-teal-800 border-t-8 border-green-500 text-cyan-200" ref="skulls"  id="skills">
            <h2
            class="pt-3 text-6xl font-bold text-center uppercase pb-44"
            data-aos="fade-up"
            data-aos-duration="700"
            data-aos-easing="ease-in"
            >La piattaforma di tutte le "piattaforme"</h2>

                <div class="grid grid-flow-row grid-cols-3 gap-10 gap-y-40">
                    <div v-for="(skill,i) in skills" :key="i" class="relative">
                        <Skill
                        :background="skill.color"
                        class="relative z-40 mb-44"
                        data-aos="fade-up"
                        data-aos-anchor-placement="top-center"
                        data-aos-duration="700"
                        :data-aos-delay="500 + i * 5"
                        data-aos-easing="ease-in">
                            {{ skill.name }}
                        </Skill>
                        <img
                        :src="skill.url"
                        class="absolute object-cover w-2/3 mx-auto inset-3"
                        data-aos="slide-up"
                        data-aos-duration="600"
                        data-aos-easing="ease-in"
                        :data-aos-delay="300 + i * 5"
                        >
                    </div>
                </div>

            <div class="flex justify-center mt-12">
                <JetButton class="text-sm font-bold text-green-500 rounded bg-cyan-200 hover:bg-green-800"
                    @click="contacting = true">
                     {{ $page.props.flash.contacted ? 'Grazie' : 'Scropra di piu' }}
                </JetButton>
            </div>

        </Section>

        <!-- third section -->
        <Section class="h-screen text-teal-800 bg-green-500 border-t-8 border-teal-500" ref="projects">
            <h2
            data-aos="fade-up"
            data-aos-duration="700"
            data-aos-easing="ease-in"
            class="pt-3 text-6xl font-bold uppercase"
            >Aiuta a far progredire la tua attività con la tecnologia</h2>

            <TransitionGroup
            appear
            @before-enter="startProject"
            @enter="enterProject"
            tag="div"
            >
            <div v-for="(project, index) in projects" :key="project.id" :data-index="index">
                <Project
                :title="project.title"
                :url="project.url"
                :description="project.description"
                :color="project.color">
                </Project>
            </div>

            </TransitionGroup>

            <div class="flex justify-center mt-10">
                <JetButton class="text-sm font-bold text-gray-800 bg-green-400 rounded hover:bg-green-800"
                    @click="contacting = true">
                     {{ $page.props.flash.contacted ? 'Grazie' : 'Scropra di piu' }}
                </JetButton>
            </div>
        </Section>

        <Section class="flex justify-between text-xl text-gray-300 bg-gray-800">
            <p>&copy; Digital Eco</p>
            <div class="flex items-center justify-evenly">
                <a class="px-2 pb-1 border-b hover:text-gray-500" target="_blank" href="https://github.com/sibalonat">github</a>
                <!-- <Link class="px-2 pb-1 border-b hover:text-gray-500" href="#">twitter</Link> -->
            </div>
        </Section>
    </div>
    <jet-modal :show="contacting" closeable="true" @close="contacting = null">

        <div class="p-8 font-bold text-center bg-green-400 shadow-2xl" v-if="$page.props.flash.contacted">
            <p class="m-5 text-8xl">done</p>
            <p class="m-2 text-5xl font-bold">thanks</p>
            <p class="m-2 text-xl">ill get to you</p>
        </div>
        <div v-else class="p-8 shadow-2xl bg-gray-50">
            <p class="text-2xl font-extrabold text-center text-gray-600">
                Scrivaci della tua bussines idea
            </p>
            <form class="flex flex-col items-center p-16" @submit.prevent="submit">
                <jet-input class="px-5 py-3 border border-gray-600 rounded w-96" type="email" name="email"
                    placeholder="Tuo Email" v-model="form.email"></jet-input>
                <jet-input-error :message="form.errors.email" />
                <textarea name="message" class="px-5 py-3 mt-5 border border-gray-600 rounded w-96"
                    placeholder="Gli detagli" v-model="form.message"></textarea>
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

import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger.js";

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

// Vue.use(VueAnimate);

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
        JetInputError
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        skills: Object,
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
        submit() {
            this.form.post(route("contact"));
        },
        onBeforeEnter(el) {
            el.style.transform = 'translateY(-60px)';
            el.style.opacity = 0;
        },
        onEnter(el, done) {
            gsap.to(el, {
                y:0,
                opacity: 1,
                duration: 2,
                ease: 'bounce.out',
                onComplete: done
            });
        },
        onEnterSecond(el, done) {
            gsap.to(el, {
                y:0,
                opacity: 1,
                delay: 1,
                duration: 2,
                ease: 'bounce.out',
                onComplete: done
            });
        },
        startProject(el){
            console.log(el);
            el.style.opacity = 0
            el.style.transform = 'translateY(100px)';
        },
        enterProject(el, done){
            gsap.registerPlugin(ScrollTrigger);
            gsap.to(el, {
                y:0,
                scrollTrigger: {
                    trigger: el,
                    // markers: true,
                    toggleActions: "restart pause resume none"
                },
                opacity: 1,
                delay: el.dataset.index * 0.2,
                duration: 0.8,
                ease: 'bounce.out',
                onComplete: done
            });

        },
        afterEnter() {
            console.log('done');
        }
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
    font-family: 'Italiana', serif;
}
.wrd2 {
    font-family: 'Belleza', sans-serif;
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
