<script setup lang="ts">
import useUser from "../Hooks/useUser";
import { ref } from "@vue/reactivity";
import FinanceTracker from "@/Components/Finance/FinanceTracker.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import type { Ref } from "vue";

interface FinanceType extends App.DataTransferObjects.FinanceData {}

const props = defineProps<{
    income: Array<FinanceType>,
    outgoings: Array<FinanceType>,
}>();

const incomings: Ref<Array<FinanceType>> = ref(props.income);
const outgoings: Ref<Array<FinanceType>> = ref(props.outgoings);

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

        <FinanceTracker :income="incomings" :outgoings="outgoings" />
    </AppLayout>
</template>
