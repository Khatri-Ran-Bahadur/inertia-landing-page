<script setup></script>
<template>
    <div class="Footer mt-5">
        <div class="container-xl">
            <div class="row gy-5 align-items-center">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="logo">
                        <img :src="$page.props.websetting.logo" alt="" />
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <ul>
                        <li class="h5 fw-bold">{{ __("MENU") }}</li>
                        <li class="h6">{{ __("About Us") }}</li>
                        <li class="h6">{{ __("Our Service") }}</li>
                        <li class="h6">{{ __("Contacts") }}</li>
                    </ul>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <ul>
                        <li class="h5 fw-bold">
                            {{ __("LEGAL INFORMATION") }}
                        </li>
                        <li class="h6">{{ __("Terms of Use") }}</li>
                        <li class="h6">{{ __("License agreement") }}</li>
                        <li class="h6">{{ __("Privacy Policy") }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
.Footer {
    background: var(--bg3);
    padding: 50px 0px;
}

.Footer .logo img {
    width: 120px;
    height: 99px;
    margin-left: 28px;
}

.Footer ul li {
    list-style: none;
}
</style>
