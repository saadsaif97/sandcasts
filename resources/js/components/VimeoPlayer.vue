<template>
    <div
        v-if="lesson"
        :data-vimeo-id="lesson.video_id"
        data-vimeo-width="640"
        id="lessonPlayer"
    ></div>
    <p v-else>There is no lesson in this series</p>
</template>

<script>
import Player from "@vimeo/player";

export default {
    props: ["lesson"],
    mounted() {
        const player = new Player("lessonPlayer");
        player.on("play", function() {
            console.log("played the handstick video!");
        });

        player.on("ended", () => {
            console.log("ended");
        });

        console.log(this.lesson);
    }
};
</script>
