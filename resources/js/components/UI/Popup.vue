<template>
    <div
        @click.stop="closePopup"
        class="popup">
        <div class="popup__header">
            <svg version="1.1" x="0px" y="0px"
                 width="25px" height="25px" viewBox="0 0 94.926 94.926"
                 style="enable-background:new 0 0 94.926 94.926;"
                 xml:space="preserve">
	<path d="M55.931,47.463L94.306,9.09c0.826-0.827,0.826-2.167,0-2.994L88.833,0.62C88.436,0.224,87.896,0,87.335,0
		c-0.562,0-1.101,0.224-1.498,0.62L47.463,38.994L9.089,0.62c-0.795-0.795-2.202-0.794-2.995,0L0.622,6.096
		c-0.827,0.827-0.827,2.167,0,2.994l38.374,38.373L0.622,85.836c-0.827,0.827-0.827,2.167,0,2.994l5.473,5.476
		c0.397,0.396,0.936,0.62,1.498,0.62s1.1-0.224,1.497-0.62l38.374-38.374l38.374,38.374c0.397,0.396,0.937,0.62,1.498,0.62
		s1.101-0.224,1.498-0.62l5.473-5.476c0.826-0.827,0.826-2.167,0-2.994L55.931,47.463z"/>
</svg>
        </div>
        <div class="popup__content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "Popup",
    data() {
    },
    methods: {
        closePopup() {
            this.$emit('closePopup')
        },
    }
}


</script>

<style lang="scss">
.popup {
    position: fixed;
    padding: 15px;
    z-index: 15;
    top: 2vh;
    left: 2vw;
    width: 95vw;
    height: 95vh;
    background-color: var(--color-background-body);
    box-shadow: 0 15px 25px -2px rgba(34, 60, 80, 0.35);
    fill: var(--color-white);


    &__header {
        margin-bottom: 1vh;
        display: flex;
        justify-content: flex-end;
    }

    &__content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 90vh;
    }
}
</style>
