<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import FinanceTracker from "@/Components/Finance/FinanceTracker.vue";
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <FinanceTracker />
    </AppLayout>
</template>
