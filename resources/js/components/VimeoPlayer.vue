<template>
    <div>
        <div
            v-if="lesson"
            :data-vimeo-id="lesson.video_id"
            data-vimeo-width="640"
            id="lessonPlayer"
        ></div>
        <p v-else>There is no lesson in this series</p>
    </div>
</template>

<script>
import Player from "@vimeo/player";
import Swal from "sweetalert2";
import axios from "axios";

export default {
    props: ["lesson", "next_lesson_url"],
    mounted() {
        const player = new Player("lessonPlayer");

        player.on("ended", () => {
            this.completeLesson();
        });
    },
    methods: {
        showAlertOnCompletion() {
            if (this.next_lesson_url) {
                Swal.fire({
                    icon: "success",
                    title: "Yaaye!!!",
                    text: "You completed the lesson!"
                }).then(() => {
                    window.location = this.next_lesson_url;
                });
            } else {
                Swal.fire({
                    icon: "success",
                    title: "Yaaye!!!",
                    text: "You completed the series!"
                });
            }
        },

        completeLesson() {
            axios.post(`/series/complete-lesson/${this.lesson.id}`);
            this.showAlertOnCompletion();
        }
    }
};
</script>
