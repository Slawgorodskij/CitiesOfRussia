<template>
    <a href="javascript:;" :class="this.class" @click="onClick">Удалить</a>
</template>

<script>
export default {
    props: ["url", "confirmation", "class"],
    methods: {
        onClick() {
            if (confirm(this.confirmation)) {
                this.send(this.url).then(() => {
                    location.reload();
                });
            }
        },
        async send(url) {
            let response = await fetch(url, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            });

            let result = await response.json();
            return result.ok;
        },
    },
};
</script>
