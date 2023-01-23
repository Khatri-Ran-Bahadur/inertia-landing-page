<template>
    <draggable
        class="sortable"
        tag="ol"
        :list="items"
        :group="{ name: 'g1' }"
        item-key="name"
    >
        <template #item="{ element }">
            <li>
                <div class="menu-handle">
                    <span>
                        {{ element.menu_name }}
                        -<span class="badge bg-primary"
                            ><a href="" class="text-white">{{
                                __(element.type)
                            }}</a></span
                        >
                    </span>
                    <div class="menu-options">
                        <a
                            class=""
                            data-bs-toggle="collapse"
                            :href="'#collapse_' + element.id"
                            aria-expanded="false"
                            aria-controls="collapseExample"
                        >
                            <span
                                ><i
                                    class="fas fa-angle-down"
                                    aria-hidden="true"
                                ></i
                            ></span>
                        </a>
                    </div>

                    <div class="collapse" :id="'collapse_' + element.id">
                        <hr />
                        <Link
                            class="item-remove-btn mt-4 text-danger"
                            :href="
                                route('admin.menus.items-remove', element.id)
                            "
                            >{{ __("Delete") }}</Link
                        >
                    </div>
                </div>
                <NestedList :items="element.items" />
            </li>
        </template>
    </draggable>
</template>
<script setup>
import draggable from "vuedraggable";
import { Link } from "@inertiajs/inertia-vue3";
defineProps({ items: [] });
</script>
<style scoped>
.dragArea {
    min-height: 50px;
    outline: 1px dashed;
}
</style>
