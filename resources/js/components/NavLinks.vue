<template>
    <div class="mainDiv flex align-center justify-evenly">

        <div class="flex thePC_Version">
            <nav-links-options :shared_access_token="shared_access_token" :users_role="users_role"></nav-links-options>
        </div>

        <div class="hamburger">
            <i class="fa-solid fa-bars" @click.prevent="toggleMobileMenu = !toggleMobileMenu"></i>
        </div>

        <div class="flex gap-3 mt-2">
            <input class="text-black p-1 searchBox" id="inputText" type="text">

            <div id="fb">
                <a href="https://www.facebook.com/MinisterulFinantelorRM/?fref=ts" target="_blank">
                <svg class="fblink w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"/>
                </svg>
                </a>
            </div>

            <div class="yt mt-[2px]">
                <a href="https://www.youtube.com/channel/UCETM2zuG9I4-NW6SyQiteMw" target="_blank">
                <img class="w-6" src="yt1.jpg">
                </a>
            </div>

            <div class="rss mt-[6px]">
                <a href="https://mf.gov.md/ro/comunicate/rss" target="_blank">
                <svg class="rsslink w-4" xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M0 64C0 46.3 14.3 32 32 32c229.8 0 416 186.2 416 416c0 17.7-14.3 32-32 32s-32-14.3-32-32C384 253.6 226.4 96 32 96C14.3 96 0 81.7 0 64zM0 416a64 64 0 1 1 128 0A64 64 0 1 1 0 416zM32 160c159.1 0 288 128.9 288 288c0 17.7-14.3 32-32 32s-32-14.3-32-32c0-123.7-100.3-224-224-224c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/>
                </svg>
                </a>
            </div>

            <div class="lilinkDiv mt-[6px]">
                <a href="https://www.linkedin.com/company/ministry-of-finance-of-moldova" target="_blank">
                <svg class="lilink w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"/>
                </svg>
                </a>
            </div>
        </div>

    </div>
    <div class="ml-5 mobileMenuOptions" v-if="toggleMobileMenu">
        <nav-links-options :shared_access_token="shared_access_token" :users_role="users_role"></nav-links-options>
    </div>


</template>

<script>
import NavLinksOptions from "./NavLinksOptions.vue";

export default {
    name: "NavLinks",
    components: {NavLinksOptions},

    props:[
        'shared_access_token',
        'users_role',
    ],

    data() {
        return {
            toggleMobileMenu: false,
        }
    }
}
</script>

<style LANG="scss" scoped>
.hamburger i {
    color: #9A9A9B;
    font-size: 30px;
    margin-top: 3px;

    &:hover {
        color: white;
    }
    &:active {
        transform:translateY(2px);
    }
}

.mainDiv {
    display: flex;
    background-color: #1A3051;
    overflow: hidden;
}

.links {
    display: none;
    overflow: hidden;

    a:hover {
        background-color: #354966;

    }
}

.dropDownMenu:hover .links {
    display: block;
    position: absolute;
    color: white;
    background: #1A3051;
    min-width: 180px;
    max-width: 280px;
}

.dropDownMenu:hover .links a {
    display: block;
    padding: 6px 16px;
}

.btnLink:hover {
    background: linear-gradient(to bottom, #314663, rgb(26, 49, 80));
}


@media (max-width: 755px) {
    .thePC_Version {
        display: none;
    }
    .searchBox {
        margin-bottom: 5px;
    }
    .hamburger {
        margin-top: 3px;
    }
}

@media (min-width: 756px) {
    .hamburger {
        display: none; /* Adjust if needed for mobile */
    }
    .mobileMenuOptions{
        display:none;
    }
}


#fb:hover {
    cursor: pointer;

    .fblink {
        fill: #023399;
    }
}

.fblink {
    fill: #9A9A9B;
}

.lilink {
    fill: #9A9A9B;
}

.lilinkDiv:hover {
    cursor: pointer;

    .lilink {
        fill: white;
    }
}

.rss:hover {
    cursor: pointer;

    .rsslink {
        fill: #ff9901;
    }
}

.rsslink {
    fill: #9A9A9B;
}

.yt:hover img {
    cursor: pointer;
    content: url('yt2.jpg');
}

.searchBox {
    outline: none;
    box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.5);
    width: 210px;
    height: 30px;

    background-image: url('search.png');
    background-repeat: no-repeat;
    background-position: calc(100% - 5px) 2px;
    background-size: 30px 30px;
}
</style>
