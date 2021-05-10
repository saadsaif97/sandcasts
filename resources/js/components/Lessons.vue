<template>
    <div>
        <div class="py-3 d-flex justify-content-end">
            <button class="btn btn-success btn-sm" @click="createNewLesson()">
                Create Lesson
            </button>
        </div>
        <ul class="list-group list-group-flush">
            <li
                class="list-group-item"
                style="background-color: #e9e9e9; font-weight: bolder"
            >
                Lessons
            </li>
            <li class="list-group-item" v-show="lessons.length === 0">
                There is no lesson in this series yet...
            </li>
            <li
                class="list-group-item d-flex justify-content-between"
                v-for="(lesson, index) in lessons"
                :key="index"
            >
                {{ lesson.title }}

                <div>
                    <button
                        class="btn btn-info btn-sm"
                        @click="editLesson(lesson)"
                    >
                        Edit
                    </button>
                    <button
                        class="btn btn-danger btn-sm"
                        @click="deleteLesson(lesson.id, lesson.title, index)"
                    >
                        Delete
                    </button>
                </div>
            </li>
        </ul>
        <create-lesson
            :series_id="this.series_id"
            :series_title="this.series_title"
        ></create-lesson>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: ["default_lessons", "series_id", "series_title"],
    mounted() {
        this.$on("lesson_created", lesson => {
            this.lessons.push(lesson);
        });

        this.$on("lesson_updated", updatedLesson => {
            const updatedIndex = this.lessons.findIndex(
                lesson => lesson.id == updatedLesson.id
            );
            this.lessons.splice(updatedIndex, 1, updatedLesson);
        });
    },
    components: {
        "create-lesson": require("./children/CreateLesson.vue").default
    },
    data() {
        return {
            lessons: JSON.parse(this.default_lessons)
        };
    },
    methods: {
        createNewLesson() {
            this.$emit("create-new-lesson");
        },
        editLesson(lesson) {
            this.$emit("edit_lesson", lesson);
        },
        deleteLesson(id, title, index) {
            confirm(
                `Are sure, you want to delete following lesson? \n ${title}`
            )
                ? axios
                      .delete(`/admin/${this.series_id}/lessons/${id}`)
                      .then(res => {
                          this.lessons.splice(index, 1);
                          Vue.$toast.success("Lesson Deleted Successfully");
                      })
                      .catch(error => {
                          window.handleAxiosErrors(error);
                      })
                : null;
        }
    }
};
</script>
