<template>
<!--<div>-->
<!--    <div v-for ="value in allposts">-->
<!--        {{value}}-->
<!--    </div>-->
<!--</div>-->
</template>





<script>
    export default {
        props: ["posts"],
        mounted() {
            // var posts2 = JSON.parse(this.allposts);
            // console.log(posts2);
            // for (var i = 0; i < Object.keys(posts2).length; i++)
            // {console.log(this.posts2[i]["title"])}

        },
        data: function() {
            return {
                allposts: this.posts

            };
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>
