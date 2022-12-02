<template>
    <header>
        <div class="mx-auto px-3">
            <slot name="header" />
        </div>
    </header>

    <div class="container">
        <slot />
    </div>
</template>