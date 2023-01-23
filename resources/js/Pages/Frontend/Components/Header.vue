<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>
<template>
    <div class="Header">
        <div
            class="container-xl d-flex align-items-center justify-content-between"
        >
            <div class="logo">
                <img :src="$page.props.websetting.logo" alt="" />
            </div>

            <div class="HeaderList">
                <ul class="d-flex align-items-center gap-5">
                    <li>
                        <a href="" class="nav-link">{{ __("About Us") }} </a>
                    </li>
                    <li>
                        <a href="" class="nav-link">{{ __("Our Services") }}</a>
                    </li>
                    <li>
                        <a href="" class="nav-link">{{ __("Contacts") }}</a>
                    </li>
                    <li>
                        <a href="" class="nav-link">{{
                            __("Leave a request / question")
                        }}</a>
                    </li>
                </ul>
            </div>

            <div class="HeaderLanguage d-flex align-items-center gap-3">
                <Link href="/ru" class="nav-link">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/en/thumb/f/f3/Flag_of_Russia.svg/1200px-Flag_of_Russia.svg.png"
                        alt=""
                    />
                </Link>
                <Link href="/en" class="nav-link">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/Flag_of_Great_Britain_%281707%E2%80%931800%29.svg/1200px-Flag_of_Great_Britain_%281707%E2%80%931800%29.svg.png"
                        alt=""
                    />
                </Link>
            </div>

            <div class="Mobail">
                <button
                    class="btn"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasWithBothOptions"
                    aria-controls="offcanvasWithBothOptions"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="36"
                        height="36"
                        fill="currentColor"
                        class="bi bi-list text-white"
                        viewBox="0 0 16 16"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
                        />
                    </svg>
                </button>

                <div
                    class="offcanvas offcanvas-end"
                    data-bs-scroll="true"
                    tabindex="-1"
                    id="offcanvasWithBothOptions"
                    aria-labelledby="offcanvasWithBothOptionsLabel"
                >
                    <div class="offcanvas-header">
                        <h5
                            class="offcanvas-title"
                            id="offcanvasWithBothOptionsLabel"
                        ></h5>
                        <button
                            type="button"
                            class="btn"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="26"
                                height="26"
                                fill="currentColor"
                                class="bi bi-x-lg text-white"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"
                                />
                            </svg>
                        </button>
                    </div>
                    <div class="offcanvas-body text-end">
                        <div class="HeaderList">
                            <ul class="">
                                <li>
                                    <a href="" class="nav-link"
                                        >{{ __("About Us") }}
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="nav-link">{{
                                        __("Our Services")
                                    }}</a>
                                </li>
                                <li>
                                    <a href="" class="nav-link">{{
                                        __("Contacts")
                                    }}</a>
                                </li>
                                <li>
                                    <a href="" class="nav-link">{{
                                        __("Leave a request / question")
                                    }}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="HeaderLanguage mt-5">
                            <div
                                class="d-flex align-items-center gap-3 justify-content-end"
                            >
                                <Link href="/ru" class="nav-link">
                                    <img
                                        src="https://upload.wikimedia.org/wikipedia/en/thumb/f/f3/Flag_of_Russia.svg/1200px-Flag_of_Russia.svg.png"
                                        alt=""
                                    />
                                </Link>
                                <Link href="/en" class="nav-link">
                                    <img
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/Flag_of_Great_Britain_%281707%E2%80%931800%29.svg/1200px-Flag_of_Great_Britain_%281707%E2%80%931800%29.svg.png"
                                        alt=""
                                    />
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
.Header {
    background: var(--bg);
    padding: 15px 0px;
}

.Header .logo img {
    width: 63px;
    height: 50px;
}

.HeaderList ul li {
    list-style: none;
    margin-top: 20px;
}

.HeaderList ul li a {
    font-style: normal;
    font-weight: 600;
    font-size: 18px;
    color: #ffffff;
    text-decoration: none;
}

.HeaderLanguage img {
    width: 24px;
    height: 14px;
}

.btn {
    outline: none !important;
    border: none !important;
}

.Mobail {
    display: none !important;
}

.offcanvas {
    background: var(--bg) !important;
}

@media only screen and (max-width: 900px) {
    .HeaderList {
        display: none;
    }

    .HeaderLanguage {
        display: none !important;
    }

    .Header .logo img {
        width: 53px;
        height: 40px;
    }

    .Mobail {
        display: block !important;
    }

    .offcanvas-body .HeaderLanguage {
        display: block !important;
    }

    .offcanvas-body .HeaderList {
        display: block !important;
    }

    .HeaderLanguage img {
        width: 34px;
        height: 24px;
    }
}
</style>
