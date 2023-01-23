<script setup>
import { Link } from "@inertiajs/inertia-vue3";
defineProps({
    counts: Object,
    status: String,
});
</script>
<template>
    <ul class="nav nav-tabs-lists">
        <li class="nav-item">
            <Link
                class="nav-link"
                :class="{
                    active: status === 'all',
                }"
                data-tab="all"
                aria-current="page"
                :href="route('admin.services.index') + '?status=all'"
                >{{ __("All") }} (<span id="total_record"
                    >{{ counts.all }} </span
                >)</Link
            >
        </li>
        <li class="nav-item">
            <Link
                class="nav-link"
                :class="{
                    active: status === 'trash',
                }"
                data-tab="trashed"
                :href="route('admin.services.index') + '?status=trash'"
                >{{ __("Trash") }} (<span id="total_trashed_record">{{
                    counts.trashed
                }}</span
                >)</Link
            >
        </li>
    </ul>
</template>
