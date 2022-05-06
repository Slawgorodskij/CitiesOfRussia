<template>
    <transition :name="direction" mode="in-out">
        <div v-show="visibleSlade === index" >
            <slot></slot>
        </div>
    </transition>

</template>

<script>
export default {
    name: " CarouselSlide",
    props: ['visibleSlade', 'index', 'direction'],
}
</script>

<style lang="scss">
.left {
    &-enter-active {
        animation: leftInAnimation 0.4s ease-in-out;
    }

    &-leave-active {
        animation: leftOutAnimation 0.4s ease-in-out;
    }
}

.right {
    &-enter-active {
        animation: rightInAnimation 0.4s ease-in-out;
    }

    &-leave-active {
        animation: rightOutAnimation 0.4s ease-in-out;
    }
}


</style>
