import { usePage } from "@inertiajs/inertia-vue3"
import { computed } from "@vue/reactivity"

export default () => {
    return computed(() => usePage().props.value.user);
}
