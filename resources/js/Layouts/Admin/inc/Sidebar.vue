<script setup>
import { ref, computed } from "vue";

import { Link, usePage } from "@inertiajs/inertia-vue3";
import { sidebarToggleClass } from "@/Stores/main.js";
const showingNavigationDropdown = ref(false);

let isActive = ref(false);

const toggleOnTop = () => {
    isActive = !isActive;
};
const websetting = computed(() => usePage().props.value.websetting);

const activeMenu = (lists = []) => {
    const activeList = usePage().props.value.ziggy.activeRouteName;
    return lists.includes(activeList) ? true : false;
};
</script>
<template>
    <div
        id="app-sidepanel"
        :class="'app-sidepanel ' + sidebarToggleClass.toggleClass"
    >
        <div id="sidepanel-drop" class="sidepanel-drop"></div>
        <div class="sidepanel-inner d-flex flex-column">
            <a
                href="#"
                @click="sidebarToggleClass.setToggleClass('sidepanel-hidden')"
                id="sidepanel-close"
                class="sidepanel-close d-xl-none"
                >&times;</a
            >
            <div class="app-branding">
                <Link class="app-logo" href="/admin/dashboard"
                    ><img
                        class="logo-icon me-2"
                        :src="websetting.logo"
                        alt="logo"
                    /><span class="logo-text">
                        {{ websetting.site_name }}</span
                    ></Link
                >
            </div>
            <!--//app-branding-->

            <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                <ul
                    class="app-menu list-unstyled accordion"
                    id="menu-accordion"
                >
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <Link
                            class="nav-link"
                            :href="route('admin.dashboard')"
                            :class="activeMenu(['dashboard']) ? 'active' : ''"
                        >
                            <span class="nav-icon">
                                <i class="bi bi-house-door"></i>
                            </span>
                            <span class="nav-link-text">{{
                                __("Dashboard")
                            }}</span> </Link
                        ><!--//nav-link-->
                    </li>

                    <!--//nav-item-->
                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :class="activeMenu(['services']) ? 'active' : ''"
                            :href="route('admin.services.index')"
                        >
                            <span class="nav-icon">
                                <i class="bi bi-collection"></i>
                            </span>
                            <span class="nav-link-text">{{
                                __("Services")
                            }}</span> </Link
                        ><!--//nav-link-->
                    </li>

                    <!--//nav-item-->
                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :class="activeMenu(['aboutus']) ? 'active' : ''"
                            :href="route('admin.aboutus.index')"
                        >
                            <span class="nav-icon">
                                <i class="bi bi-file-person"></i>
                            </span>
                            <span class="nav-link-text">{{
                                __("About Us")
                            }}</span> </Link
                        ><!--//nav-link-->
                    </li>

                    <!--//nav-item-->
                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :class="
                                activeMenu(['static-section']) ? 'active' : ''
                            "
                            :href="route('admin.static-section.index')"
                        >
                            <span class="nav-icon">
                                <i class="bi bi-sign-intersection-side"></i>
                            </span>
                            <span class="nav-link-text">{{
                                __("Static Section")
                            }}</span> </Link
                        ><!--//nav-link-->
                    </li>

                    <!--//nav-item-->
                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :class="
                                activeMenu(['translations']) ? 'active' : ''
                            "
                            :href="route('admin.translations.index')"
                        >
                            <span class="nav-icon">
                                <i class="bi bi-translate"></i>
                            </span>
                            <span class="nav-link-text">{{
                                __("Translations")
                            }}</span> </Link
                        ><!--//nav-link-->
                    </li>
                </ul>
                <!--//app-menu-->
            </nav>
            <!--//app-nav-->
            <div class="app-sidepanel-footer">
                <nav class="app-nav app-nav-footer">
                    <ul class="app-menu footer-menu list-unstyled">
                        <li class="nav-item">
                            <Link
                                class="nav-link"
                                :href="route('admin.users.index')"
                            >
                                <span class="nav-icon">
                                    <i class="bi bi-people icon-size"></i>
                                </span>
                                <span class="nav-link-text">{{
                                    __("Users")
                                }}</span> </Link
                            ><!--//nav-link-->
                            <Link
                                class="nav-link"
                                :href="route('admin.settings.index')"
                            >
                                <span class="nav-icon">
                                    <i class="bi bi-gear icon-size"></i>
                                </span>
                                <span class="nav-link-text">{{
                                    __("Settings")
                                }}</span> </Link
                            ><!--//nav-link-->
                        </li>
                        <!--//nav-item-->
                    </ul>
                    <!--//footer-menu-->
                </nav>
            </div>
            <!--//app-sidepanel-footer-->
        </div>
        <!--//sidepanel-inner-->
    </div>
    <!--//app-sidepanel-->
</template>
