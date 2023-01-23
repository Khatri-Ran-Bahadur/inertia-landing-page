<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import Sidebar from "./Sidebar.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { sidebarToggleClass } from "@/Stores/main.js";
const showingNavigationDropdown = ref(false);
</script>
<template>
    <header class="app-header fixed-top header-bg">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <a
                                id="sidepanel-toggler"
                                @click="
                                    sidebarToggleClass.setToggleClass(
                                        'sidepanel-visible'
                                    )
                                "
                                class="sidepanel-toggler d-inline-block d-xl-none"
                                href="#"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="30"
                                    height="30"
                                    viewBox="0 0 30 30"
                                    role="img"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-miterlimit="10"
                                        stroke-width="2"
                                        d="M4 7h22M4 15h22M4 23h22"
                                    ></path>
                                </svg>
                            </a>
                        </div>
                        <!--//col-->
                        <div class="search-mobile-trigger d-sm-none col">
                            <i
                                class="search-mobile-trigger-icon fas fa-search"
                            ></i>
                        </div>
                        <!--//col-->
                        <div class="app-search-box col">
                            <form class="app-search-form">
                                <input
                                    type="text"
                                    placeholder="Search..."
                                    name="search"
                                    class="form-control search-input"
                                />
                                <button
                                    type="submit"
                                    class="btn search-btn btn-primary"
                                    value="Search"
                                >
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <!--//app-search-box-->

                        <div class="app-utilities col-auto">
                            <div
                                class="app-utility-item app-user-dropdown dropdown"
                            >
                                <a
                                    class=""
                                    id="user-dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    role="button"
                                    aria-expanded="false"
                                    ><img
                                        class="profile-img-rounded"
                                        :src="$page.props.auth.user.image"
                                    />{{ $page.props.auth.user.name }}</a
                                >
                                <ul class="dropdown-menu">
                                    <li>
                                        <Link
                                            class="dropdown-item"
                                            :href="route('admin.profile.edit')"
                                            >Account</Link
                                        >
                                    </li>
                                    <li>
                                        <Link
                                            class="dropdown-item"
                                            :href="
                                                route('admin.settings.index')
                                            "
                                            >Settings</Link
                                        >
                                    </li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li>
                                        <Link
                                            :href="route('logout')"
                                            method="post"
                                            class="dropdown-item"
                                            as="button"
                                        >
                                            Log Out
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                            <!--//app-user-dropdown-->
                        </div>
                        <!--//app-utilities-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-header-content-->
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-header-inner-->
        <Sidebar />
    </header>
    <!--//app-header-->
</template>
