<template>
    <div id="viewer">
        {{ message }}
    </div>
</template>
<script>
const default_layout = "default";

export default {
    computed: {},
    data() {
        return {
            message: 'Hello World'
        };
    },
    mounted() {
    }
};
</script>
