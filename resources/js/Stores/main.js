import { ref } from "vue";
export const sidebarToggleClass = ref({
    toggleClass: "",
    setToggleClass(val) {
        this.toggleClass = val;
    },
});
