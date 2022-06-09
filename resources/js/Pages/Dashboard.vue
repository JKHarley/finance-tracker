<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import FinanceTracker from "@/Components/Finance/FinanceTracker.vue";
import useUser from "../Hooks/useUser";

const user = useUser();
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>

                <div>
                    {{ user.email }}
                </div>
            </div>
        </template>

        <FinanceTracker />
    </AppLayout>
</template>
