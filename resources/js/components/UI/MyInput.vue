<template>
    <input :value="modelValue" @input="updateInput" class="my-input" type="text" />
</template>

<script>
export default {
    name: "my-input",
    props: {
        modelValue: [String, Number],
    },
    methods: {
        updateInput(event) {
            this.$emit("update:modelValue", event.target.value);
        },
    },
};
</script>

<style lang="scss" scoped>
.my-input {
    margin: 2vh 0;
    width: 100%;
    height: 8vh;
    border: var(--color-border) solid 2px;
    border-radius: 5px;
    padding: 15px;

    &:focus-visible {
        outline: none;
    }
}
</style>
