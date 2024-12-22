<template>
    <div class="flex flex-col justify-center items-center bg-matrix">
        <img class="imagineaMatrix" src="matrix3.png" alt="Matrix Image">
        <p class="Error404 text-2xl">Ne cerem scuze, pagina pe care ați introdus-o nu există!</p>
    </div>
</template>

<script>
export default {
    name: "404"
}
</script>

<style scoped>
.Error404 {
    color: #00FE01;
}

.imagineaMatrix {
    width: 30%;
}

.bg-matrix {
    background-image: url("mtrx.gif");
    background-repeat: repeat;
    background-position: center;
    min-height: 100vh;
}
</style>
