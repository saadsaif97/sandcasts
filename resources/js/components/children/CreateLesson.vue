<template>
    <div class="modal" tabindex="-1" id="createLessonModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <p class="modal-title">
                            Create new lesson for series:
                        </p>
                        <h5>{{ this.series_title }}</h5>
                    </div>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control form-control-sm"
                                placeholder="title"
                                v-model="lesson.title"
                            />
                            <p v-if="errors.title" class="text-danger">
                                {{ this.errors.title }}
                            </p>
                        </div>
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control form-control-sm"
                                placeholder="episode number"
                                v-model.number="lesson.episode_number"
                            />
                            <p v-if="errors.episode_number" class="text-danger">
                                {{ this.errors.episode_number }}
                            </p>
                        </div>
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control form-control-sm"
                                placeholder="Vimeo video id"
                                v-model="lesson.video_id"
                            />
                            <p v-if="errors.video_id" class="text-danger">
                                {{ this.errors.video_id }}
                            </p>
                        </div>
                        <div class="form-group">
                            <textarea
                                cols="30"
                                rows="10"
                                class="form-control form-control-sm"
                                placeholder="description"
                                v-model="lesson.description"
                            ></textarea>
                            <p v-if="errors.description" class="text-danger">
                                {{ this.errors.description }}
                            </p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary btn-sm"
                        data-dismiss="modal"
                    >
                        Close
                    </button>
                    <button
                        type="button"
                        class="btn btn-info btn-sm"
                        @click="updateSeriesLesson()"
                        v-if="editing"
                    >
                        Update Lesson
                    </button>
                    <button
                        type="button"
                        class="btn btn-success btn-sm"
                        @click="createSeriesLesson()"
                        v-else
                    >
                        Create Lesson
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

class Lesson {
    constructor(lesson) {
        this.title = lesson.title || "";
        this.episode_number = lesson.episode_number || "";
        this.video_id = lesson.video_id || "";
        this.description = lesson.description || "";
    }
}

export default {
    props: ["series_id", "series_title"],
    mounted() {
        this.$parent.$on("create-new-lesson", () => {
            $("#createLessonModal").modal();
            this.editing = false;
            this.lesson = new Lesson({});
            this.clearErrors();
        });

        this.$parent.$on("edit_lesson", lesson => {
            $("#createLessonModal").modal("show");
            this.editing = true;
            this.lesson = new Lesson(lesson);
            this.update_lesson_id = lesson.id;
            this.clearErrors();
        });
    },
    data() {
        return {
            lesson: {},
            editing: false,
            update_lesson_id: "",
            errors: {
                title: "",
                episode_number: "",
                video_id: "",
                description: ""
            }
        };
    },
    methods: {
        createSeriesLesson() {
            let totalErros = this.validateRules();

            if (totalErros === 0) {
                axios
                    .post(`/admin/${this.series_id}/lessons`, this.lesson)
                    .then(res => {
                        if (res.status === 201) {
                            this.$parent.$emit("lesson_created", res.data);
                            this.lesson = new Lesson({});
                            $("#createLessonModal").modal("hide");
                            Vue.$toast.success("Lesson Created Successfully");
                        }
                    })
                    .catch(err => console.log(err));
            }
        },
        updateSeriesLesson() {
            let totalErros = this.validateRules();

            if (totalErros === 0) {
                axios
                    .put(
                        `/admin/${this.series_id}/lessons/${this.update_lesson_id}`,
                        this.lesson
                    )
                    .then(res => {
                        this.$parent.$emit("lesson_updated", res.data);
                        $("#createLessonModal").modal("hide");
                        this.lesson = new Lesson({});
                        Vue.$toast.success("Lesson Updated Successfully");
                    })
                    .catch(err => console.log(err));
            }
        },
        validateRules() {
            this.errors.title = this.lesson.title ? "" : "required";
            this.errors.episode_number =
                typeof this.lesson.episode_number === "number"
                    ? ""
                    : "Please input a number as episode number";
            this.errors.video_id = this.lesson.video_id ? "" : "required";
            this.errors.description = this.lesson.description ? "" : "required";

            return Object.values(this.errors).filter(error => error.length > 0)
                .length;
        },
        clearErrors() {
            this.errors.title = "";
            this.errors.episode_number = "";
            this.errors.video_id = "";
            this.errors.description = "";
        }
    },
    computed: {
        csrf() {
            return document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");
        }
    }
};
</script>
